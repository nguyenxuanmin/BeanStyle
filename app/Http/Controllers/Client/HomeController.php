<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Benefit;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->limit(4)->get();
        $benefits = Benefit::orderBy('id','asc')->get();
        $collections = Collection::orderBy('name','asc')->get();
        $categories = Category::with(['subCategories' => function ($query) {
                $query->withCount('products');
            }])->orderBy('name', 'asc')->get();
        $saleProducts = Product::with(['productColors.productImages','productSizes'])
            ->has('productColors')
            ->has('productSizes')
            ->where('isSale',1)
            ->orderBy('created_at','desc')
            ->limit(8)->get();
        return view('client.index',[
            'sliders' => $sliders,
            'benefits' => $benefits,
            'collections' => $collections,
            'categories' => $categories,
            'saleProducts' => $saleProducts
        ]);
    }
}
