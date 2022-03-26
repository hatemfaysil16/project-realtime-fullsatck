<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Api\apiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\dependenciesResources;


class dependenciesController extends Controller
{
    use apiResponseTrait;

    public function showAll()
    {

        $date = json_decode(file_get_contents('../app/Http/Controllers/api/data_static/datadependencies.json'));

        foreach ($date as $key => $value) {
            $data = $value;
        }

        return $this->apiResponse(dependenciesResources::collection($data), 'is success data dependencies', true);

    }
}
