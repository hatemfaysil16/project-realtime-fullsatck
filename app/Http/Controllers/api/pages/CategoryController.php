<?php

namespace App\Http\Controllers\api\pages;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoursesResources;
use App\Http\Resources\category;

use Illuminate\Http\Request;

use App\Models\Categories;
use App\Models\Courses;
use App\Http\Controllers\api\apiResponseTrait;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryController extends Controller
{

    use apiResponseTrait;


    public function show(Request $request,$id = null)
    {


        if($request->header('Authorization')) {
            $this->auth = JWTAuth::parseToken()->authenticate();

            if($id == null) {
            $Categories = Categories::all();
            return $this->apiResponse( category::collection($Categories),'is success',true);
        }else{

            // search data category with courses
            $courses = Courses::where('categories_id',$id)->get();
            if( count($courses)<=0 ){
               return $this->apiResponse(null,'is field data category with courses',false);
            }else{
               return $this->apiResponse( CoursesResources::collection($courses),'is success data category with courses',true);

            }
        }

        }else{
            if($id == null) {
                $Categories = Categories::all();
                return $this->apiResponse( category::collection($Categories),'is success',true);
            }else {

                // search data category with courses
                $courses = Courses::where('categories_id', $id)->get();
                if (count($courses) <= 0) {
                    return $this->apiResponse(null, 'is field data category with courses', false);
                } else {
                    return $this->apiResponse(CoursesResources::collection($courses), 'is success data category with courses', true);

                }
            }
        }


    }




}



