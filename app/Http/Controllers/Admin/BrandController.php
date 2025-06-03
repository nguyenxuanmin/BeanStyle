<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Services\AdminService;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $brands = Brand::orderBy('name','asc')->paginate(20);
        return view('admin.brand.list',[
            'brands' => $brands,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm thương hiệu";
        $action = "add";
        return view('admin.brand.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa thương hiệu";
        $action = "edit";
        $brand = Brand::find($id);
        return view('admin.brand.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'brand' => $brand
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên thương hiệu không được để trống.'
            ]);
        }

        if($action == "edit"){
            $brandExist = Brand::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $brandExist = Brand::where('slug',$slug)->first();
        }
        
        if (isset($brandExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên thương hiệu đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $brand = Brand::find($request->id);
        }else{
            $brand = new Brand();
        }
        
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $brand = Brand::find($request->id);
        $brand->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $brands = Brand::where('name','LIKE','%'.$infoSearch.'%')->orderBy('name','asc')->paginate(20);

        return view('admin.brand.list',[
            'infoSearch' => $infoSearch,
            'brands' => $brands
        ]);
    }
}
