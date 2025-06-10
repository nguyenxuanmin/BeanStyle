<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Services\AdminService;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $blogs = Blog::orderBy('created_at','desc')->paginate(20);
        return view('admin.blog.list',[
            'blogs' => $blogs,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm tin tức";
        $action = "add";
        return view('admin.blog.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa tin tức";
        $action = "edit";
        $blog = Blog::find($id);
        return view('admin.blog.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'blog' => $blog
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $description = $request->description;
        $content = $request->content;
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề tin tức không được để trống.'
            ]);
        }

        if($action == "edit"){
            $blogExist = Blog::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $blogExist = Blog::where('slug',$slug)->first();
        }
        
        if (isset($blogExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề tin tức đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $blog = Blog::find($request->id);
        }else{
            $blog = new Blog();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = 'blogs/image/'.$blog->image;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'blogs');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if($action == "edit"){
            if (!$request->hasFile('image')) {
                $image = $blog->image;
            }
        }
        
        $blog->name = $name;
        $blog->slug = $slug;
        $blog->description = $description;
        $blog->content = $content;
        $blog->image = $image;
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $blog = Blog::find($request->id);
        $imagePath = 'blogs/image/'.$blog->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $blog->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $blogs = Blog::where('name','LIKE','%'.$infoSearch.'%')->orderBy('created_at','desc')->paginate(20);
        return view('admin.blog.list',[
            'infoSearch' => $infoSearch,
            'blogs' => $blogs
        ]);
    }
}
