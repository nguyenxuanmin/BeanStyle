<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Services\AdminService;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $colors = Color::orderBy('name','asc')->paginate(20);
        return view('admin.color.list',[
            'colors' => $colors,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm màu sắc";
        $action = "add";
        return view('admin.color.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa màu sắc";
        $action = "edit";
        $color = Color::find($id);
        return view('admin.color.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'color' => $color
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $colorCode = $request->code;
        $action = $request->action;
        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên màu sắc không được để trống.'
            ]);
        }

        if($action == "edit"){
            $colorExist = Color::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $colorExist = Color::where('slug',$slug)->first();
        }
        
        if (isset($colorExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên màu sắc đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $color = Color::find($request->id);
        }else{
            $color = new Color();
        }
        
        $color->name = $name;
        $color->slug = $slug;
        $color->color_code = $colorCode;
        $color->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $color = Color::find($request->id);
        $color->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $colors = Color::where('name','LIKE','%'.$infoSearch.'%')->orderBy('name','asc')->paginate(20);

        return view('admin.color.list',[
            'infoSearch' => $infoSearch,
            'colors' => $colors
        ]);
    }
}
