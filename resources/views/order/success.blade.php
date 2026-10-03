@extends('layouts.app')

@section('content')
<div class="p-6 text-center space-y-4">
    <div class="text-green-500 text-5xl">✓</div>
    <h1 class="text-2xl font-bold text-gray-800">Pesanan Berhasil Dikirim!</h1>
    <p class="text-sm text-gray-600">Kode Pesanan: <span class="font-bold text-indigo-600">{{ $order->order_code }}</span></p>

    <div class="bg-gray-50 p-4 rounded-lg border text-left text-sm space-y-2">
        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
        <p><strong>No. Meja:</strong> {{ $order->table_number }}</p>
        <p><strong>Metode Bayar:</strong> {{ strtoupper($order->payment_method) }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
    </div>

    @if($order->payment_method === 'cash')
        <div class="bg-yellow-100 text-yellow-800 p-3 rounded-lg text-xs">
            Silakan lakukan pembayaran langsung di meja kasir.
        </div>
    @else
        <div class="bg-blue-100 text-blue-800 p-3 rounded-lg text-xs">
            Tunjukkan layar ini ke kasir untuk pemindaian kode QRIS.
        </div>
    @endif
</div>
@endsection