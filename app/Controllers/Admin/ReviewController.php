<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewController extends BaseController
{
    protected $reviewModel;
    protected $uniqueProduk;
    protected $dataDummy;
    public function __construct()
    {
        $this->reviewModel = new \App\Models\ReviewModel();
        // find all data
        $this->dataDummy = $this->reviewModel->findAll();
        // get unique produk
        $this->uniqueProduk = array_unique(array_column($this->dataDummy, 'id_produk'));
        // dataDummy by id

    }
    public function index()
    {

        // kelompokan produk berdasarkan field id_produk



        $data = [
            'title' => 'Review',
            'produk' => $this->dataDummy,
            'uniqueProduk' => $this->uniqueProduk,
            'id_produk' => ''
        ];

        return view('admin/review/review', $data);
    }

    public function detail($id)
    {
        $produk = $this->reviewModel->where('id_produk', $id)->findAll();

        // Menghitung jumlah data
        $n = count($produk);

        // Menghitung sum(x), sum(y), sum(x*y), sum(x^2)
        $sumX = $sumY = $sumXY = $sumX2 = 0;

        foreach ($produk as $item) {
            $sumX += $item['harga_produk'];
            $sumY += $item['rating'];
            $sumXY += $item['harga_produk'] * $item['rating'];
            $sumX2 += pow($item['harga_produk'], 2);
        }

        // Menghitung koefisien regresi
        $m = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - pow($sumX, 2));
        $c = ($sumY * $sumX2 - $sumX * $sumXY) / ($n * $sumX2 - pow($sumX, 2));


        // Rata-rata rating pelanggan
        $averageRating = $sumY / $n;

        // Menghitung nilai prediksi dan residual sum of squares (RSS)
        $ssTotal = $ssResidual = 0;
        foreach ($produk as $item) {
            $predictedY = $m * $item['harga_produk'] + $c;
            $ssTotal += pow($item['rating'] - $averageRating, 2);
            $ssResidual += pow($item['rating'] - $predictedY, 2);
        }

        // Menghitung koefisien determinasi (R^2)
        $rSquared = 1 - ($ssResidual / $ssTotal);

        // Menentukan hubungan harga dan rating
        $relationship = "";
        $suggestion = "";
        if ($m > 0) {
            $relationship = "😁 Pelanggan Puas";
            $suggestion = "Pertahankan ! dan tetap perhatikan kualitas produk dan pelayanan";
        } elseif ($m < 0) {
            $relationship = "😔 Pelanggan Tidak Puas";
            $suggestion = "Harga produk bisa diturunkan, namun tetap perhatikan kualitas produk dan pelayanan";
        } else {
            $relationship = "😐 Pelanggan Biasa Saja";
            $suggestion = "Harga produk bisa dipertahankan, namun tetap perhatikan kualitas produk dan pelayanan";
        }

        $data = [
            'title' => 'Review',
            'produk' => $produk,
            'uniqueProduk' => $this->uniqueProduk,
            'id_produk' => $id,
            'koefisien' => number_format($m, 10, '.', ','),
            'intersep' => round($c, 2),
            'averageRating' => round($averageRating, 2),
            'relationship' => $relationship,
            'rSquared' => round($rSquared, 2),
            'suggestion' => $suggestion,
        ];

        return view('admin/review/review', $data);
    }
}
