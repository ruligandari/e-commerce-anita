<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ShopController extends BaseController
{
    private $kategoriModel;
    private $produkModel;
    private $sizeModel;
    private $cart;
    public function __construct()
    {
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->produkModel = new \App\Models\ProdukModel();
        $this->sizeModel = new \App\Models\ProdukSizeModel();
        $this->cart = new \App\Models\CartModel();
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

        $size =  $this->sizeModel->where('id_produk', $id)->findAll();
        $data = [
            'title' => 'Detail Produk',
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $produk,
            'size' => $size
        ];

        return view('user/shop/detail', $data);
    }

    public function process()
    {
        $id_produk = $this->request->getPost('id_produk');
        $id_size = $this->request->getPost('id_size');
        $qty = $this->request->getPost('qty');

        $data = [
            'id_produk' => $id_produk,
            'id_size' => $id_size,
            'qty' => $qty
        ];

        $this->cart->insert($data);
    }
}
