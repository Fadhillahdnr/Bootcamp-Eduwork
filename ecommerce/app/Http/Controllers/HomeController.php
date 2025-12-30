<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('user.dashboard', compact('products'));
    }

    public function product(){
        return view('pages.product');
    }
    
    public function show($id){
        $product = Product::findOrFail($id);
        return view('user.product-detail', compact('product'));
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
