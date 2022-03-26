<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\studentsResources;
use App\Http\Controllers\api\apiResponseTrait;


class studentsController extends Controller
{
    use apiResponseTrait;

    public function showAll(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/datastudents.json'));

        foreach ($date as $key => $value) {
            $data=$value;
        }
          return $this->apiResponse(studentsResources::collection($data),'is success data students',true);

}}
