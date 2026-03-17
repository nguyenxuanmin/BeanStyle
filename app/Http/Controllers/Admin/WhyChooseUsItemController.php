<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhyChooseUsItem;

class WhyChooseUsItemController extends Controller
{

    public function show(){
        $whyChooseUsItems = WhyChooseUsItem::orderBy('created_at','asc')->paginate(20);
        return view('admin.why-choose-us.list',[
            'whyChooseUsItems' => $whyChooseUsItems,
            'infoSearch' => ''
        ]);
    }

    public function add(){
        $titlePage = "Thêm tại sao chọn chúng tôi";
        $action = "add";
        return view('admin.why-choose-us.main',[
            'titlePage' => $titlePage,
            'action' => $action
        ]);
    }

    public function edit($id){
        $titlePage = "Sửa tại sao chọn chúng tôi";
        $action = "edit";
        $whyChooseUsItem = WhyChooseUsItem::find($id);
        return view('admin.why-choose-us.main',[
            'titlePage' => $titlePage,
            'action' => $action,
            'whyChooseUsItem' => $whyChooseUsItem
        ]);
    }

    public function save(Request $request){
        $title = $request->title;
        $description = $request->description;
        $action = $request->action;

        if($action == "edit"){
            $whyChooseUsItem = WhyChooseUsItem::find($request->id);
        }else{
            $whyChooseUsItem = new WhyChooseUsItem();
        }
        
        $whyChooseUsItem->title = $title;
        $whyChooseUsItem->description = $description;
        $whyChooseUsItem->save();

        return response()->json([
            'success' => true,
            'message' => ""
        ]);
    }

    public function delete(Request $request){
        $whyChooseUsItem = WhyChooseUsItem::find($request->id);
        $whyChooseUsItem->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function search(Request $request){
        $infoSearch = $request->search;
        $whyChooseUsItems = WhyChooseUsItem::where('title','LIKE','%'.$infoSearch.'%')->orderBy('created_at','asc')->paginate(20);

        return view('admin.why-choose-us.list',[
            'infoSearch' => $infoSearch,
            'whyChooseUsItems' => $whyChooseUsItems
        ]);
    }
}
