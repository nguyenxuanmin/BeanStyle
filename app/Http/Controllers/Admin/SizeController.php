<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Services\AdminService;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $sizes = Size::orderBy('id','asc')->paginate(20);
        return view('admin.size.list',[
            'sizes' => $sizes,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm kích thước";
        $action = "add";
        return view('admin.size.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa kích thước";
        $action = "edit";
        $size = Size::find($id);
        return view('admin.size.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'size' => $size
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên kích thước không được để trống.'
            ]);
        }

        if($action == "edit"){
            $sizeExist = Size::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $sizeExist = Size::where('slug',$slug)->first();
        }
        
        if (isset($sizeExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên kích thước đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $size = Size::find($request->id);
        }else{
            $size = new Size();
        }
        
        $size->name = $name;
        $size->slug = $slug;
        $size->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $size = Size::find($request->id);
        $size->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $sizes = Size::where('name','LIKE','%'.$infoSearch.'%')->orderBy('id','asc')->paginate(20);

        return view('admin.size.list',[
            'infoSearch' => $infoSearch,
            'sizes' => $sizes
        ]);
    }
}
