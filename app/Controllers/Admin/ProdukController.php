<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Produk',
        ];
        return view('admin/produk/produk', $data);
    }
}
