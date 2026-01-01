@extends('layouts.admin.master')

@section('title','Tambah Produk')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Tambah Produk</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
            ← Kembali
        </a>    
    </div>

    <form method="POST" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        {{-- PILIH CATEGORY --}}
        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>

</div>

@endsection
