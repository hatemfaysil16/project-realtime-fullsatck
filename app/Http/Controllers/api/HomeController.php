<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\dependenciesResources;
use Illuminate\Http\Request;
use App\Http\Resources\category;
use App\Http\Resources\competitionsResources;
use App\Http\Resources\instructorsResources;
use App\Http\Resources\offersResources;
use App\Http\Resources\servicesResources;
use App\Http\Resources\studentsResources;
use App\Http\Resources\VideoResources;
use App\Http\Resources\bannersResources;
use App\Models\Categories;
use App\Models\Instructors;
use App\Models\Serves;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use apiResponseTrait;

    public function showAllPages()
    {
       $banners =  $this->banners();
       $Category =  $this->Category();
       $competitons =  $this->competitons();
       $instructors =  $this->instructors();
       $offers =  $this->offers();
       $students =  $this->students();
       $Video =  $this->Video();
       $services =  $this->services();



       $all = ['banners'=>$banners,'Category'=>$Category,'competitons'=>$competitons,'instructors'=>$instructors,'offers'=>$offers,'students'=>$students,'services'=>$services,'Video'=>$Video];

       if($all)
       {
        return $this->apiResponse($all,'is all data Home is success',true);
       }else{
        return $this->apiResponse(null,'is not success',true);
       }

    }



    public function banners(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/databanners.json'));

        foreach ($date as $key => $value) {
           return  $value;
        }
    }



   public function Category(){

        $category =  Categories::all();
        if($category)
        {
           return  $data=  category::collection($category);

        }

    }

    public function competitons(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/datacompetitions.json'));

        foreach ($date as $key => $value) {
            $data=$value;
           return  $data= $data;
        }

    }

    public function instructors(){

        $Instructors =  Instructors::all();
        if($Instructors)
        {
            return   $data=  instructorsResources::collection($Instructors);

        }

    }

    public function offers(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/dataoffers.json'));

        foreach ($date as $key => $offers) {
        return $offers;
        }

    }

    public function services(){
        $Serves =  Serves::all();
        if($Serves)
        {
           return  $data=  servicesResources::collection($Serves);

        }
    }


    public function students(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/datastudents.json'));

        foreach ($date as $key => $students) {
        return $students;

        }

    }

    public function Video(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/dataVideo.json'));

        foreach ($date as $key => $Video) {
           return VideoResources::collection($Video);
        }

    }

}
