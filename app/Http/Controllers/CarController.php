<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * get rental car info
     */
    public function get(){
        $data=DB::table('rental_cars_info')->select('*')->get();
        return response()->json(['result'=>'success','message'=>'Data Retrieved Successfully!','data'=>$data]);
    }
    /**
     * create rental car info
     *
     * @param  [string] car_company
     * @param  [string] modal
     * @param  [boolean] owner_name
     * @return [string] address
     * @return [string] vehicle_number
     */
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'car_company' => 'required|string',
            'modal' => 'required|string',
            'owner_name' => 'required|string',
            'address' => 'required|string',
            'vehicle_number' => 'required|string'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        DB::table('rental_cars_info')->insert([
            'car_company'=>$request->car_company,
            'modal'=>$request->modal,
            'owner_name'=>$request->owner_name,
            'address'=>$request->address,
            'vehicle_number'=>$request->vehicle_number
        ]);
        return response()->json(['result'=>'success','message'=>'Data Inserted Successfully!']);
    }
    /**
     * edit rental car info
     *
     * @param  [string] car_company
     * @return [string] vehicle_number
     */
    public function edit($company_name,$vehicle_number)
    {
        $validator = Validator::make([$company_name,$vehicle_number], [
            'car_company' => 'required|string',
            'vehicle_number' => 'required|string'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $data=DB::table('rental_cars_info')->select('*')->where(['car_company'=>$company_name,'vehicle_number'=>$vehicle_number])->first();
        return response()->json(['result'=>'success','message'=>'Edit Data','data'=>$data]);
    }
    /**
     * update rental car info
     *
     * @param  [string] car_company
     * @param  [string] modal
     * @param  [boolean] owner_name
     * @return [string] address
     * @return [string] vehicle_number
     */
    public function update(Request $request,$company_name,$vehicle_number)
    {
        $validator = Validator::make($request->all(), [
            'car_company' => 'required|string',
            'modal' => 'required|string',
            'owner_name' => 'required|string',
            'address' => 'required|string',
            'vehicle_number' => 'required|string'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $result=DB::table('rental_cars_info')->where(['car_company'=>$company_name,'vehicle_number'=>$vehicle_number])->update([
            'car_company'=>$request->car_company,
            'modal'=>$request->modal,
            'owner_name'=>$request->owner_name,
            'address'=>$request->address,
            'vehicle_number'=>$request->vehicle_number
        ]);
        return response()->json(['result'=>'success','message'=>'Data Updated Successfully','data'=>$result]);
    }
    /**
     * Delete rental car info
     *
     * @param  [string] car_company
     * @return [string] vehicle_number
     */
    public function delete($company_name,$vehicle_number){
        $result=DB::table('rental_cars_info')->where(['car_company'=>$company_name,'vehicle_number'=>$vehicle_number])->delete();
        if($result)
        return response()->json(['result'=>'success','message'=>'Deleted Successfully!','data'=>$result]);
        else
        return response()->json(['result'=>'failed','message'=>'No Record Found!']);  
    }
}
