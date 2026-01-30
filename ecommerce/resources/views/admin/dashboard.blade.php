@extends('admin.layouts.master')

@section('title','Admin Dashboard')

@section('content')

<div class="container my-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Dashboard</h2>
            <p class="text-muted mb-0">Ringkasan data & kontrol aplikasi</p>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row g-4 mb-5">

        {{-- Total Produk --}}
        <div class="col-md-3">
            <div class="card stat-glass bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="stat-label">Total Produk</p>
                            <h2 class="stat-value">{{ $totalProducts }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Klik --}}
        <div class="col-md-3">
            <div class="card stat-glass bg-gradient-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="stat-label">Total Klik Produk</p>
                            <h2 class="stat-value" id="total-clicks">
                                {{ number_format($totalClicks) }}
                            </h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-cursor-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="col-md-3">
            <div class="card stat-glass bg-gradient-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="stat-label">Kategori Produk</p>
                            <h2 class="stat-value">{{ $totalCategories }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pesanan --}}
        <div class="col-md-3">
            <div class="card stat-glass bg-gradient-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="stat-label">Total Pesanan</p>
                            <h2 class="stat-value" id="total-orders">
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

    </div>

    {{-- QUICK ACTION --}}
    <h5 class="fw-bold mb-3">Aksi Cepat</h5>

    <div class="row g-4">

        {{-- Preview User --}}
        <div class="col-md-4">
            <div class="card action-card border-primary">
                <div class="card-body text-center">
                    <i class="bi bi-eye-fill action-icon text-primary"></i>
                    <h5 class="fw-bold">Preview Dashboard User</h5>
                    <p class="text-muted small">
                        Cek tampilan & update data user
                    </p>
                    <a href="{{ route('user.dashboard') }}" target="_blank"
                       class="btn btn-outline-primary w-100">
                        Lihat Dashboard
                    </a>
                </div>
            </div>
        </div>

        {{-- Kelola Produk --}}
        <div class="col-md-4">
            <div class="card action-card border-success">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam action-icon text-success"></i>
                    <h5 class="fw-bold">Kelola Produk</h5>
                    <p class="text-muted small">
                        Tambah, edit & hapus produk
                    </p>
                    <a href="{{ url('/admin/products') }}"
                       class="btn btn-outline-success w-100">
                        Kelola Produk
                    </a>
                </div>
            </div>
        </div>

        {{-- Kelola Pesanan --}}
        <div class="col-md-4">
            <div class="card action-card border-dark">
                <div class="card-body text-center">
                    <i class="bi bi-receipt action-icon text-dark"></i>
                    <h5 class="fw-bold">Kelola Pesanan</h5>
                    <p class="text-muted small">
                        Pantau & update pesanan
                    </p>
                    <a href="{{ route('admin.orders') }}"
                       class="btn btn-outline-dark w-100">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection


@section('scripts')
<script>
window.Echo.channel('admin-dashboard')
    .listen('.product.viewed', (data) => {
        const el = document.getElementById('total-clicks');
        if(el){
            el.innerText = Number(data.total_clicks).toLocaleString();
        }
    });

window.Echo.channel('admin-dashboard')
    .listen('.order.created', (data) => {
        const el = document.getElementById('total-orders');
        if(el){
            el.innerText = data.total_orders;
        }
    });
</script>
@endsection
