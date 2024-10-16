<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID'); // Faker dengan bahasa Indonesia
        $transaksiModel = new \App\Models\TransaksiModel();
        $pemesananModel = new \App\Models\PemesananModel(); // Model untuk mengambil data pemesanan
        $userModel = new \App\Models\CustomerModel(); // Model untuk mendapatkan data user
        $produkModel = new \App\Models\ProdukModel(); // Model untuk mendapatkan data produk
        $reviewCount = 500; // Jumlah review yang ingin ditambahkan

        // Mendapatkan semua transaksi
        $transaksiList = $transaksiModel->findAll();

        // Loop untuk memasukkan 1000 data review
        for ($i = 0; $i < $reviewCount; $i++) {
            // Pilih transaksi secara acak
            $randomTransaksi = $transaksiList[array_rand($transaksiList)];

            // Generate harga diskon
            $hargaDiskon = [-10000, -15000, -20000, 0, 10000, 15000, 20000];

            // Mendapatkan pemesanan berdasarkan no_pemesanan
            $pemesananList = $pemesananModel->where('no_pemesanan', $randomTransaksi['no_pemesanan'])->findAll();

            // Pastikan ada data pemesanan
            if (!empty($pemesananList)) {
                // Pilih pemesanan secara acak
                $randomPemesanan = $pemesananList[array_rand($pemesananList)];

                // Mengambil id_produk dari pemesanan yang dipilih
                $idProduk = $randomPemesanan['id_produk'];
                // Mengambil nama produk dan harga dari id_produk
                $namaProduk = $produkModel->find($idProduk)['name'];
                $hargaDasar = $produkModel->find($idProduk)['harga'];
                $diskonAcak = $hargaDiskon[array_rand($hargaDiskon)]; // Mengambil diskon acak dari array
                $hargaProduk = $hargaDasar + $diskonAcak;

                // Menghitung rating berdasarkan harga
                // $rating = 5; // Mulai dengan rating maksimum
                // if ($diskonAcak > 0) {
                //     // Jika harga naik, turunkan rating
                //     $rating -= round(abs($diskonAcak) / 5000); // Setiap kenaikan 10.000, rating berkurang 1
                //     $rating = max(1, $rating); // Pastikan rating tidak kurang dari 1
                // } else if ($diskonAcak == 0) {
                //     // Jika harga sama, rating tetap
                //     $rating = $faker->numberBetween(4, 5);
                // } else {
                //     // Jika harga turun, naikkan rating
                //     $rating = 5; // Rating acak antara 5-10
                // }

                // Mengambil nama customer berdasarkan id_customer
                $customerName = $userModel->find($randomTransaksi['id_customer'])['name']; // Pastikan field nama ada di tabel customer

                // Data review
                $reviewData = [
                    'id_produk' => $namaProduk, // ID produk dari pemesanan
                    'rating' => $faker->numberBetween(3, 5), // Rating yang dihitung berdasarkan harga
                    'harga_produk' => $hargaProduk, // Harga produk
                    'customer' => $customerName, // Menggunakan nama customer
                    'review' => $faker->sentence($nbWords = 6, $variableNbWords = true), // Komentar acak
                ];

                // Insert ke tabel review
                $this->db->table('review')->insert($reviewData);
            }
        }
    }
}
