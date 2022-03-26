<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


trait apiResponseTrait
{
    public function apiResponse($data= null,$message=null,$status=null){

        $array = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status
        ];
        return response($array);

    }
}
