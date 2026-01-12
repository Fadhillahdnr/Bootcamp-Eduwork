@extends('layouts.master')

@section('title','Detail Pesanan')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📋 Detail Pesanan #{{ $order->id }}</h2>
        <a href="{{ route('user.orders') }}" class="btn btn-secondary">← Kembali ke Riwayat</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Kolom Kiri: Info Pesanan dan Pengiriman -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📍 Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Penerima:</label>
                        <p class="form-control-plaintext">{{ $order->name }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat:</label>
                        <p class="form-control-plaintext">{{ $order->address }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon:</label>
                        <p class="form-control-plaintext">{{ $order->phone }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran:</label>
                        <p class="form-control-plaintext">
                            <span class="badge bg-primary">
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

        <!-- Kolom Kanan: Status Pesanan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📊 Status Pesanan</h5>
                </div>
                <div class="card-body">
                    @php
                        $statusColor = match($order->status) {
                            'diproses' => 'warning',
                            'dikirim' => 'info',
                            'selesai' => 'success',
                            'menunggu pembayaran' => 'danger',
                            default => 'secondary'
                        };
                        
                        $statusIcon = match($order->status) {
                            'diproses' => '⚙️',
                            'dikirim' => '🚚',
                            'selesai' => '✅',
                            'menunggu pembayaran' => '⏳',
                            default => '❓'
                        };
                    @endphp
                    
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <span style="font-size: 48px;">{{ $statusIcon }}</span>
                        </div>
                        <h3>
                            <span class="badge bg-{{ $statusColor }} fs-5 py-2 px-3">
                                {{ ucfirst($order->status) }}
                            </span>
                        </h3>
                    </div>

                    <!-- Timeline Status -->
                    <div class="timeline">
                        <div class="timeline-item {{ $order->status != 'menunggu pembayaran' ? 'completed' : '' }}">
                            <div class="timeline-marker">✓</div>
                            <div class="timeline-content">
                                <strong>Pesanan Dibuat</strong>
                                <small class="text-muted d-block">{{ $order->created_at->format('d M Y') }}</small>
                            </div>
                        </div>

                        <div class="timeline-item {{ in_array($order->status, ['diproses', 'dikirim', 'selesai']) ? 'completed' : '' }}">
                            <div class="timeline-marker">{{ in_array($order->status, ['diproses', 'dikirim', 'selesai']) ? '✓' : '◎' }}</div>
                            <div class="timeline-content">
                                <strong>Sedang Diproses</strong>
                                <small class="text-muted d-block">Admin sedang mempersiapkan pesanan Anda</small>
                            </div>
                        </div>

                        <div class="timeline-item {{ in_array($order->status, ['dikirim', 'selesai']) ? 'completed' : '' }}">
                            <div class="timeline-marker">{{ in_array($order->status, ['dikirim', 'selesai']) ? '✓' : '◎' }}</div>
                            <div class="timeline-content">
                                <strong>Dikirim</strong>
                                <small class="text-muted d-block">Pesanan dalam perjalanan ke tangan Anda</small>
                            </div>
                        </div>

                        <div class="timeline-item {{ $order->status == 'selesai' ? 'completed' : '' }}">
                            <div class="timeline-marker">{{ $order->status == 'selesai' ? '✓' : '◎' }}</div>
                            <div class="timeline-content">
                                <strong>Selesai</strong>
                                <small class="text-muted d-block">Pesanan telah diterima dengan baik</small>
                            </div>
                        </div>
                    </div>

                    @if ($order->status == 'menunggu pembayaran')
                        <div class="alert alert-danger mt-4">
                            <strong>⚠️ Pembayaran Menunggu</strong>
                            <p class="mb-0 mt-2">Silakan lakukan pembayaran sebesar <strong>Rp {{ number_format($order->total) }}</strong> untuk menyelesaikan pesanan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Items Pesanan -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">🛍️ Detail Produk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalVerify = 0; @endphp
                        @foreach ($order->items as $item)
                            @php $totalVerify += $item->subtotal; @endphp
                            <tr>
                                <td>
                                    <strong>{{ $item->product_name }}</strong><br>
                                    <small class="text-muted">Kode: {{ $item->product_id }}</small>
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
                        <tr class="table-light">
                            <th colspan="3" class="text-end">Total Pesanan:</th>
                            <th class="text-end">
                                <h5 class="mb-0">Rp {{ number_format($order->total) }}</h5>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 text-end">
        <a href="{{ route('beranda') }}" class="btn btn-primary">
            🛍️ Lanjut Belanja
        </a>
        <a href="{{ route('user.orders') }}" class="btn btn-secondary">
            📦 Lihat Semua Pesanan
        </a>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        display: flex;
        margin-bottom: 30px;
        position: relative;
    }

    .timeline-item.completed .timeline-marker {
        background-color: #28a745;
        color: white;
    }

    .timeline-marker {
        min-width: 40px;
        height: 40px;
        background-color: #e9ecef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .timeline-content {
        flex: 1;
        padding-top: 5px;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 40px;
        bottom: -30px;
        width: 2px;
        background-color: #dee2e6;
    }

    .timeline-item.completed:not(:last-child)::before {
        background-color: #28a745;
    }
</style>
@endsection
