<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;



class AdminController extends Controller
{
    public function index(){
        return view('admin.home.index');
    }

    public function login(){
        return view('admin.users.login');
    }
}
