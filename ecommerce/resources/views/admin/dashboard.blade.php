@extends('layouts.admin.master')

@section('title','Admin Dashboard')

@section('content')

<div class="container my-4">

    <h2 class="mb-4 fw-bold">Dashboard</h2>

    <div class="row g-4 mb-4">

        {{-- Total Produk --}}
        <div class="col-md-3">
            <div class="card stat-card bg-primary text-white shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-semibold mb-1">Total Produk</h6>
                        <h2 class="fw-bold mb-0">{{ $totalProducts }}</h2>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Klik Produk --}}
        <div class="col-md-3">
            <div class="card stat-card bg-success text-white shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-semibold mb-1">Total Klik Produk</h6>
                        <h2 class="fw-bold mb-0" id="total-clicks">
                            {{ number_format($totalClicks) }}
                        </h2>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-cursor-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="col-md-3">
            <div class="card stat-card bg-warning text-dark shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-semibold mb-1">Kategori Produk</h6>
                    <h2 class="fw-bold mb-0">{{ $totalCategories }}</h2>
                </div>
                <div class="stat-icon text-dark">
                    <i class="bi bi-tags-fill"></i>
                </div>
            </div>
            </div>
        </div>

        {{-- Total Pesanan --}}
        <div class="col-md-3">
            <div class="card stat-card bg-dark text-white shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-semibold mb-1">Total Pesanan</h6>
                        <h2 class="fw-bold mb-0" id="total-orders">
                            {{ $totalOrders }}
                        </h2>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Aksi Cepat --}}
    <div class="row mt-5 g-4">

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Kelola Produk</h5>
                    <p class="text-muted">Tambah, edit, dan hapus produk</p>
                    <a href="{{ url('/admin/products') }}" class="btn btn-primary">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Kelola Pesanan</h5>
                    <p class="text-muted">Lihat dan update status pesanan</p>
                    <a href="{{ route('admin.orders') }}" class="btn btn-success">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection


{{-- ========================= --}}
{{-- REALTIME BROADCAST SCRIPT --}}
{{-- ========================= --}}
@section('scripts')
<script>
window.Echo.channel('admin-dashboard')
    .listen('.product.viewed', (data) => {
        let el = document.getElementById('total-clicks');
        if(el){
            el.innerText = Number(data.total_clicks).toLocaleString();
        }
    });

window.Echo.channel('admin-dashboard')
    .listen('.order.created', (data) => {
        let el = document.getElementById('total-orders');
        if(el){
            el.innerText = data.total_orders;
        }
    });
</script>
@endsection
