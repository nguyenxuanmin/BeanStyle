<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Benefit;
use App\Services\AdminService;

class BenefitController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $benefits = Benefit::orderBy('id','asc')->paginate(20);
        return view('admin.benefit.list',[
            'benefits' => $benefits,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm lợi ích";
        $action = "add";
        return view('admin.benefit.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa lợi ích";
        $action = "edit";
        $benefit = Benefit::find($id);
        return view('admin.benefit.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'benefit' => $benefit
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $description = $request->description;
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
        $action = $request->action;

        if($action == "edit"){
            $benefit = Benefit::find($request->id);
        }else{
            if (empty($image)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hình ảnh lợi ích không được để trống.'
                ]);
            }

            $benefit = new Benefit();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = 'benefits/'.$benefit->image;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'benefits');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if (!$request->hasFile('image')) {
            $image = $benefit->image;
        }
        
        $benefit->name = $name;
        $benefit->description = $description;
        $benefit->image = $image;
        $benefit->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $benefit = Benefit::find($request->id);
        $imagePath = 'benefits/'.$benefit->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $benefit->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $benefits = Benefit::where('name','LIKE','%'.$infoSearch.'%')->orderBy('id','asc')->paginate(20);
        
        return view('admin.benefit.list',[
            'infoSearch' => $infoSearch,
            'benefits' => $benefits
        ]);
    }
}
