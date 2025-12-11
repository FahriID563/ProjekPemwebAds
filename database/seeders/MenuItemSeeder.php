<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = [
            [
                'menu_name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, dan sayuran segar',
                'category' => 'Makanan Berat',
                'price' => 15000,
                'stock' => 20,
                'image_url' => 'nasi-goreng.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Mie Ayam',
                'description' => 'Mie ayam dengan pangsit dan bakso pilihan',
                'category' => 'Makanan Berat',
                'price' => 12000,
                'stock' => 15,
                'image_url' => 'mie-ayam.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Soto Ayam',
                'description' => 'Soto ayam kampung dengan bumbu rempah khas',
                'category' => 'Makanan Berat',
                'price' => 13000,
                'stock' => 10,
                'image_url' => 'soto-ayam.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Nasi Pecel',
                'description' => 'Nasi dengan sayuran dan bumbu pecel',
                'category' => 'Makanan Berat',
                'price' => 10000,
                'stock' => 25,
                'image_url' => 'nasi-pecel.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Ayam Goreng + Nasi',
                'description' => 'Ayam goreng crispy dengan nasi putih',
                'category' => 'Makanan Berat',
                'price' => 18000,
                'stock' => 12,
                'image_url' => 'ayam-goreng.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Es Teh Manis',
                'description' => 'Es teh manis segar',
                'category' => 'Minuman',
                'price' => 3000,
                'stock' => 50,
                'image_url' => 'es-teh.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Jus Jeruk',
                'description' => 'Jus jeruk asli tanpa gula tambahan',
                'category' => 'Minuman',
                'price' => 8000,
                'stock' => 20,
                'image_url' => 'jus-jeruk.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Es Kelapa Muda',
                'description' => 'Es kelapa muda segar',
                'category' => 'Minuman',
                'price' => 10000,
                'stock' => 15,
                'image_url' => 'es-kelapa.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Kopi Hitam',
                'description' => 'Kopi hitam robusta pilihan',
                'category' => 'Minuman',
                'price' => 5000,
                'stock' => 30,
                'image_url' => 'kopi.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Pisang Goreng',
                'description' => 'Pisang goreng crispy dengan meses',
                'category' => 'Snack',
                'price' => 5000,
                'stock' => 30,
                'image_url' => 'pisang-goreng.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Tahu Isi',
                'description' => 'Tahu isi dengan sayuran dan cabai',
                'category' => 'Snack',
                'price' => 6000,
                'stock' => 25,
                'image_url' => 'tahu-isi.jpg',
                'is_available' => true,
            ],
            [
                'menu_name' => 'Tempe Mendoan',
                'description' => 'Tempe mendoan crispy khas Purbalingga',
                'category' => 'Snack',
                'price' => 5000,
                'stock' => 20,
                'image_url' => 'mendoan.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::updateOrCreate(
                ['menu_name' => $item['menu_name']],
                $item
            );
        }
    }
}
