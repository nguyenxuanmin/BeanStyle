<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Collection;
use App\Services\AdminService;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $collections = Collection::orderBy('id','asc')->paginate(20);
        return view('admin.collection.list',[
            'collections' => $collections,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm bộ sưu tập";
        $action = "add";
        return view('admin.collection.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa bộ sưu tập";
        $action = "edit";
        $collection = Collection::find($id);
        return view('admin.collection.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'collection' => $collection
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"]["name"];
        }else{
            $image = "";
        }
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên bộ sưu tập không được để trống.'
            ]);
        }

        if($action == "edit"){
            $collection = Collection::find($request->id);
        }else{
            if (empty($image)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hình ảnh bộ sưu tập không được để trống.'
                ]);
            }

            $collection = new Collection();
        }

        if (!empty($image)) {
            if($action == "edit"){
                $imagePath = 'collections/'.$collection->image;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $messageError = $this->adminService->generateImage($_FILES["image"],'collections');
            if($messageError != ""){
                return response()->json([
                    'success' => false,
                    'message' => $messageError
                ]);
            }
        }

        if (!$request->hasFile('image')) {
            $image = $collection->image;
        }
        
        $collection->name = $name;
        $collection->image = $image;
        $collection->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $collection = Collection::find($request->id);
        $imagePath = 'collections/'.$collection->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $collection->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $collections = Collection::where('name','LIKE','%'.$infoSearch.'%')->orderBy('id','asc')->paginate(20);
        
        return view('admin.collection.list',[
            'infoSearch' => $infoSearch,
            'collections' => $collections
        ]);
    }
}
