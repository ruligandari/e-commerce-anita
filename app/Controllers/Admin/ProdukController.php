<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Database\Migrations\Kategori;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{

    private $produk = null;
    private $kategori = null;
    private $produkSize = null;

    function __construct()
    {
        $this->produk = new \App\Models\ProdukModel();
        $this->kategori = new \App\Models\KategoriModel();
        $this->produkSize = new \App\Models\ProdukSizeModel();
    }

    public function index()
    {
        // produk dengan pagination
        $produk = $this->produk->findAll();
        $data = [
            'title' => 'Produk',
            'produk' => $produk,
        ];
        return view('admin/produk/produk', $data);
    }

    public function add_produk()
    {
        $data = [
            'title' => 'Produk',
            'kategori' => $this->kategori->findAll(),
        ];
        return view('admin/produk/add_produk', $data);
    }
    public function edit_produk($id)
    {
        $produk = $this->produk->find($id);
        $produkSize = $this->produkSize->where('id_produk', $id)->findAll();
        $data = [
            'title' => 'Produk',
            'produk' => $produk,
            'produkSize' => $produkSize,
            'kategori' => $this->kategori->findAll(),
        ];
        return view('admin/produk/edit_produk', $data);
    }

    public function add()
    {
        $nama_produk = $this->request->getPost('nama_produk');
        $id_kategori = $this->request->getPost('id_kategori');
        $harga = $this->request->getPost('harga');
        $deskripsi = $this->request->getPost('deskripsi');
        $foto_produk = $this->request->getFile('foto_produk');
        $S = $this->request->getPost('S');
        $M = $this->request->getPost('M');
        $L = $this->request->getPost('L');
        $XL = $this->request->getPost('XL');
        $XXL = $this->request->getPost('XXL');

        // warna
        $warna1 = $this->request->getPost('warna1');
        $warna2 = $this->request->getPost('warna2');
        $warna3 = $this->request->getPost('warna3');
        $warna4 = $this->request->getPost('warna4');
        $warna5 = $this->request->getPost('warna5');

        // upload foto_produk
        $foto_produk->move('uploads/produk', $foto_produk->getName());

        // try and catch input ke produkModel
        try {
            $this->produk->insert([
                'name' => $nama_produk,
                'kategori_id' => $id_kategori,
                'harga' => $harga,
                'description' => $deskripsi,
                'gambar' => $foto_produk->getName(),
            ]);
            // dapatkan id_produk terakhir dari tabel produk DESC
            $productID = $this->produk->orderBy('id_produk', 'DESC')->first()['id_produk'];
            // insert product_size
            $dataSize = [
                [
                    'id_produk' => $productID,
                    'size' => 'S',
                    'stok' => $S,
                    'color' => $warna1
                ],
                [
                    'id_produk' => $productID,
                    'size' => 'M',
                    'stok' => $M,
                    'color' => $warna2
                ],
                [
                    'id_produk' => $productID,
                    'size' => 'L',
                    'stok' => $L,
                    'color' => $warna3
                ],
                [
                    'id_produk' => $productID,
                    'size' => 'XL',
                    'stok' => $XL,
                    'color' => $warna4
                ],
                [
                    'id_produk' => $productID,
                    'size' => 'XXL',
                    'stok' => $XXL,
                    'color' => $warna5
                ],
            ];

            $this->produkSize->insertBatch(
                $dataSize
            );



            return redirect()->to(base_url('dashboard/produk'))->with('success', 'Berhasil menambahkan produk');
        } catch (\Exception $e) {
            return redirect()->to(base_url('dashboard/produk'))->with('error', 'Produk gagal ditambahkan');
        }
    }

    public function edit()
    {
        $id_produk = $this->request->getPost('id_produk');
        $nama_produk = $this->request->getPost('nama_produk');
        $id_kategori = $this->request->getPost('id_kategori');
        $harga = $this->request->getPost('harga');
        $deskripsi = $this->request->getPost('deskripsi');
        $foto_produk = $this->request->getFile('foto_produk');
        $gambarLama = $this->request->getPost('gambarLama');
        $size = $this->request->getPost('size');
        $warna = $this->request->getPost('warna');

        // dd($warna);

        // cek apakah ada foto yang diupload
        if ($foto_produk->getError()) {
            $namaFoto = $gambarLama;
        } else {
            $foto_produk->move('uploads/produk', $foto_produk->getName());
            $namaFoto = $foto_produk->getName();
        }

        // try and catch input ke produkModel
        try {
            $this->produk->update($id_produk, [
                'name' => $nama_produk,
                'kategori_id' => $id_kategori,
                'harga' => $harga,
                'description' => $deskripsi,
                'gambar' => $namaFoto,
            ]);

            // update product_size
            $this->produkSize->where('id_produk', $id_produk)->delete();
            $dataSize = [];
            foreach ($size as $key => $value) {
                // definisikan key 0 = S, 1 = M, 2 = L, 3 = XL, 4 = XXL
                $keys = $key == 0 ? 'S' : ($key == 1 ? 'M' : ($key == 2 ? 'L' : ($key == 3 ? 'XL' : 'XXL')));
                $warnas = [];
                foreach ($warna as $values) {
                    $warnas[] = $values;
                }
                $dataSize[] = [
                    'id_produk' => $id_produk,
                    'size' => $keys,
                    'stok' => $value,
                    'color' => $warnas[$key]
                ];
            }
            $this->produkSize->insertBatch(
                $dataSize
            );


            return redirect()->to(base_url('dashboard/produk'))->with('success', 'Berhasil mengubah produk');
        } catch (\Exception $e) {
            return redirect()->to(base_url('dashboard/produk'))->with('error', 'Produk gagal diubah');
        }
    }

    public function delete()
    {
        $id_produk = $this->request->getPost('id');
        try {
            $this->produk->delete($id_produk);
            $this->produkSize->where('id_produk', $id_produk)->delete();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk gagal dihapus : ' . $e->getMessage()]);
        }
    }
}
