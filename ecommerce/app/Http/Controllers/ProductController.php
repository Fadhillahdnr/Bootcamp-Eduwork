<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category');

        if ($request->category) {
            $products->where('category_id', $request->category);
        }

        $products = $products->paginate(9);

        return view('admin.products.index', compact('products', 'categories'));
    }


    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect('/admin/products')
            ->with('success', 'Produk berhasil ditambahkan');
    }


    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only('name', 'description', 'price');

        // Jika admin upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')
                                    ->store('products', 'public');
        }

        $product->update($data);

        return redirect('/admin/products')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Produk dihapus');
    }
}
