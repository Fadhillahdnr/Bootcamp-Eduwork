@extends('layouts.admin.master')

@section('title','Detail Pesanan')

@section('content')
<div class="container">
    <h3>Detail Pesanan #{{ $order->id }}</h3>

    <p><b>Nama:</b> {{ $order->name }}</p>
    <p><b>Alamat:</b> {{ $order->address }}</p>
    <p><b>Telepon:</b> {{ $order->phone }}</p>

    <hr>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>Rp {{ number_format($item->price) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: Rp {{ number_format($order->total) }}</h4>

    <hr>

    <form method="POST"
          action="{{ route('admin.orders.status', $order->id) }}">
        @csrf
        <label>Status Pesanan</label>
        <select name="status" class="form-control w-25">
            <option value="diproses">Diproses</option>
            <option value="dikirim">Dikirim</option>
            <option value="selesai">Selesai</option>
        </select>

        <button class="btn btn-success mt-2">
            Update Status
        </button>
    </form>
</div>
@endsection
