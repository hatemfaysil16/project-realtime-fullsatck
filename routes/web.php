<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\InstructorsController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\CoursesController;
use App\Http\Controllers\backend\CertificatesCountroller;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\ServesController;
use App\Http\Controllers\backend\MediaCenterController;
use App\Http\Controllers\backend\ContactwithCoursesController;
use App\Http\Controllers\backend\MailController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
        Route::get('Categories', [CategoriesController::class, 'index'])->name('Categories.index');
        Route::get('fetch-Data', [CategoriesController::class, 'fetchData']);
        Route::get('edit-category/{id}', [CategoriesController::class, 'edit']);
        Route::post('Categories/store', [CategoriesController::class, 'store']);
        Route::post('category-update/{id}', [CategoriesController::class, 'update']);
        Route::delete('delete-student/{id}', [CategoriesController::class, 'destroy']);


        //mail
        Route::get('mail', [MailController::class,'index'])->name('mail');
        Route::post('sendMail', [MailController::class,'sendMail'])->name('sendMail');




    });
    // end admin dashboard



        require __DIR__.'/auth.php';




    });



