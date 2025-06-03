<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Services\AdminService;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $subCategories = SubCategory::with('category')->orderBy('name','asc')->paginate(20);
        return view('admin.sub-category.list',[
            'subCategories' => $subCategories,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm danh mục sản phẩm cấp 1";
        $action = "add";
        $categories = Category::orderBy('name','asc')->get();
        return view('admin.sub-category.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'categories' => $categories
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa danh mục sản phẩm cấp 1";
        $action = "edit";
        $subCategory = SubCategory::find($id);
        $categories = Category::orderBy('name','asc')->get();
        return view('admin.sub-category.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'subCategory' => $subCategory,
            'categories' => $categories
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $categoryId = $request->category;
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên danh mục sản phẩm cấp 1 không được để trống.'
            ]);
        }

        if($action == "edit"){
            $subCategoryExist = SubCategory::where('slug',$slug)->where('category_id',$categoryId)->where('id','<>',$request->id)->first();
        }else{
            $subCategoryExist = SubCategory::where('slug',$slug)->where('category_id',$categoryId)->first();
        }
        
        if (isset($subCategoryExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên danh mục sản phẩm cấp 1 đã tồn tại.'
            ]);
        }

        if (empty($categoryId)) {
            return response()->json([
                'success' => false,
                'message' => 'Danh mục sản phẩm không được để trống.'
            ]);
        }

        if($action == "edit"){
            $subCategory = SubCategory::find($request->id);
        }else{
            $subCategory = new SubCategory();
        }
        
        $subCategory->name = $name;
        $subCategory->slug = $slug;
        $subCategory->category_id = $categoryId;
        $subCategory->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $subCategory = SubCategory::find($request->id);
        $subCategory->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $subCategories = SubCategory::with('category')
        ->where('name','LIKE','%'.$infoSearch.'%')
        ->orWhereHas('category', function ($query) use ($infoSearch) {
            $query->where('name', 'LIKE', '%' . $infoSearch . '%');
        })->orderBy('name','asc')->paginate(20);

        return view('admin.sub-category.list',[
            'infoSearch' => $infoSearch,
            'subCategories' => $subCategories
        ]);
    }
}
