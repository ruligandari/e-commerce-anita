<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{

    private $produk = null;

    function __construct()
    {
        $this->produk = new \App\Models\ProdukModel();
    }

    public function index()
    {
        // produk dengan pagination
        $produk = $this->produk->paginate(10);
        $pager = $this->produk->pager;
        $data = [
            'title' => 'Produk',
            'produk' => $produk,
            'pager' => $pager,
        ];
        return view('admin/produk/produk', $data);
    }
}
