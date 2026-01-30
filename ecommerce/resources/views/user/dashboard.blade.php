@php
    use Illuminate\Support\Str;
@endphp

@extends('user.layouts.master')

@section('title','Beranda')

@section('content')

@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

{{-- HEADER --}}
<div class="col-12 text-center my-5">
    <h1 class="fw-bold">Selamat Datang Di Toko Kami</h1>
    <p class="lead text-muted">Temukan produk terbaik kami di sini</p>
</div>

{{-- FILTER CATEGORY --}}
<form method="GET" action="{{ route('user.dashboard') }}" class="mb-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <select name="category" class="form-select shadow-sm"
                onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

{{-- PRODUCT CARD --}}
<div class="row justify-content-center g-4">
    @foreach ($products as $product)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card product-card h-100 border-0 shadow-sm">

                {{-- IMAGE --}}
                <div class="position-relative">
                    <img src="{{ asset('storage/'.$product->image) }}"
                         class="card-img-top product-img">

                    {{-- CATEGORY --}}
                    <span class="badge bg-dark position-absolute top-0 start-0 m-3 px-3 py-2">
                        {{ $product->category->name }}
                    </span>

                    {{-- VIEWS --}}
                    <span class="badge bg-light text-dark position-absolute top-0 end-0 m-3 px-3 py-2 shadow-sm">
                        <i class="bi bi-eye"></i>
                        {{ number_format($product->views ?? 0) }}
                    </span>
                </div>

                {{-- BODY --}}
                <div class="card-body d-flex flex-column">

                    <h6 class="fw-semibold mb-2">
                        {{ $product->name }}
                    </h6>

                    <p class="text-muted small mb-3">
                        {{ Str::limit($product->description, 70) }}
                    </p>

                    {{-- PRICE & ACTION --}}
                    <div class="mt-auto">
                        <p class="fw-bold text-success fs-5 mb-3">
                            Rp {{ number_format($product->price) }}
                        </p>

                        <div class="d-grid gap-2">
                            <a href="{{ route('product.show', $product->id) }}"
                               class="btn btn-outline-primary btn-sm">
                                Detail Produk
                            </a>

                            <a href="{{ route('cart.add', $product->id) }}"
                               class="btn btn-primary btn-sm">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
