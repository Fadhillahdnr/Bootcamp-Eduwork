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

    {{-- TAMBAH KATEGORI --}}
        <div class="mb-4 p-3 border rounded bg-light">
            <form method="POST" action="{{ route('admin.product-category.store') }}">
                @csrf

                <label class="form-label">Tambah Kategori Baru</label>
                <div class="d-flex gap-2">
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Nama kategori"
                        required
                    >
                    <button class="btn btn-success">
                        + Tambah
                    </button>
                </div>
            </form>
        </div>
        
    {{-- FORM TAMBAH PRODUK --}}
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
