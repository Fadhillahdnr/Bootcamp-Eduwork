<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // daftar semua order
    public function index()
    {
        $orders = Orders::with('items', 'user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // detail order
    public function show($id)
    {
        $order = Orders::with('items')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // update status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan diperbarui');
    }
}
