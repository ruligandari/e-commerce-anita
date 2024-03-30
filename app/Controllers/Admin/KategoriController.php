<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriController extends BaseController
{
    private $kategoriModel;
    public function __construct()
    {
        $this->kategoriModel = new \App\Models\KategoriModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('admin/kategori/kategori', $data);
    }

    public function add()
    {
        $nama_kategori = $this->request->getPost('nama_kategori');

        $data = [
            'nama_kategori' => $nama_kategori
        ];

        $this->kategoriModel->insert($data);

        return redirect()->to(base_url('dashboard/kategori'))->with('success', 'Kategori berhasil ditambahkan');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->kategoriModel->delete($id);

        // return json
        return $this->response->setJSON(['status' => 'success', 'message' => 'Kategori berhasil dihapus']);
    }

    public function update()
    {
        $id = $this->request->getPost('id_kategori');
        $nama_kategori = $this->request->getPost('nama_kategori');

        $data = [
            'nama_kategori' => $nama_kategori
        ];

        $this->kategoriModel->update($id, $data);

        return redirect()->to(base_url('dashboard/kategori'))->with('success', 'Kategori berhasil diubah');
    }
}
