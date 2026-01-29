@extends('admin.layouts.master')

@section('title','Daftar Pesanan')

@section('content')
<div class="container my-5 text-dark">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">📦 Daftar Pesanan</h3>
            <small class="text-muted">Kelola dan pantau seluruh pesanan pelanggan</small>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            ← Kembali
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold">
                Total Pesanan: {{ $orders->total() }}
            </h6>
        </div>

        <div class="card-body text-dark">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
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
                                {{-- ID --}}
                                <td class="text-center fw-semibold">
                                    #{{ $order->id }}
                                </td>

                                {{-- NAME --}}
                                <td>{{ $order->name }}</td>

                                {{-- EMAIL --}}
                                <td>
                                    @if ($order->user)
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- TOTAL --}}
                                <td class="fw-semibold">
                                    Rp {{ number_format($order->total) }}
                                </td>

                                {{-- PAYMENT --}}
                                <td class="text-center">
                                    <span class="badge bg-primary px-3 py-2">
                                        {{ strtoupper($order->payment_method) }}
                                    </span>
                                </td>

                                {{-- STATUS --}}
                                <td class="text-center">
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

                                    <span class="badge bg-{{ $statusColor }} px-3 py-2">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                {{-- DATE --}}
                                <td class="text-center">
                                    <small class="text-muted">
                                        {{ $order->created_at->format('d M Y') }}<br>
                                        {{ $order->created_at->format('H:i') }}
                                    </small>
                                </td>

                                {{-- ACTION --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        📋 Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    📭 Belum ada pesanan masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($orders->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection
