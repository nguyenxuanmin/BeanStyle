<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ClientProductController extends Controller
{
    public function showall(){
        $titlePage = 'Tất cả sản phẩm';
        $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
            ->has('productColors')
            ->has('productSizes')
            ->orderBy('name','desc')
            ->paginate(12);
        
        return view('client.product',[
            'products' => $products,
            'titlePage' => $titlePage
        ]);
    }
}
