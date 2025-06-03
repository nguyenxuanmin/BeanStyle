<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSize;
use App\Models\Product;
use App\Models\Size;

class ProductSizeController extends Controller
{
    public function update($id){
        $titlePage = "Cập nhật kích thước sản phẩm";
        $product = Product::find($id);
        $productSizes = ProductSize::with('size')->where('product_id',$id)->orderBy('id','asc')->get();
        $usedSizeIds = $productSizes->pluck('size_id');
        $sizes = Size::whereNotIn('id', $usedSizeIds)->orderBy('id','asc')->get();
        return view('admin.product-size.main',[
            'titlePage' => $titlePage,
            'product' => $product,
            'sizes' => $sizes,
            'productSizes' => $productSizes
        ]);
    }

    public function save(Request $request){
        $price = (int) str_replace('.', '', $request->input('price', '0'));
        $discount = (int) str_replace('.', '', $request->input('discount', '0'));
        $productId = $request->productId;
        $sizeId = $request->size;

        $productSize = new ProductSize();
        $productSize->price = $price;
        $productSize->discount = $discount;
        $productSize->product_id = $productId;
        $productSize->size_id = $sizeId;
        $productSize->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $productSize = ProductSize::find($request->id);
        $productSize->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
