@extends('layouts.master')

@section('title','Checkout')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">

        {{-- KIRI: RINGKASAN PESANAN --}}
        <div class="col-md-6">
            <h5>Ringkasan Pesanan</h5>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp

                    @foreach ($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['qty'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $item['name'] }}</strong><br>
                                <small>Rp {{ number_format($item['price']) }}</small>
                            </td>
                            <td class="text-center">{{ $item['qty'] }}</td>
                            <td>Rp {{ number_format($subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-dark">
                        <th colspan="2">Total</th>
                        <th>Rp {{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        {{-- KANAN: DATA PEMBELI --}}
        <div class="col-md-6">
            <h5>Data Pembeli</h5>

            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address"
                              class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="phone"
                           class="form-control" required>
                </div>

                <button class="btn btn-success w-100">
                    Proses Checkout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
