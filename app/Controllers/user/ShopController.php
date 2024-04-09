<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ShopController extends BaseController
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
            'title' => 'Shop',
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $produk
        ];

        return view('user/shop/shop', $data);
    }

    public function detail($id)
    {
        $produk = $this->produkModel->find($id);
        $data = [
            'title' => 'Detail Produk',
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $produk
        ];

        return view('user/shop/detail', $data);
    }
}
