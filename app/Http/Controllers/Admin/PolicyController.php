<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;
use App\Services\AdminService;

class PolicyController extends Controller
{
    public function __construct()
    {
        $this->adminService = new AdminService;
    }

    public function show(){
        $policies = Policy::orderBy('name','asc')->paginate(20);
        return view('admin.policy.list',[
            'policies' => $policies,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm chính sách";
        $action = "add";
        return view('admin.policy.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa chính sách";
        $action = "edit";
        $policy = Policy::find($id);
        return view('admin.policy.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'policy' => $policy
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
                'message' => 'Tiêu đề chính sách không được để trống.'
            ]);
        }

        if($action == "edit"){
            $policyExist = Policy::where('slug',$slug)->where('id','<>',$request->id)->first();
        }else{
            $policyExist = Policy::where('slug',$slug)->first();
        }
        
        if (isset($policyExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiêu đề chính sách đã tồn tại.'
            ]);
        }

        if($action == "edit"){
            $policy = Policy::find($request->id);
        }else{
            $policy = new Policy();
        }
        
        $policy->name = $name;
        $policy->slug = $slug;
        $policy->content = $content;
        $policy->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $policy = Policy::find($request->id);
        $policy->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $policies = Policy::where('name','LIKE','%'.$infoSearch.'%')->orderBy('name','asc')->paginate(20);
        return view('admin.policy.list',[
            'infoSearch' => $infoSearch,
            'policies' => $policies
        ]);
    }
}
