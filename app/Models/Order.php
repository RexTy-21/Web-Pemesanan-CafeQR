<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    protected $fillable = [
        'order_code', 'customer_name', 'table_number', 'payment_method',
        'payment_status', 'order_status', 'total_amount', 'cash_received',
        'change_amount', 'general_notes'
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}