<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Benefit;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Product;
use App\Models\Advertisement;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->limit(4)->get();
        $benefits = Benefit::orderBy('id','asc')->limit(4)->get();
        $collections = Collection::orderBy('name','asc')->limit(4)->get();
        $categories = Category::with(['subCategories' => function ($query) {
                $query->withCount('products');
            }])->orderBy('name', 'asc')->get();
        $saleProducts = Product::with(['productColors.productImages','productSizes','productColors.color'])
            ->has('productColors')
            ->has('productSizes')
            ->where('isSale',1)
            ->orderBy('created_at','desc')
            ->limit(8)->get();
        $advFirst = Advertisement::orderBy('id','asc')->first();
        if (isset($advFirst)) {
            $advs = Advertisement::where('id','<>',$advFirst->id)->orderBy('id','asc')->get();
        } else {
            $advs = "";
        }
        $blogs = Blog::orderBy('created_at','desc')->limit(8)->get();
        
        return view('client.index',[
            'sliders' => $sliders,
            'benefits' => $benefits,
            'collections' => $collections,
            'categories' => $categories,
            'saleProducts' => $saleProducts,
            'advFirst' => $advFirst,
            'advs' => $advs,
            'blogs' => $blogs
        ]);
    }

    public function ajaxAllProduct(Request $request){
        $status = $request->status;
        switch ($status) {
            case 'new':
                $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
                    ->has('productColors')
                    ->has('productSizes')
                    ->where('isNew',1)
                    ->orderBy('created_at','desc')
                    ->limit(10)->get();
                break;
            case 'hot':
                $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
                    ->has('productColors')
                    ->has('productSizes')
                    ->where('isHot',1)
                    ->orderBy('created_at','desc')
                    ->limit(10)->get();
                break;
            case 'best-seller':
                $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
                    ->has('productColors')
                    ->has('productSizes')
                    ->where('isBestSeller',1)
                    ->orderBy('created_at','desc')
                    ->limit(10)->get();
                break;
        }
        return view('client.ajax-all-product', compact('products')); 
    } 
}
