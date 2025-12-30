@extends('layouts.admin.master')

@section('title','Daftar Pesanan')

@section('content')
<div class="container"> 
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Daftar Pesanan</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
            ← Kembali
        </a>    
    </div>
    

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>Rp {{ number_format($order->total) }}</td>
                    <td>{{ strtoupper($order->payment_method) }}</td>
                    <td>
                        <span class="badge bg-info">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="btn btn-sm btn-primary">
                           Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
