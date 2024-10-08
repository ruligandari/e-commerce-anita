<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    private $kategoriModel;
    private $produkModel;
    public function __construct()
    {
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->produkModel = new \App\Models\ProdukModel();
    }
    public function index()
    {
        $produk = $this->produkModel->getAllProduk();
        $data = [
            'title' => 'Home',
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $produk
        ];
        return view('user/home/home', $data);
    }
}
