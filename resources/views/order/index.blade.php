<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe QR Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans pb-24">
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-md">
        
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-4 sticky top-0 z-10 shadow-md">
            <h1 class="text-xl font-bold">Cafe Delights</h1>
            <p class="text-xs opacity-80">Selamat Datang! Silakan pesan menu favorit Anda.</p>
        </div>

        <form action="<?php echo e(route('order.store')); ?>" method="POST" id="orderForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="cart" id="cartInput">

            <!-- Input Data Pelanggan & Nomor Meja -->
            <div class="p-4 bg-indigo-50 border-b space-y-3">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nomor Meja:</label>
                    <input type="text" name="table_number" required placeholder="Contoh: 05, VIP-1..." class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Pemesan:</label>
                    <input type="text" name="customer_name" required placeholder="Masukkan nama Anda..." class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                </div>
            </div>

            <!-- Katalog Menu -->
            <div class="p-4 space-y-6">
                <?php foreach($categories as$category): ?>
                    <div>
                        <h2 class="text-lg font-bold text-indigo-900 border-b pb-1 mb-3"><?php echo e($category->name); ?></h2>
                        <div class="space-y-3">
                            <?php foreach($category->menus as$menu): ?>
                                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border">
                                    <div class="flex-1 pr-2">
                                        <h3 class="font-semibold"><?php echo e($menu->name); ?></h3>
                                        <p class="text-xs text-gray-500"><?php echo e($menu->description); ?></p>
                                        <span class="text-sm font-bold text-indigo-600">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></span>
                                        <input type="text" placeholder="Catatan (opsional)" id="note-<?php echo e($menu->id); ?>" class="mt-2 text-xs w-full p-1 border rounded bg-white">
                                    </div>
                                    <div>
                                        <button type="button" onclick="addToCart(<?php echo e($menu->id); ?>, '<?php echo e($menu->name); ?>', <?php echo e($menu->price); ?>)" class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-indigo-700">+ Tambah</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Catatan Umum -->
                <div>
                    <label class="block text-sm font-semibold mb-1">Catatan Umum Pesanan:</label>
                    <textarea name="general_notes" placeholder="Contoh: Tolong sediakan mangkuk kosong 1" class="w-full p-2 border rounded-lg text-sm bg-white"></textarea>
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block text-sm font-semibold mb-1">Metode Pembayaran:</label>
                    <select name="payment_method" required class="w-full p-2 border rounded-lg text-sm bg-white">
                        <option value="cash">Tunai / Cash di Kasir</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
            </div>

            <!-- Sticky Cart Summary -->
            <div class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t p-4 flex justify-between items-center shadow-lg">
                <div>
                    <p class="text-xs text-gray-500">Total Pesanan:</p>
                    <p class="text-lg font-bold text-indigo-600" id="totalDisplay">Rp 0</p>
                </div>
                <button type="submit" onclick="prepareSubmit(event)" class="bg-green-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-green-700">Pesan Sekarang</button>
            </div>
        </form>

    </div>

    <script>
        let cart = {};

        function addToCart(id, name, price) {
            let note = document.getElementById(`note-${id}`).value;
            
            if (cart[id]) {
                cart[id].qty += 1;
                cart[id].notes = note;
            } else {
                cart[id] = { id: id, name: name, price: price, qty: 1, notes: note };
            }
            updateCartDisplay();
        }

        function updateCartDisplay() {
            let total = 0;
            for (let key in cart) {
                total += cart[key].price * cart[key].qty;
            }
            document.getElementById('totalDisplay').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function prepareSubmit(e) {
            let cartArray = Object.values(cart);
            if (cartArray.length === 0) {
                e.preventDefault();
                alert('Silakan pilih minimal 1 menu!');
                return;
            }
            document.getElementById('cartInput').value = JSON.stringify(cartArray);
        }
    </script>
</body>
</html>