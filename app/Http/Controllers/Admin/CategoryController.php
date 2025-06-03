<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Services\AdminService;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $categories = Category::orderBy('name','asc')->paginate(20);
        return view('admin.category.list',[
            'categories' => $categories,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm danh mục sản phẩm";
        $action = "add";
        return view('admin.category.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa danh mục sản phẩm";
        $action = "edit";
        $category = Category::find($id);
        return view('admin.category.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'category' => $category
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $content = $request->content;
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
        if (isset($_FILES["icon"])) {
            $icon = $_FILES["icon"]["name"];
        }else{
            $icon = "";
        }
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên danh mục sản phẩm không được để trống.'
            ]);
        }

        if($action == "edit"){
            $categoryExist = Category::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $categoryExist = Category::where('slug',$slug)->first();
        }
        
        if (isset($categoryExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên danh mục sản phẩm đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $category = Category::find($request->id);
        }else{
            $category = new Category();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = 'categories/image/'.$category->image;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'categories/image');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if (!empty($icon)) {
            if($action == "edit"){
                $iconPath = 'categories/icon/'.$category->icon;
                if (Storage::disk('public')->exists($iconPath)) {
                    Storage::disk('public')->delete($iconPath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["icon"],'categories/icon');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if($action == "edit"){
            if (!$request->hasFile('image')) {
                $image = $category->image;
            }
            if (!$request->hasFile('icon')) {
                $icon = $category->icon;
            }
        }
        
        $category->name = $name;
        $category->slug = $slug;
        $category->content = $content;
        $category->image = $image;
        $category->icon = $icon;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $category = Category::find($request->id);
        $imagePath = 'categories/image/'.$category->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $iconPath = 'categories/icon/'.$category->icon;
        if (Storage::disk('public')->exists($iconPath)) {
            Storage::disk('public')->delete($iconPath);
        }
        $category->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $categories = Category::where('name','LIKE','%'.$infoSearch.'%')->orderBy('name','asc')->paginate(20);
        return view('admin.category.list',[
            'infoSearch' => $infoSearch,
            'categories' => $categories
        ]);
    }
}
