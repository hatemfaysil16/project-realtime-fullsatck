<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use App\Http\Resources\instructorsResources;
use App\Models\Instructors;
use Illuminate\Http\Request;
use App\Http\Controllers\api\apiResponseTrait;


class instructorsController extends Controller
{

    use apiResponseTrait;

    public function show($id = null){



        if($id == null) {
            $Instructors = Instructors::all();

            // return $Instructors;die;
            return $this->apiResponse(instructorsResources::collection($Instructors),'is success Instructors',true);
        }else{
            $Instructors = Instructors::find($id);
            if($Instructors)
            {
                return $this->apiResponse(new instructorsResources($Instructors),'is success Instructors',true);
            }else{
                return $this->apiResponse([],'is error data Instructors',false);
            }

        }



    }

}




