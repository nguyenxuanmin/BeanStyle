<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class ClientProductController extends Controller
{
    public function showAll(){
        $titlePage = 'Sản phẩm';
        $categories = Category::with(['subCategories' => function ($query) {
            $query->withCount('products');
        }])->orderBy('name', 'asc')->get();
        $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
            ->has('productColors')
            ->has('productSizes')
            ->orderBy('name','desc')
            ->paginate(12);
        
        return view('client.product',[
            'products' => $products,
            'categories' => $categories,
            'titlePage' => $titlePage
        ]);
    }

    public function showCategory($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $titlePage = $category->name;

        $categories = Category::with(['subCategories' => function ($query) {
            $query->withCount('products');
        }])->orderBy('name', 'asc')->get();
        
        $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
        ->whereHas('subCategory', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->has('productColors')
        ->has('productSizes')
        ->orderBy('name','desc')
        ->paginate(12);

        $breadcrumb1 = "Sản phẩm";
        $breadcrumbLink1 = route('product');
        
        return view('client.product',[
            'products' => $products,
            'categories' => $categories,
            'titlePage' => $titlePage,
            'activeCategory' => $category,
            'breadcrumb1' => $breadcrumb1,
            'breadcrumbLink1' => $breadcrumbLink1
        ]);
    }

    public function showSubCategory($slugCategory,$slug){
        $category = Category::where('slug', $slugCategory)->firstOrFail();
        $subCategory = SubCategory::where('slug', $slug)->where('category_id', $category->id)->firstOrFail();
        $titlePage = $subCategory->name;

        $categories = Category::with(['subCategories' => function ($query) {
            $query->withCount('products');
        }])->orderBy('name', 'asc')->get();
        
        $products = Product::with(['productColors.productImages','productSizes','productColors.color'])
        ->where('sub_category_id', $subCategory->id)
        ->has('productColors')
        ->has('productSizes')
        ->orderBy('name','desc')
        ->paginate(12);

        $breadcrumb1 = "Sản phẩm";
        $breadcrumbLink1 =  route('product');
        $breadcrumb2 = $category->name;
        $breadcrumbLink2 = route('category',[$category->slug]);
        
        return view('client.product',[
            'products' => $products,
            'categories' => $categories,
            'titlePage' => $titlePage,
            'activeCategory' => $category,
            'activeSubCategory' => $subCategory,
            'breadcrumb1' => $breadcrumb1,
            'breadcrumbLink1' => $breadcrumbLink1,
            'breadcrumb2' => $breadcrumb2,
            'breadcrumbLink2' => $breadcrumbLink2
        ]);
    }
}
