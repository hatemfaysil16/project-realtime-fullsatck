<?php

namespace App\Http\Controllers\api\pages;
use App\Http\Controllers\api\apiResponseTrait;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoursesResources;
use App\Models\Courses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CoursesController extends Controller
{
    use apiResponseTrait;




    public function show(Request $request, $id = null)
    {


        if($request->header('Authorization')) {
            $this->auth = JWTAuth::parseToken()->authenticate();



            if($id == null) {
                $courses = courses::all();
                return $this->apiResponse(CoursesResources::collection($courses),'is success data courses',true);
            }else{
                $courses = courses::find($id);
                if($courses)
                {
                    return $this->apiResponse(new CoursesResources($courses),'is success data courses',true);
                }else{
                    return $this->apiResponse([],'is field data courses',false);
                }

            }




        }else{


            if($id == null) {
                $courses = courses::all();
                return $this->apiResponse(CoursesResources::collection($courses),'is success data courses',true);
            }else{
                $courses = courses::find($id);
                if($courses)
                {
                    return $this->apiResponse(new CoursesResources($courses),'is success data courses',true);
                }else{
                    return $this->apiResponse([],'is field data courses',false);
                }
            }

        }

    }



    public function search(Request $request,$id)
    {

        if($request->header('Authorization')) {
            $this->auth = JWTAuth::parseToken()->authenticate();

            $Courses = Courses::where('name', 'like' , "%{$id}%")->orderBy('created_at', 'desc')->get();

            if( count($Courses)<=0  ){
                return $this->apiResponse(CoursesResources::collection($Courses) ,'لاء توجد كورس',true);
            }else{
                return $this->apiResponse(CoursesResources::collection($Courses),' توجد كورس',true);
            }




        }else{

            $Courses = Courses::where('name', 'like' , "%{$id}%")->orderBy('created_at', 'desc')->get();

            if( count($Courses)<=0  ){
                return $this->apiResponse(CoursesResources::collection($Courses) ,'لاء توجد كورس',true);
            }else{
                return $this->apiResponse(CoursesResources::collection($Courses),' توجد كورس',true);
            }




        }









    }

}



