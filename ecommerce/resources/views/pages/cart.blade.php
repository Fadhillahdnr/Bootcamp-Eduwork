@extends('layouts.master')

@section('title','Keranjang')

@section('content')
<div class="container my-4">
    <h2>Keranjang Belanja</h2>

    @if (session('cart'))
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach ($cart as $id => $item)
                    @php
                        $total = $item['price'] * $item['qty'];
                        $grandTotal += $total;
                    @endphp

                    <tr>
                        <td>
                            <img src="{{ asset('storage/'.$item['image']) }}"
                                 width="60" class="me-2">
                            {{ $item['name'] }}
                        </td>
                        <td>Rp {{ number_format($item['price']) }}</td>
                        <td class="text-center">
                            <a href="{{ route('cart.decrease', $id) }}"
                            class="btn btn-sm btn-outline-secondary">−</a>

                            <span class="mx-2">{{ $item['qty'] }}</span>

                            <a href="{{ route('cart.increase', $id) }}"
                            class="btn btn-sm btn-outline-secondary">+</a>
                        </td>
                        <td>Rp {{ number_format($total) }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}"
                               class="btn btn-danger btn-sm">
                               Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <th colspan="3">Total</th>
                    <th colspan="2">Rp {{ number_format($grandTotal) }}</th>
                </tr>
            </tbody>
        </table>
    @else
        <p>Keranjang masih kosong</p>
    @endif
</div>
@endsection
