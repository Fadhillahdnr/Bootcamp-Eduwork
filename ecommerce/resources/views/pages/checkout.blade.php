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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                
                <div class="mb-3">
                    <label>Metode Pembayaran</label>

                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="payment_method"
                            value="transfer"
                            required>
                        <label class="form-check-label">
                            Transfer Bank
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="payment_method"
                            value="cod">
                        <label class="form-check-label">
                            COD (Bayar di Tempat)
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="payment_method"
                            value="ewallet">
                        <label class="form-check-label">
                            E-Wallet
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Proses Checkout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
