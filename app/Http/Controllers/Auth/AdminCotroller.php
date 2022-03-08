<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequestAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Providers\RouteServiceProvider;




class AdminCotroller extends Controller
{

    public function showlogin()
    {
        return view('auth.admin.admin_login');
    }

    public function login(LoginRequestAdmin $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Auth::guard('admin')->attempt([]);


        return redirect('/admin/login');
    }

    public function logout(Request $request)
    {
        // Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/' . App::getLocale(). '/admin/login');
    }

}


