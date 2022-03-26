<?php

use App\Http\Controllers\api\pages\settingController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\auth\AuthController;

use App\Http\Controllers\api\pages\PostController;
use App\Http\Controllers\api\pages\CategoryController;
use App\Http\Controllers\api\pages\instructorsController;
use App\Http\Controllers\api\pages\bannersController;
use App\Http\Controllers\api\pages\VideoController;
use App\Http\Controllers\api\pages\servicesController;
use App\Http\Controllers\api\pages\competitonsController;
use App\Http\Controllers\api\pages\offersController;
use App\Http\Controllers\api\pages\studentsController;
use App\Http\Controllers\api\pages\dependenciesController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\pages\ContactUsController;
use App\Http\Controllers\api\pages\CertificatesController;
use App\Http\Controllers\api\pages\CoursesController;
use App\Http\Controllers\api\pages\FavoriteController;
use App\Http\Controllers\api\pages\ContactwithCoursesController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    //start auth
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/update', [AuthController::class,'updateUsers']);
    //End auth
});


