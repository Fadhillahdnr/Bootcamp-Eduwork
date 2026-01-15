    @php
        use Illuminate\Support\Str;
    @endphp

    @extends('user.layouts.master')

    @section('title','Beranda')

    @section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div> 
    @endif

    <x-alert>
        Selamat Datang di Toko Kami
    </x-alert>

    <div class="container">
        <div class="row mb-4 mt-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">📦 Riwayat Pesanan</h5>
                        <p class="card-text">Lihat semua pesanan Anda</p>
                        <a href="{{ route('user.orders') }}" class="btn btn-primary">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">🛒 Keranjang Saya</h5>
                        <p class="card-text">Lanjutkan belanja</p>
                        <a href="{{ route('cart.index') }}" class="btn btn-primary">Buka Keranjang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-center my-4">
            <h1>Welcome to Our Store</h1>
            <p class="lead">Discover our exclusive products below</p>
        </div>

        {{-- FILTER CATEGORY --}}
        <form method="GET" action="{{ route('user.dashboard') }}" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <select name="category" class="form-select" onchange="this.form.submit()">
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

        {{-- card produk --}}
        <div class="row justify-content-center g-4">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/'.$product->image) }}"
                            class="card-img-top product-image">
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2">
                                {{ $product->category->name }}
                            </span>
                            
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                {{ Str::limit($product->description, 80) }}
                            </p>
                            @if (strlen($product->description) > 80)
                                <a class="text-decoration-none"
                                data-bs-toggle="collapse"
                                href="#desc-{{ $product->id }}"
                                role="button">
                                    Baca selengkapnya
                                </a>

                                <div class="collapse mt-2" id="desc-{{ $product->id }}">
                                    <p class="card-text">
                                        {{ $product->description }}
                                    </p>

                                    <a class="text-decoration-none"
                                    data-bs-toggle="collapse"
                                    href="#desc-{{ $product->id }}">
                                        Tutup
                                    </a>
                                </div>
                            @endif

                            <div class="mt-auto">
                                <p class="fw-bold text-success">
                                    Rp {{ number_format($product->price) }}
                                </p>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Detail</a>
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success mt-2">
                                    Tambah ke Keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    @endsection
