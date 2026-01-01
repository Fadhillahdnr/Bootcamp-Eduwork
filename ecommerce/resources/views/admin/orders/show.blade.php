@extends('layouts.admin.master')

@section('title','Detail Pesanan')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📋 Detail Pesanan #{{ $order->id }}</h3>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
            ← Kembali ke Daftar
        </a>    
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Kolom Kiri: Info Pembeli -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">👤 Informasi Pembeli</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama:</label>
                        <p class="form-control-plaintext">{{ $order->name }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Pembeli:</label>
                        <p class="form-control-plaintext">
                            @if ($order->user)
                                <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pengiriman:</label>
                        <p class="form-control-plaintext">{{ $order->address }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon:</label>
                        <p class="form-control-plaintext">
                            <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran:</label>
                        <p class="form-control-plaintext">
                            <span class="badge bg-info">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Pesanan:</label>
                        <p class="form-control-plaintext">
                            {{ $order->created_at->format('d F Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Status -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">📊 Update Status Pesanan</h5>
                </div>
                <div class="card-body">
                    @php
                        $statusColor = match($order->status) {
                            'diproses' => 'warning',
                            'dikirim' => 'info',
                            'selesai' => 'success',
                            'menunggu pembayaran' => 'danger',
                            'dibatalkan' => 'secondary',
                            default => 'secondary'
                        };
                    @endphp
                    
                    <div class="mb-4 text-center">
                        <h4>
                            <span class="badge bg-{{ $statusColor }} fs-6 py-2 px-3">
                                {{ ucfirst($order->status) }}
                            </span>
                        </h4>
                    </div>

                    <form method="POST" action="{{ route('admin.orders.status', $order->id) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Pilih Status:</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="menunggu pembayaran" {{ $order->status == 'menunggu pembayaran' ? 'selected' : '' }}>
                                    ⏳ Menunggu Pembayaran
                                </option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                    ⚙️ Diproses
                                </option>
                                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>
                                    🚚 Dikirim
                                </option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                    ✅ Selesai
                                </option>
                                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>
                                    ❌ Dibatalkan
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            ✓ Update Status
                        </button>
                    </form>

                    <hr>

                    <div class="alert alert-info mb-0">
                        <small>
                            <strong>Catatan:</strong> Ketika status diubah, pelanggan akan melihat update ini di halaman riwayat pesanan mereka.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Items -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">🛍️ Detail Produk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th class="text-end">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product_name }}</strong><br>
                                    <small class="text-muted">ID Produk: {{ $item->product_id }}</small>
                                </td>
                                <td class="text-end">
                                    Rp {{ number_format($item->price) }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ $item->qty }}</span>
                                </td>
                                <td class="text-end">
                                    <strong>Rp {{ number_format($item->subtotal) }}</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-dark text-white">
                            <th colspan="3" class="text-end">TOTAL PESANAN:</th>
                            <th class="text-end">
                                Rp {{ number_format($order->total) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
            ← Kembali ke Daftar Pesanan
        </a>
    </div>
</div>
@endsection
