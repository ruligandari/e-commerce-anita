<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CheckoutSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $produkModel = new \App\Models\ProdukModel();
        $sizeModel = new \App\Models\ProdukSizeModel();
        $cartModel = new \App\Models\CartModel();
        $pemesananModel = new \App\Models\PemesananModel();
        $transaksiModel = new \App\Models\TransaksiModel();
        $userModel = new \App\Models\CustomerModel(); // Menambahkan model User

        // Mendapatkan semua produk, ukuran produk, dan customer
        $produkList = $produkModel->findAll();
        $sizeList = $sizeModel->findAll();
        $customerList = $userModel->findAll(); // Mengambil semua customer

        // Loop untuk memasukkan 1000 data checkout
        for ($i = 0; $i < 1000; $i++) {
            // Random ID customer
            $id_user = $customerList[array_rand($customerList)]['id']; // Mengambil id_user secara acak dari customer

            // Random produk dan ukuran
            $randomProduk = $produkList[array_rand($produkList)];
            $randomSize = $sizeList[array_rand($sizeList)];

            // Random quantity
            $qty = $faker->numberBetween(1, 2);

            // Insert ke tabel cart
            $cartData = [
                'id_produk' => $randomProduk['id_produk'],
                'id_size' => $randomSize['id_produk_size'],
                'id_user' => $id_user,
                'qty' => $qty
            ];
            $cartModel->insert($cartData);

            // Generate nomor pemesanan dan transaksi
            $no_pemesanan = 'INV' . uniqid() . time();
            $no_transaksi = 'TR' . uniqid() . time();
            $total = $qty * $randomProduk['harga']; // Menghitung total harga

            $randomDate = $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s');

            // Insert ke tabel transaksi
            $transaksiData = [
                'id_customer' => $id_user,
                'total_bayar' => $total,
                'status' => 'Pesanan Selesai',
                'no_pemesanan' => $no_pemesanan,
                'no_transaksi' => $no_transaksi,
                'tanggal' => $randomDate, // Menggunakan format waktu yang tepat
                'bukti_pembayaran' => '-' // Placeholder untuk bukti pembayaran
            ];
            $transaksiModel->insert($transaksiData);

            // Insert ke tabel pemesanan
            $pemesananData = [
                'no_pemesanan' => $no_pemesanan,
                'id_produk' => $randomProduk['id_produk'],
                'id_size' => $randomSize['id_produk_size'],
                'qty' => $qty
            ];
            $pemesananModel->insert($pemesananData);
        }
    }
}
