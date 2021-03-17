<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function create(Request $request){
        DB::table('department')->insert([
            'DepartmentName'=>$request->DepartmentName,
            'DepartmentStatus'=>$request->DepartmentStatus
        ]);
        $data=DB::table('department')->select('*')->get();
        return response()->json(['message'=>"Saved Successfully!",'data'=>$data]);
    }
    public function get(){
        $data=DB::table('department')->where(['is_deleted'=>0])->select('*')->get();
        return response()->json(['message'=>"Retrived Successfully!",'data'=>$data]);
    }
    public function edit($id){
        $data=DB::table('department')->select('*')->where(['id'=>$id])->first();
        return view('edit')->with(['data'=>$data]);
    }
    public function update(Request $request,$id){
        $data=DB::table('department')->where(['id'=>$id])->update([
            'DepartmentName'=>$request->DepartmentName,
            'DepartmentStatus'=>$request->DepartmentStatus
        ]);
        return response()->json(['message'=>'success']);
    }
    public function delete($id){
        $data=DB::table('department')->where(['id'=>$id])->update([
            'is_deleted'=>1
        ]);
        return response()->json(['message'=>'success']);
    }
}
