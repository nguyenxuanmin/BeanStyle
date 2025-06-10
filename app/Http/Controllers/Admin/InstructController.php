<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instruct;
use App\Services\AdminService;

class InstructController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $instructs = Instruct::orderBy('name','asc')->paginate(20);
        return view('admin.instruct.list',[
            'instructs' => $instructs,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm hướng dẫn";
        $action = "add";
        return view('admin.instruct.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa hướng dẫn";
        $action = "edit";
        $instruct = Instruct::find($id);
        return view('admin.instruct.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'instruct' => $instruct
        ]);
    }

    public function save(Request $request){
        $name = $request->name;
        $slug = $this->adminService->generateSlug($name);
        $content = $request->content;
        $action = $request->action;

        if (empty($name)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề hướng dẫn không được để trống.'
            ]);
        }

        if($action == "edit"){
            $instructExist = Instruct::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $instructExist = Instruct::where('slug',$slug)->first();
        }
        
        if (isset($instructExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề hướng dẫn đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $instruct = Instruct::find($request->id);
        }else{
            $instruct = new Instruct();
        }
        
        $instruct->name = $name;
        $instruct->slug = $slug;
        $instruct->content = $content;
        $instruct->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $instruct = Instruct::find($request->id);
        $instruct->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $instructs = Instruct::where('name','LIKE','%'.$infoSearch.'%')->orderBy('name','asc')->paginate(20);
        return view('admin.instruct.list',[
            'infoSearch' => $infoSearch,
            'instructs' => $instructs
        ]);
    }
}
