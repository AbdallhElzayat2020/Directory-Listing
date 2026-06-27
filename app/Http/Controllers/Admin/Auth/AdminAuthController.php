<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function LoginForm(): View
    {
        return view('admin.auth.login');
    }


    public function passwordRequest()
    {
        return view('admin.auth.forget-password');
   }
}
