<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\ProductViewed;

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
            ->paginate(8);

        return view('user.dashboard', compact('products', 'categories'));
    }

    public function product(){
        return view('pages.product');
    }
    
    
    public function show($id)
    {
        // Ambil produk
        $product = Product::findOrFail($id);

        // Tambah click produk
        $product->increment('click_count');

        // Hitung total klik semua produk
        $totalClicks = Product::sum('click_count');

        // Broadcast ke dashboard admin
        broadcast(new ProductViewed($totalClicks))->toOthers();

        // Tampilkan detail produk (USER)
        return view('user.product-detail', compact('product'));
    }

    public function about(){
        return view('pages.about');
    }
    
    public function cart(){
        return view('pages.cart');
    }

}
