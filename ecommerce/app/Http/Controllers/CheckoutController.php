<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout
     */
    public function index()
    {
        $cart = session('cart', []);
        return view('pages.checkout', compact('cart'));
    }

    /**
     * Proses checkout
     */
    public function process(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'payment_method' => 'required',
        ]);

        // ✅ Ambil cart dari session
        $cart = session('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart')
                ->with('error', 'Keranjang masih kosong');
        }

        // ✅ Tentukan status order
        $status = $request->payment_method === 'cod'
            ? 'diproses'
            : 'menunggu pembayaran';

        // ✅ Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // ✅ Simpan order
        $order = Orders::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => $status
        ]);

        // ✅ Simpan item pesanan
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        // ✅ Hapus cart
        session()->forget('cart');

        // ✅ Redirect agar tidak blank
        return redirect()->route('user.dashboard')
            ->with('success', 'Pesanan berhasil dibuat');
    }
}
