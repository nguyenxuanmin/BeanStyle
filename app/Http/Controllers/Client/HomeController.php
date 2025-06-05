<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Benefit;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->limit(4)->get();
        $benefits = Benefit::orderBy('id','asc')->get();
        return view('client.index',[
            'sliders' => $sliders,
            'benefits' => $benefits
        ]);
    }
}
