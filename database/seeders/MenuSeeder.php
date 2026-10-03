<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Menu;

class MenuSeeder extends Seeder {
    public function run(): void {
        $makanan = Category::create(['name' => 'Makanan Utama']);
        $minuman = Category::create(['name' => 'Minuman']);

        Menu::create([
            'category_id' => $makanan->id,
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan telor, ayam suwir, dan kerupuk',
            'price' => 25000,
            'is_available' => true
        ]);

        Menu::create([
            'category_id' => $makanan->id,
            'name' => 'Ayam Geprek',
            'description' => 'Ayam crispy dengan sambal bawang pedas',
            'price' => 20000,
            'is_available' => true
        ]);

        Menu::create([
            'category_id' => $minuman->id,
            'name' => 'Es Kopi Kenangan',
            'description' => 'Espresso dengan gula aren asli dan susu segar',
            'price' => 18000,
            'is_available' => true
        ]);

        Menu::create([
            'category_id' => $minuman->id,
            'name' => 'Es Teh Manis',
            'description' => 'Teh Melati segar dingin',
            'price' => 6000,
            'is_available' => true
        ]);
    }
}