<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Dashboard Komputer Kasir</h1>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white text-sm">
                        <th class="p-3">Waktu</th>
                        <th class="p-3">Meja</th>
                        <th class="p-3">Pelanggan</th>
                        <th class="p-3">Detail Pesanan</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Metode</th>
                        <th class="p-3">Status Bayar</th>
                        <th class="p-3">Aksi / Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    <?php foreach($orders as$order): ?>
                        <tr>
                            <td class="p-3 text-xs text-gray-500"><?php echo e($order->created_at->format('H:i')); ?></td>
                            <td class="p-3 font-bold">Meja <?php echo e($order->table_number); ?></td>
                            <td class="p-3"><?php echo e($order->customer_name); ?></td>
                            <td class="p-3">
                                <ul class="list-disc pl-4 text-xs">
                                    <?php foreach($order->items as$item): ?>
                                        <li>
                                            <?php echo e($item->quantity); ?>x <?php echo e($item->menu->name); ?>

                                            <?php if($item->notes): ?> <span class="text-red-500">(<?php echo e($item->notes); ?>)</span> <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if($order->general_notes): ?>
                                    <p class="text-xs font-semibold text-indigo-600 mt-1">Catatan: <?php echo e($order->general_notes); ?></p>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 font-bold">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                            <td class="p-3 uppercase text-xs font-bold"><?php echo e($order->payment_method); ?></td>
                            <td class="p-3">
                                <?php if($order->payment_status === 'paid'): ?>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">LUNAS</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-bold">BELUM BAYAR</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 space-y-1">
                                <a href="<?php echo e(route('cashier.print_kitchen', $order->id)); ?>" target="_blank" class="block text-center bg-gray-600 text-white text-xs px-2 py-1 rounded hover:bg-gray-700">Print Dapur</a>

                                <?php if($order->payment_status === 'pending'): ?>
                                    <form action="<?php echo e(route('cashier.pay', $order->id)); ?>" method="POST" class="mt-2 bg-gray-50 p-2 rounded border">
                                        <?php echo csrf_field(); ?>
                                        <input type="number" name="cash_received" placeholder="Uang diterima" id="cash-<?php echo e($order->id); ?>" oninput="calcChange(<?php echo e($order->id); ?>, <?php echo e($order->total_amount); ?>)" required class="w-full text-xs p-1 border rounded mb-1">
                                        <p class="text-xs text-gray-600">Kembali: <span id="change-<?php echo e($order->id); ?>" class="font-bold text-green-600">Rp 0</span></p>
                                        <button type="submit" class="w-full bg-green-600 text-white text-xs py-1 rounded mt-1 font-bold hover:bg-green-700">Bayar & Lunasi</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function calcChange(orderId, totalAmount) {
            let received = document.getElementById(`cash-${orderId}`).value || 0;
            let change = received - totalAmount;
            let display = document.getElementById(`change-${orderId}`);

            if (change >= 0) {
                display.innerText = 'Rp ' + change.toLocaleString('id-ID');
                display.className = 'font-bold text-green-600';
            } else {
                display.innerText = 'Kurang Rp ' + Math.abs(change).toLocaleString('id-ID');
                display.className = 'font-bold text-red-600';
            }
        }
    </script>
</body>
</html>