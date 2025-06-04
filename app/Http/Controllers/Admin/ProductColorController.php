<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\Product;
use App\Models\Color;

class ProductColorController extends Controller
{
    public function update($id){
        $titlePage = "Cập nhật màu sắc sản phẩm";
        $product = Product::find($id);
        $productColors = ProductColor::with(['color','productImages'])->where('product_id',$id)->orderBy('id','asc')->get();
        $usedColorIds = $productColors->pluck('color_id');
        $colors = Color::whereNotIn('id', $usedColorIds)->orderBy('name','asc')->get();
        return view('admin.product-color.main',[
            'titlePage' => $titlePage,
            'product' => $product,
            'colors' => $colors,
            'productColors' => $productColors
        ]);
    }

    public function save(Request $request){
        $productId = $request->productId;
        $colorId = $request->color;
        $imageProducts = $request->file('imageProduct');

        if (empty($colorId)) {
            return response()->json([
                'success' => false,
                'message' => 'Màu sắc sản phẩm không được để trống.'
            ]);
        }

        if (empty($imageProducts)) {
            return response()->json([
                'success' => false,
                'message' => 'Ảnh sản phẩm không được để trống.'
            ]);
        }

        $productColor = new ProductColor();
        $productColor->product_id = $productId;
        $productColor->color_id = $colorId;
        $productColor->save();
        
        foreach ($imageProducts as $file) {
            if ($file->isValid()) {
                $nameFile = $file->getClientOriginalName();
                $typeFile = $file->getClientOriginalExtension();
                $nameOnly = pathinfo($nameFile, PATHINFO_FILENAME);
                $newNameFile = time() . '_' . $nameOnly . '.' . $typeFile;
                $path = $file->storeAs('products', $newNameFile, 'public');
                $fileProductImage = new ProductImage();
                $fileProductImage->image = $newNameFile;
                $fileProductImage->product_color_id = $productColor->id;
                $fileProductImage->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $productColor = ProductColor::with('productImages')->find($request->id);
        foreach ($productColor->productImages as $item) {
            $imagePath = 'products/'.$item->image;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        $productColor->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
