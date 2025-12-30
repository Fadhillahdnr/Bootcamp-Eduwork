<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->latest()
            ->get();

        return view('user.dashboard', compact('products', 'categories'));
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

}
