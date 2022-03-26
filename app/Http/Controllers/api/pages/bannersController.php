<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use App\Http\Resources\bannersResources;
use App\Http\Controllers\api\apiResponseTrait;
class bannersController extends Controller
{
    use apiResponseTrait;

    public function showAll(){

        $date=json_decode(file_get_contents('../app/Http/Controllers/api/data_static/databanners.json'));

        foreach ($date as $key => $value) {
            $data=$value;
            // foreach ($value as $key => $a) {
            //     $b=($a);
            // }
        }
          return $this->apiResponse(bannersResources::collection($data),'is success data banners',true);

}}

