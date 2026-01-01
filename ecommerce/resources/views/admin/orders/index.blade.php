@extends('layouts.admin.master')

@section('title','Daftar Pesanan')

@section('content')
<div class="container my-4"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📦 Daftar Pesanan</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            ← Kembali
        </a>    
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Total Pesanan: {{ $orders->total() }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Pembeli</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>
                                    <strong>#{{ $order->id }}</strong>
                                </td>
                                <td>{{ $order->name }}</td>
                                <td>
                                    @if ($order->user)
                                        <small>{{ $order->user->email }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
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
                                            'dibatalkan' => 'secondary',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <small>{{ $order->created_at->format('d M Y H:i') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-sm btn-primary">
                                       📋 Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Belum ada pesanan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if ($orders->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
