<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public $penjualan;
    // construct
    public function __construct()
    {
        $this->penjualan = model('TransaksiModel');
    }
    public function index()
    {

        //    kelompokan data penjualan berdasarkan tanggal misalnya tanggal 2021-08-01 ada 3 penjualan
        // bentuk jadi ['tanggal' => 'tanggal', 'total_penjualan' => 'jumlah_penjualan']
        $dataPenjualan = $this->penjualan
            ->select('DATE(tanggal) as tanggal, COUNT(*) as total_penjualan') // Mengambil tanggal dan menghitung jumlah transaksi
            ->groupBy('DATE(tanggal)') // Mengelompokkan berdasarkan tanggal
            ->findAll();

        $result = [];
        foreach ($dataPenjualan as $row) {
            $result[] = [
                'tanggal' => $row['tanggal'],
                'total_penjualan' => $row['total_penjualan']
            ];
        }

        $data = [
            'title' => 'Dashboard',
            'data' => $result,
        ];
        return view('admin/dashboard/dashboard', $data);
    }
}
