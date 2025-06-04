<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->limit(4)->get();
        return view('client.index',[
            'sliders' => $sliders
        ]);
    }
}
