@extends('layouts.master')

@section('title','Riwayat Pesanan')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📦 Riwayat Pesanan Saya</h2>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($orders->count())
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <strong>#{{ $order->id }}</strong>
                            </td>
                            <td>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            <td>
                                <strong>Rp {{ number_format($order->total) }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ strtoupper($order->payment_method) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColor = match($order->status) {
                                        'diproses' => 'warning',
                                        'dikirim' => 'info',
                                        'selesai' => 'success',
                                        'menunggu pembayaran' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusColor }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('user.orders.detail', $order->id) }}"
                                   class="btn btn-sm btn-primary">
                                    📋 Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <h5>Belum ada pesanan</h5>
            <p class="mb-3">Anda belum melakukan pemesanan apapun.</p>
            <a href="{{ route('product') }}" class="btn btn-primary">
                🛍️ Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection
