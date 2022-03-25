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
use App\Http\Controllers\backend\MapController;
use App\Http\Controllers\backend\ContactUsController;
use App\Http\Controllers\backend\PricingController;
use App\Http\Controllers\backend\LogoController;
use App\Http\Controllers\backend\portfolioController;


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


        // map
        Route::prefix('map')->group(function(){
            Route::get('/', [MapController::class, 'index'])->name('map.index');
            Route::get('fetch-Data', [MapController::class, 'fetchData']);
            Route::get('edit/{id}', [MapController::class, 'edit']);
            Route::post('store', [MapController::class, 'store']);
            Route::post('update/{id}', [MapController::class, 'update']);
            Route::delete('delete/{id}', [MapController::class, 'destroy']);
        });

        // ContactUs
        Route::prefix('ContactUs')->group(function(){
            Route::get('/', [ContactUsController::class, 'index'])->name('ContactUs.index');
            Route::get('fetch-Data', [ContactUsController::class, 'fetchData']);
            Route::get('edit/{id}', [ContactUsController::class, 'edit']);
            Route::post('store', [ContactUsController::class, 'store']);
            Route::post('update/{id}', [ContactUsController::class, 'update']);
            Route::delete('delete/{id}', [ContactUsController::class, 'destroy']);
        });

        // price
        Route::prefix('price')->group(function(){
            Route::get('/', [PricingController::class, 'index'])->name('price.index');
            Route::get('fetch-Data', [PricingController::class, 'fetchData']);
            Route::get('edit/{id}', [PricingController::class, 'edit']);
            Route::post('store', [PricingController::class, 'store']);
            Route::post('update/{id}', [PricingController::class, 'update']);
            Route::delete('delete/{id}', [PricingController::class, 'destroy']);
        });

        // logo
        Route::prefix('logo')->group(function(){
            Route::get('/', [LogoController::class, 'index'])->name('logo.index');
            Route::get('fetch-Data', [LogoController::class, 'fetchData']);
            Route::get('edit/{id}', [LogoController::class, 'edit']);
            Route::post('store', [LogoController::class, 'store']);
            Route::post('update/{id}', [LogoController::class, 'update']);
            Route::delete('delete/{id}', [LogoController::class, 'destroy']);
        });


        // portfolio
        Route::prefix('portfolio')->group(function(){
            Route::get('/', [portfolioController::class, 'index'])->name('portfolio.index');
            Route::get('fetch-Data', [portfolioController::class, 'fetchData']);
            Route::get('edit/{id}', [portfolioController::class, 'edit']);
            Route::post('store', [portfolioController::class, 'store']);
            Route::post('update/{id}', [portfolioController::class, 'update']);
            Route::delete('delete/{id}', [portfolioController::class, 'destroy']);
        });

        Route::get('fetchData',[portfolioController::class,'fetchData']);
        Route::get('/multi/image',[portfolioController::class,'MultPic'])->name('multi.image');
        Route::post('/multi/add',[portfolioController::class,'storeImg'])->name('store.image');
        Route::get('/multi/delete/{id}',[portfolioController::class,'deleteMulti'])->name('delete.multi');
        
        
        
        //mail
        Route::get('mail', [MailController::class,'index'])->name('mail');
        Route::post('sendMail', [MailController::class,'sendMail'])->name('sendMail');





    });
    // end admin dashboard



        require __DIR__.'/auth.php';




    });



