<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PesananController extends BaseController
{

    protected $transaksi;
    protected $pemesanan;

    public function __construct()
    {
        $this->transaksi = model('TransaksiModel');
        $this->pemesanan = model('PemesananModel');
    }

    public function index()
    {
        $transaksi = $this->transaksi->join('customer', 'customer.id = transaksi.id_customer')
            ->findAll();

        $data = [
            'title' => 'Pesanan',
            'transaksi' => $transaksi,
        ];
        return view('admin/pesanan/pesanan', $data);
    }

    public function detail($no_transaksi)
    {
        $transaksi = $this->transaksi->join('customer', 'customer.id = transaksi.id_customer')
            ->where('no_transaksi', $no_transaksi)
            ->first();

        $pemesanan = $this->pemesanan->where('no_pemesanan', $transaksi['no_pemesanan'])
            ->join('produk', 'produk.id_produk = pemesanan.id_produk')
            ->findAll();

        $data = [
            'title' => 'Detail Pesanan',
            'transaksi' => $transaksi,
            'pesanan' => $pemesanan,
        ];
        return view('admin/pesanan/detail', $data);
    }
}
