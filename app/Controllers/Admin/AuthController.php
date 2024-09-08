<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public $admin;
    protected $customer;

    public function __construct()
    {
        $this->admin = model('AdminModel');
        $this->customer = model('CustomerModel');
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
                    'isloginAdmin' => 'true',
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

    public function customer_login()
    {
        $data = [
            'title' => 'Login Customer',
        ];
        return view('admin/auth/customer_login', $data);
    }

    public function customer_auth()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');

        $customer = $this->customer->where('email', $email)->asObject()->first();

        if ($customer) {
            if ($password == $customer->password) {
                session()->set([
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'alamat' => $customer->address,
                    'isloginCustomer' => 'true',
                ]);
                return redirect()->to('/shop');
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to('/customer/login');
            }
        } else {
            session()->setFlashdata('error', 'Email tidak ditemukan');
            return redirect()->to('/customer/login');
        }
    }

    public function customer_register()
    {
        $data = [
            'title' => 'Register Customer',
        ];
        return view('admin/auth/customer_register', $data);
    }

    public function customer_auth_register()
    {
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $email = $this->request->getPost('email');
        $no_hp = $this->request->getPost('no_hp');
        $alamat = $this->request->getPost('alamat');
        $password = $this->request->getPost('password');
        $password_2 = $this->request->getPost('password_2');

        if ($password != $password_2) {
            session()->setFlashdata('error', 'Password tidak sama');
            return redirect()->to('/customer/register');
        }

        $data = [
            'name' => $nama_lengkap,
            'email' => $email,
            'phone' => $no_hp,
            'address' => $alamat,
            'password' => $password,
        ];

        $this->customer->insert($data);
        session()->setFlashdata('success', 'Register berhasil, Silahkan Login');
        return redirect()->to('/customer/login');
    }

    public function customer_logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
