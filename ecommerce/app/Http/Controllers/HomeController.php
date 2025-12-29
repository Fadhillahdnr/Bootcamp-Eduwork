<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pages.beranda');
    }

    public function product(){
        return view('pages.product');
    }
    
    public function about(){
        return view('pages.about');
    }
    
    public function cart(){
        return view('pages.cart');
    }

    public function checkout(){
        return view('pages.checkout');
    }
}
