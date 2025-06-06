<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Advertisement;
use App\Services\AdminService;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $advertisements = Advertisement::orderBy('id','asc')->paginate(20);
        return view('admin.advertisement.list',[
            'advertisements' => $advertisements,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm quảng cáo";
        $action = "add";
        return view('admin.advertisement.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa quảng cáo";
        $action = "edit";
        $advertisement = Advertisement::find($id);
        return view('admin.advertisement.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'advertisement' => $advertisement
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
            $advertisement = Advertisement::find($request->id);
        }else{
            if (empty($image)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hình ảnh quảng cáo không được để trống.'
                ]);
            }

            $advertisement = new Advertisement();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = 'advertisements/'.$advertisement->image;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'advertisements');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if (!$request->hasFile('image')) {
            $image = $advertisement->image;
        }
        
        $advertisement->name = $name;
        $advertisement->description = $description;
        $advertisement->image = $image;
        $advertisement->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $advertisement = Advertisement::find($request->id);
        $imagePath = 'advertisements/'.$advertisement->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $advertisement->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $advertisements = Advertisement::where('name','LIKE','%'.$infoSearch.'%')->orderBy('id','asc')->paginate(20);
        
        return view('admin.advertisement.list',[
            'infoSearch' => $infoSearch,
            'advertisements' => $advertisements
        ]);
    }
}
