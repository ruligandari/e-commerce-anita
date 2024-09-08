<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public $customer;
    // cunsctruct
    public function __construct()
    {
        // data customer
        $this->customer = model('CustomerModel');
    }
    public function index()
    {
        $dataCustomer = $this->customer->findAll();
        $data = [
            'title' => 'User',
            'data' => $dataCustomer,
        ];
        return view('admin/user/user', $data);
    }
}
