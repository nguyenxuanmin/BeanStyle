<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class ClientBlogController extends Controller
{
    public function show(){
        $blogs = Blog::orderBy('created_at','desc')->paginate(20);
        $titlePage = "Tin tức";
        return view('client.blog',[
            'blogs' => $blogs,
            'titlePage' => $titlePage
        ]);
    }

    public function detail($slug){
        $blog = Blog::where('slug',$slug)->firstOrFail();
        $titlePage = $blog->name;
        $breadcrumb1 = "Tin tức";
        $breadcrumbLink1 = route('blog');
        $otherBlogs = Blog::where('id','<>',$blog->id)->orderBy('created_at','desc')->limit(8)->get();
        return view('client.blog-detail',[
            'blog' => $blog,
            'titlePage' => $titlePage,
            'breadcrumb1' => $breadcrumb1,
            'breadcrumbLink1' => $breadcrumbLink1,
            'otherBlogs' => $otherBlogs
        ]);
    }
}
