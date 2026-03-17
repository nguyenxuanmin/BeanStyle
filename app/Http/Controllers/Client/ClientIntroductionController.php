<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\WhyChooseUsItem;

class ClientIntroductionController extends Controller
{
    public function show(){
        $aboutUs = AboutUs::first();
        $whyChooseUsItems = WhyChooseUsItem::all();
        $titlePage = "Giới thiệu";
        return view('client.introduction',[
            'aboutUs' => $aboutUs,
            'whyChooseUsItems' => $whyChooseUsItems,
            'titlePage' => $titlePage
        ]);
    }
}
