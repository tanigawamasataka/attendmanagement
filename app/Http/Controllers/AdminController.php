<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function showAdminTop()
    {
        return view('admin/adminTop');
    }
}