@extends('layouts.admin.master')

@section('title','Produk')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Daftar Produk</h2>

        <div>
            <a href="{{ url('/admin/products/create') }}" class="btn btn-success">
                + Tambah Produk
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">
                ← Kembali
            </a>
        </div>
    </div>

    {{-- FILTER CATEGORY --}}
    <form method="GET" action="{{ url('/admin/products') }}" class="mb-3">
        <div class="row g-2 align-items-center">
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

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$product->image) }}"
                             width="80" class="img-thumbnail">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>
                        {{ $product->category->name ?? '-' }}
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>Rp {{ number_format($product->price) }}</td>
                    <td>
                        <a href="{{ url('/admin/products/'.$product->id.'/edit') }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ url('/admin/products/'.$product->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Belum ada produk
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
