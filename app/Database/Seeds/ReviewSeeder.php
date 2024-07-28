<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $products = ["Kaos Polos", "Kemeja", "Jaket", "Sweater", "Celana Jeans"];
        $customers = ["Andi", "Budi", "Citra", "Dewi", "Eka", "Fajar", "Gita", "Hadi", "Ika", "Joko", "Kiki", "Lia", "Mira", "Nina", "Oki", "Putu", "Qori", "Rina", "Siti", "Tomi"];

        for ($i = 0; $i < 300; $i++) {
            $data = [
                'id_produk' => $products[array_rand($products)],
                'harga_produk' => rand(50, 150) * 1000, // Harga dalam ribuan rupiah
                'customer' => $customers[array_rand($customers)],
                'rating' => rand(1, 5)
            ];

            // Menggunakan query builder untuk menyisipkan data
            $this->db->table('review')->insert($data);
        }
    }
}
