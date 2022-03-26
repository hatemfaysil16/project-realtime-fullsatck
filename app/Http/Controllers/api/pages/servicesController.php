<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\servicesResources;
use App\Http\Controllers\api\apiResponseTrait;
use App\Models\Serves;

class servicesController extends Controller
{
    use apiResponseTrait;

    public function show($id = null)
    {

        if($id == null) {
            $Serves = Serves::all();
        return $this->apiResponse(servicesResources::collection($Serves),'is success data services',true);
        }else{
            $Serves = Serves::find($id);
            if($Serves)
            {
               return $this->apiResponse(new servicesResources($Serves),'is success data services',true);
            }else{
               return $this->apiResponse(null,'is field data services',false);
            }

        }


    }


}
