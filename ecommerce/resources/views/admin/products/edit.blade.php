@extends('layouts.master')

@section('title','Edit Produk')

@section('content')

<div class="container">
    <h2 class="my-4">Edit Produk</h2>

    <form method="POST"
          action="{{ url('/admin/products/'.$product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name"
                   value="{{ old('name', $product->name) }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description"
                      class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price"
                   value="{{ old('price', $product->price) }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Gambar Sekarang</label><br>
            <img src="{{ asset('storage/'.$product->image) }}"
                 width="120" class="img-thumbnail">
        </div>

        <div class="mb-3">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ url('/admin/products') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>

@endsection
