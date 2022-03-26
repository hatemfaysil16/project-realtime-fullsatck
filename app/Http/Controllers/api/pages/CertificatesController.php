<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use App\Models\Certificates;
use Illuminate\Http\Request;
use App\Http\Controllers\api\apiResponseTrait;


class CertificatesController extends Controller
{
    use apiResponseTrait;
    public function search($id)
    {
        $Certificates = Certificates::where('serial', 'like' , "{$id}")->orderBy('created_at', 'desc')->get();

        if( count($Certificates)<=0  ){
            return $this->apiResponse($Certificates,'لاء توجد شهادة',false);
        }else{
            return $this->apiResponse($Certificates,'تم تحديد الشهادة',true);
        }


    }
}


