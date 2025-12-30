@extends('layouts.admin.master')

@section('title','Admin Dashboard')

@section('content')

<x-alert>
    Selamat Datang Admin
</x-alert>

<div class="container">
    <div class="text-center my-4">
        <h1>Admin Panel</h1>
        <p class="lead">Kelola produk toko Anda</p>
    </div>

    <div class="row g-4 justify-content-center">

        {{-- Kelola Produk --}}
        <div class="col-md-4">
            <div class="card text-center h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Kelola Produk</h5>
                    <p class="card-text">
                        Tambah, edit, dan hapus produk
                    </p>
                    <a href="{{ url('/admin/products') }}"
                    class="btn btn-primary">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>

        {{-- Kelola Pesanan --}}
        <div class="col-md-4">
            <div class="card text-center h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Kelola Pesanan</h5>
                    <p class="card-text">
                        Lihat dan update status pesanan pelanggan
                    </p>
                    <a href="{{ route('admin.orders') }}"
                    class="btn btn-success">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
