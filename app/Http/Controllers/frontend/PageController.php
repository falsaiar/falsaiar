<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    // Front Page
     public function index()
    {
        return view('frontend.index');
    }

    // Register Page
     public function register()
    {
        return view('frontend.register');
    }

    
}
