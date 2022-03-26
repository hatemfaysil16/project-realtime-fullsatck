<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\api\apiResponseTrait;


class settingController extends Controller
{
    use apiResponseTrait;

    public function showAll()
    {
            $settings = settings('about_us', '');
            return $this->apiResponse($settings,'is success data settings',true);
    }

}
