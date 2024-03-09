<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public $admin;

    public function __construct()
    {
        $this->admin = model('AdminModel');
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('admin/auth/login', $data);
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');

        $session = session();

        // cek csrf token
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            session()->setFlashdata('error', 'CSRF token error');
            return redirect()->to('/login');
        }
        // kembalikan menjadi object
        $admin = $this->admin->where('username', $username)->asObject()->first();

        if ($admin) {
            if (password_verify($password, $admin->password)) {
                session()->set([
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'username' => $admin->username,
                ]);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
