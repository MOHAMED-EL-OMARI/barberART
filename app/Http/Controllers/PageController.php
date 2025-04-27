<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    public function showLogin() 
    {
        return view('pages.login');
    }
    public function showRegister() 
    {
        return view('pages.register');
    }
    public function register() 
    {
        
    }
}