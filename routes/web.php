<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\OurTeamController;
use App\Http\Controllers\backend\ServicesController;
use App\Http\Controllers\backend\AboutUsController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\MailController;
use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\FeaturesController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        //start route

        Route::get('/admin', function () {
            return redirect()->route('login.admin');
        });
        Route::get('/', function () {
            return redirect()->route('login.admin');
        });



    // start admin dashboard
    Route::group(
        [
            'prefix' => 'admin',
            'middleware' => 'auth:admin',
        ], function(){ //...

        //index
        Route::get('/dashboard', [dashboardController::class,'index'])->name('admin_dashboard');
        //roles
        Route::resource('roles', RoleController::class);
        //users
        Route::resource('users', UserController::class);


        // Categories
        Route::prefix('category')->group(function(){
            Route::get('/', [CategoriesController::class, 'index'])->name('Categories.index');
            Route::get('fetch-Data', [CategoriesController::class, 'fetchData']);
            Route::get('edit/{id}', [CategoriesController::class, 'edit']);
            Route::post('store', [CategoriesController::class, 'store']);
            Route::post('update/{id}', [CategoriesController::class, 'update']);
            Route::delete('delete/{id}', [CategoriesController::class, 'destroy']);
        });



        // slider
        Route::prefix('slider')->group(function(){
            Route::get('/', [SliderController::class, 'index'])->name('slider.index');
            Route::get('fetch-Data', [SliderController::class, 'fetchData']);
            Route::get('edit/{id}', [SliderController::class, 'edit']);
            Route::post('store', [SliderController::class, 'store']);
            Route::post('update/{id}', [SliderController::class, 'update']);
            Route::delete('delete/{id}', [SliderController::class, 'destroy']);
        });

        // OurTeam
        Route::prefix('OurTeam')->group(function(){
            Route::get('/', [OurTeamController::class, 'index'])->name('OurTeam.index');
            Route::get('fetch-Data', [OurTeamController::class, 'fetchData']);
            Route::get('edit/{id}', [OurTeamController::class, 'edit']);
            Route::post('store', [OurTeamController::class, 'store']);
            Route::post('update/{id}', [OurTeamController::class, 'update']);
            Route::delete('delete/{id}', [OurTeamController::class, 'destroy']);
        });

        // services
        Route::prefix('services')->group(function(){
            Route::get('/', [ServicesController::class, 'index'])->name('services.index');
            Route::get('fetch-Data', [ServicesController::class, 'fetchData']);
            Route::get('edit/{id}', [ServicesController::class, 'edit']);
            Route::post('store', [ServicesController::class, 'store']);
            Route::post('update/{id}', [ServicesController::class, 'update']);
            Route::delete('delete/{id}', [ServicesController::class, 'destroy']);
        });

        // aboutUs
        Route::prefix('aboutUs')->group(function(){
            Route::get('/', [AboutUsController::class, 'index'])->name('aboutUs.index');
            Route::get('fetch-Data', [AboutUsController::class, 'fetchData']);
            Route::get('edit/{id}', [AboutUsController::class, 'edit']);
            Route::post('store', [AboutUsController::class, 'store']);
            Route::post('update/{id}', [AboutUsController::class, 'update']);
            Route::delete('delete/{id}', [AboutUsController::class, 'destroy']);
        });


        // question
        Route::prefix('question')->group(function(){
            Route::get('/', [QuestionController::class, 'index'])->name('question.index');
            Route::get('fetch-Data', [QuestionController::class, 'fetchData']);
            Route::get('edit/{id}', [QuestionController::class, 'edit']);
            Route::post('store', [QuestionController::class, 'store']);
            Route::post('update/{id}', [QuestionController::class, 'update']);
            Route::delete('delete/{id}', [QuestionController::class, 'destroy']);
        });


        // features
        Route::prefix('features')->group(function(){
            Route::get('/', [FeaturesController::class, 'index'])->name('features.index');
            Route::get('fetch-Data', [FeaturesController::class, 'fetchData']);
            Route::get('edit/{id}', [FeaturesController::class, 'edit']);
            Route::post('store', [FeaturesController::class, 'store']);
            Route::post('update/{id}', [FeaturesController::class, 'update']);
            Route::delete('delete/{id}', [FeaturesController::class, 'destroy']);
        });




        //mail
        Route::get('mail', [MailController::class,'index'])->name('mail');
        Route::post('sendMail', [MailController::class,'sendMail'])->name('sendMail');




    });
    // end admin dashboard



        require __DIR__.'/auth.php';




    });



