<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AboutUs;
use App\Services\AdminService;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $aboutUs = AboutUs::first();
        return view('admin.about-us.main',[
            'aboutUs' => $aboutUs
        ]);
    }

    public function save(Request $request){
        $title = $request->title;
        $description = $request->description;
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }

        $aboutUs = AboutUs::find($request->id);
        if (!$aboutUs) {
            $aboutUs = new AboutUs;
        }

        if (!empty($image)) {
            $imagePath = 'about-us/image/'.$aboutUs->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'about-us/image');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }else{
            $image = $aboutUs->image;
        }
        
        $aboutUs->title = $title;
        $aboutUs->description = $description;
        $aboutUs->image = $image;
        $aboutUs->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }
}
