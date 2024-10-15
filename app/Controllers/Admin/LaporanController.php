<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
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
            ->orderBy('id_transaksi', 'DESC')->findAll();


        $data = [
            'title' => 'Laporan Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('admin/laporan/laporan', $data);
    }
}
