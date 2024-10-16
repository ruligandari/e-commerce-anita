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
    protected $pemesanan;
    protected $transaksi;
    protected $review;

    public function __construct()
    {
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->produkModel = new \App\Models\ProdukModel();
        $this->sizeModel = new \App\Models\ProdukSizeModel();
        $this->cart = new \App\Models\CartModel();
        $this->pemesanan = new \App\Models\PemesananModel;
        $this->transaksi = new \App\Models\TransaksiModel();
        $this->review = new \App\Models\ReviewModel();
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

        $namaProduk = $produk['name'];

        $review = $this->review->where('id_produk', $namaProduk)->findAll();

        $size =  $this->sizeModel->where('id_produk', $id)->findAll();
        $data = [
            'title' => 'Detail Produk',
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $produk,
            'review' => $review,
            'size' => $size
        ];

        return view('user/shop/detail', $data);
    }

    public function edit($id_produk, $id_keranjang)
    {
        $size =  $this->sizeModel->where('id_produk', $id_produk)->findAll();
        $data = [
            'title' => 'Update Keranjang',
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $this->produkModel->find($id_produk),
            'size' => $size,
            'id_keranjang' => $id_keranjang
        ];

        return view('user/shop/update', $data);
    }

    public function update()
    {
        $id_keranjang = $this->request->getPost('id_keranjang');

        $id_produk = $this->request->getPost('id_produk');
        $id_size = $this->request->getPost('id_size');
        $qty = $this->request->getPost('qty');
        $id_user = session()->get('id');
        $data = [
            'id_produk' => $id_produk,
            'id_size' => $id_size,
            'id_user' => $id_user,
            'qty' => $qty
        ];

        $this->cart->update($id_keranjang, $data);

        return redirect()->to('shop/confirm')->with('success', 'Keranjang Berhasil diUpdate');
    }

    public function process()
    {
        // cek login
        $id_produk = $this->request->getPost('id_produk');
        $id_size = $this->request->getPost('id_size');
        $qty = $this->request->getPost('qty');
        if (session()->get('isloginCustomer') == TRUE) {

            $id_user = session()->get('id');

            $data = [
                'id_produk' => $id_produk,
                'id_size' => $id_size,
                'id_user' => $id_user,
                'qty' => $qty
            ];

            $this->cart->insert($data);

            return redirect()->to('/shop/' . $id_produk)->with('success', 'Produk berhasil ditambahkan ke keranjang');
        } else {
            return redirect()->to('/shop/' . $id_produk)->with('error', 'Silahkan login terlebih dahulu');
        }
    }

    public function confirm()
    {
        $id_user = session()->get('id');
        $data = [
            'title' => 'Konfirmasi Pesanan',
            'kategori' => $this->kategoriModel->findAll(),
            'cart' => $this->cart->where('id_user', $id_user)->join('produk', 'produk.id_produk = cart.id_produk')->join('produk_size', 'produk_size.id_produk_size = cart.id_size')->findAll()
        ];

        return view('user/shop/confirmation', $data);
    }

    public function checkout()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id_user = $this->request->getPost('id_user');
        $total = $this->request->getPost('total');
        $no_pemesanan = 'INV' . uniqid() . time();
        $no_transaksi = 'TR' . uniqid() . time();

        $tanggal = date('Y-m-d');


        // cek apakah ada keranjang
        $cart = $this->cart->where('id_user', $id_user)->findAll();
        if (count($cart) == 0) {
            return redirect()->to('/shop')->with('error', 'Keranjang masih kosong');
        } else {
            // insert  ke tabel transaksi
            $data = [
                'id_customer' => $id_user,
                'total_bayar' => $total,
                'status' => 'Menunggu Pembayaran',
                'no_pemesanan' => $no_pemesanan,
                'no_transaksi' => $no_transaksi,
                'tanggal' => $tanggal,
                'bukti_pembayaran' => '-',
            ];
            $this->transaksi->insert($data);

            // insert ke tabel pemesanan
            // jika ada lebih dari 1 produk
            if (count($cart) > 1) {
                foreach ($cart as $cart) {
                    $data = [
                        'no_pemesanan' => $no_pemesanan,
                        'id_produk' => $cart['id_produk'],
                        'id_size' => $cart['id_size'],
                        'qty' => $cart['qty']
                    ];
                    $this->pemesanan->insert($data);
                }
            } else {
                $data = [
                    'no_pemesanan' => $no_pemesanan,
                    'id_produk' => $cart[0]['id_produk'],
                    'id_size' => $cart[0]['id_size'],
                    'qty' => $cart[0]['qty']
                ];
                $this->pemesanan->insert($data);
            }
            $this->cart->where('id_user', $id_user)->delete();
            return redirect()->to('/shop/keranjang')->with('success', $no_transaksi);
        }
    }

    public function pembayaran($no_transaksi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=211&destination=211&weight=1000&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: bac4a5fca37f421112743026eb06a53a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ongkir = json_decode($response);
            $respon = $ongkir->rajaongkir->results[0];

            $hargaOngkir = $respon->costs[0]->cost[0]->value;
        }
        $id_user = session()->get('id');

        // cari transaksi dengan id_user dan no_transaksi

        $transaksi = $this->transaksi->where('no_transaksi', $no_transaksi)->join('customer', 'customer.id = transaksi.id_customer')->first();
        $order = $this->pemesanan->where('no_pemesanan', $transaksi['no_pemesanan'])->join('produk', 'produk.id_produk = pemesanan.id_produk')->join('produk_size', 'produk_size.id_produk_size = pemesanan.id_size')->findAll();
        $data = [
            'title' => 'Pembayaran',
            'kategori' => $this->kategoriModel->findAll(),
            'transaksi' => $transaksi,
            'order' => $order,
            'ongkir' => $hargaOngkir
        ];

        return view('user/shop/invoice', $data);
    }

    public function upload_bukti()
    {
        $no_transaksi = $this->request->getPost('no_transaksi');
        $bukti = $this->request->getFile('bukti_pembayaran');
        $total = $this->request->getPost('total_bayar');

        $bukti->move('uploads/bukti', $bukti->getName());

        try {

            // update transaksi berdasarkan no_transaksi, upate bukti_pembayaran dan status
            $update = $this->transaksi->where('no_transaksi', $no_transaksi)->set(['bukti_pembayaran' => $bukti->getName(), 'status' => 'Menunggu Validasi', 'total_bayar' => $total])->update();
            return redirect()->to('/shop')->with('success', 'Bukti Pembayaran berhasil diupload');
        } catch (\Throwable $th) {
            redirect()->to('/shop/keranjang')->with('error', 'Bukti Pembayaran gagal diupload');
        }
    }

    public function get_pesanan()
    {
        $id = $this->request->getPost('id');
        // where id_customer = $id, join no_pemesanan di tabel pemesanan, DESC
        $transaksi = $this->transaksi
            ->where('id_customer', $id)
            ->join('pemesanan', 'pemesanan.no_pemesanan = transaksi.no_pemesanan')
            ->join('produk', 'pemesanan.id_produk = produk.id_produk')
            ->orderBy('transaksi.id_transaksi', 'DESC') // Urutkan DESC
            ->findAll();

        // buat foreach jika ada $transaksi['id_transaksi] yang sama pilih salah satu saja
        // Menghilangkan duplikat berdasarkan id_transaksi
        $uniqueTransaksi = [];
        foreach ($transaksi as $t) {
            if (!isset($uniqueTransaksi[$t['id_transaksi']])) {
                $uniqueTransaksi[$t['id_transaksi']] = $t;
            }
        }

        // Konversi kembali array menjadi daftar
        $transaksi = array_values($uniqueTransaksi);
        $data = [
            'transaksi' => $transaksi,
            'total' => count($transaksi)
        ];
        // return json_encode($transaksi);
        return $this->response->setJSON($data);
    }

    public function detail_pesanan($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=211&destination=211&weight=1000&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: bac4a5fca37f421112743026eb06a53a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ongkir = json_decode($response);
            $respon = $ongkir->rajaongkir->results[0];

            $hargaOngkir = $respon->costs[0]->cost[0]->value;
        }
        $transaksi = $this->transaksi->where('no_transaksi', $id)->join('pemesanan', 'pemesanan.no_pemesanan = transaksi.no_pemesanan')->join('produk', 'pemesanan.id_produk = produk.id_produk')->findAll();
        $status = $this->transaksi->where('no_transaksi', $id)->find();
        $data = [
            'title' => 'Detail Pesanan',
            'transaksi' => $transaksi,
            'kategori' => $this->kategoriModel->findAll(),
            'status' => $status,
            'ongkir' => $hargaOngkir
        ];

        return view('user/pesanan/pesanan', $data);
    }

    public function pesanan_diterima()
    {

        // find traksaksi by $id
        $idTransaksi = $this->request->getPost('id');

        $transaksi = $this->transaksi->find($idTransaksi);

        $no_transaksi = $transaksi['no_transaksi'];

        $data = [
            'status' => 'Pesanan Selesai'
        ];

        try {
            $this->transaksi->update($idTransaksi, $data);
            return $this->response->setJSON($data);
        } catch (\Throwable $th) {
            return $this->response->setJSON($th);
        }
    }

    public function review()
    {
        $id = $this->request->getPost('id');
        $rating = $this->request->getPost('rating');
        $review = $this->request->getPost('review');
        $id_produk = $this->request->getPost('id_produk');
        $customer = $this->request->getPost('customer');
        $harga = $this->request->getPost('harga');

        $data = [
            'rating' => $rating,
            'review' => $review,
            'id_produk' => $id_produk,
            'customer' => $customer,
            'harga_produk' => $harga
        ];

        // insert ke tabel review
        $this->review->insert($data);
        // return redirect
        return redirect()->to(base_url('shop/') . $id)->with('review', 'Terima Kasih atas review anda');
    }
}
