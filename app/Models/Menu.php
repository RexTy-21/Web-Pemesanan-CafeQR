<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'description', 'price', 'image', 'is_available'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}