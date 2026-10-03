<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->string('customer_name');
            $table->string('table_number');
            $table->enum('payment_method', ['cash', 'qris']);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('order_status', ['new', 'processing', 'completed', 'cancelled'])->default('new');
            $table->integer('total_amount');
            $table->integer('cash_received')->nullable();
            $table->integer('change_amount')->nullable();
            $table->text('general_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};