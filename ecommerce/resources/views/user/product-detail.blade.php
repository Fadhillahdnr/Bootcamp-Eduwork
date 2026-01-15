@extends('user.layouts.master')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/'.$product->image) }}"
                 class="img-fluid rounded">
        </div>

        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">
                Rp {{ number_format($product->price) }}
            </p>

            <p>{{ $product->description }}</p>

            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success mt-2">
                Tambah ke Keranjang
            </a>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">← Kembali</a>
        </div>
    </div>
</div>
@endsection
