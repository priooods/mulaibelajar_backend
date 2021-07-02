<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function validing($request,$items){
        $validate = Validator::make($request,$items);
        if ($validate->fails()) {
            return $this->resFailed(1,$validate->errors()->all());
        }else
            return null;
    }
    protected function resPage($data){
        return response()->json([
            'error_code' => 0,
            'data' => $data->getCollection(),
            'pages' => [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage()
                ]
            ], 200, [], JSON_NUMERIC_CHECK);
    }
    public function resSuccess($data){
        return response()->json([
            'error_code' => 0,
            'error_message' => "",
            'data' => $data
        ], 200, [], JSON_NUMERIC_CHECK);
    }
    public function resUserSuccess($data){
        $data->password_verified = Crypt::decrypt($data->password_verified);
        return response()->json([
            'error_code' => 0,
            'error_message' => "",
            'data' => $data
        ], 200, [], JSON_NUMERIC_CHECK);
    }
    public function resFailed($code,$error){
        if (is_array($error))
            $error = implode(",",$error);
        return response()->json([
            'error_code' => $code,
            'error_message' => $error
        ]);
    }
    public function unlink_file($name){
        if ($name==null)
            return;
        $file_loc = public_path("files\\") . $name;
        if (file_exists($file_loc)){
            unlink($file_loc);
        }
    }
}
