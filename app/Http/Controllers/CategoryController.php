<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Utils;

class CategoryController extends Controller
{
    public function all(){
        //liet ke tat ca category trong Db
        $categories = DB::table("categories")->get();
//        var_dump($categories);die("a");
//        dd($categories);
        return view("category.list",[
            "categories"=>$categories
        ]);
    }

    public function form(){
        return view("category.form");
    }

    public function save(Request $request){
        //request se nhan du lieu gui len
        $data = $request->all();
//        dd($request);
        $n= $request->get("name");
        $now=Carbon::now();
        DB::table("categories")->insert([
           "name"=>$n,
            "created_at"=>$now,
            "updated_at"=>$now
        ]);
        return redirect()->to("categories");
    }

    public function edit($id){
        $cat = DB::table("categories")->where("id",$id)->first();//tra ve null neu k co
        if ($cat == null)return redirect()->to("categories");
        return view("category.edit",[
           "cat"=>$cat
        ]);
    }

    public function update(Request $request,$id){
        $cat = DB::table("categories")->where("id",$id)->first();
        if ($cat == null) return redirect()->to("categories");
        DB::table("categories")->where("id",$id)->update([
           "name"=>$request->get("name"),
            "update_at"=>Carbon::now()
        ]);
        return redirect()->to("categories");
    }
}