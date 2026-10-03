<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CashierController extends Controller {
    // Dashboard Utama Kasir
    public function index() {
        $orders = Order::with('items.menu')
                       ->orderBy('created_at', 'desc')
                       ->get();
                       
        return view('cashier.index', compact('orders'));
    }

    // Proses Pelunasan Tunai & Hitung Kembalian
    public function payCash(Request $request, $id) {
        $request->validate([
            'cash_received' => 'required|numeric'
        ]);

        $order = Order::findOrFail($id);

        if ($request->cash_received < $order->total_amount) {
            return back()->with('error', 'Uang pembayaran kurang!');
        }

        $change = $request->cash_received - $order->total_amount;

        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'processing',
            'cash_received' => $request->cash_received,
            'change_amount' => $change
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    // Cetak Struk Khusus Dapur
    public function printKitchen($id) {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('cashier.print_kitchen', compact('order'));
    }
}