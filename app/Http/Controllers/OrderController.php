<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class OrderController extends Controller {
    // Tampilan Menu Pelanggan (URL: domain.test/order?table=05)
    public function index() {
    $categories = Category::with('menus')->get();
    return view('order.index', compact('categories'));
}
    // Pemprosesan Pesanan
    public function store(Request $request) {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'table_number' => 'required',
            'payment_method' => 'required|in:cash,qris',
            'cart' => 'required|json'
        ]);

        $cart = json_decode($request->cart, true);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang belanja masih kosong!');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'order_code' => 'ORD-' . strtoupper(Str::random(6)),
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status' => 'new',
            'total_amount' => $totalAmount,
            'general_notes' => $request->general_notes
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
                'notes' => $item['notes'] ?? null
            ]);
        }

        return redirect()->route('order.success', $order->id);
    }

    public function success($id) {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('order.success', compact('order'));
    }

    
}