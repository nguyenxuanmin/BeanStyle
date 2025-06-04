<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Services\AdminService;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $products = Product::with(['productSizes.size','brand','productColors.productImages'])->orderBy('product_code','asc')->paginate(20);
        return view('admin.product.list',[
            'products' => $products,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm sản phẩm";
        $action = "add";
        $brands = Brand::orderBy('name','asc')->get();
        $subCategorys = SubCategory::orderBy('name','asc')->get();
        $productCode = $this->generateProductCode();
        return view('admin.product.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'brands' => $brands,
            'subCategorys' => $subCategorys,
            'productCode' => $productCode
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa sản phẩm";
        $action = "edit";
        $product = Product::find($id);
        $brands = Brand::orderBy('name','asc')->get();
        $subCategorys = SubCategory::orderBy('name','asc')->get();
        $productCode = $product->product_code;
        return view('admin.product.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'product' => $product,
            'brands' => $brands,
            'subCategorys' => $subCategorys,
            'productCode' => $productCode
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $productCode = $request->code;
        $subCategoryId = $request->subCategory;
        $brandId = $request->brand;
        $description = $request->description;
        $status = $request->has('status') ? 1 : 0;
        $content = $request->content;
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên sản phẩm không được để trống.'
            ]);
        }

        if($action == "edit"){
            $productExist = Product::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $productExist = Product::where('slug',$slug)->first();
        }
        
        if (isset($productExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên sản phẩm đã tồn tại.'
            ]);
        }

        if (empty($subCategoryId)) {
            return response()->json([
                'success' => false,
                'message' => 'Danh mục sản phẩm cấp 1 không được để trống.'
            ]);
        }

        if($action == "edit"){
            $product = Product::find($request->id);
        }else{
            $product = new Product();
        }
        
        $product->name = $name;
        $product->slug = $slug;
        $product->product_code = $productCode;
        $product->sub_category_id = $subCategoryId;
        $product->brand_id = $brandId;
        $product->description = $description;
        $product->content = $content;
        $product->status = $status;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $product = Product::find($request->id);
        $product->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $products = Product::with(['productSizes.size','brand','productColors.productImages'])
        ->where('name','LIKE','%'.$infoSearch.'%')
        ->orWhere('product_code','LIKE','%'.$infoSearch.'%')
        ->orderBy('product_code','asc')->paginate(20);

        return view('admin.product.list',[
            'infoSearch' => $infoSearch,
            'products' => $products
        ]);
    }

    public function generateProductCode(){
        $lastProduct = Product::orderBy('id', 'desc')->first();
        if ($lastProduct && preg_match('/PROD-(\d+)/', $lastProduct->product_code, $matches)) {
            $number = (int)$matches[1] + 1;
        } else {
            $number = 1;
        }
        return 'PROD-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
