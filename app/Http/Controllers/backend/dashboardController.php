<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index()
    {
        return view('backend.admin_dashboard');
    }
}
