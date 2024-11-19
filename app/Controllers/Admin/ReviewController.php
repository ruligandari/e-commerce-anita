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
        // pisahkan contoh Rok Wanita Rempel&10 menjadi Rok Wanita Rempel dan 10
        $idProduk = explode('&', $id)[0];
        $paginate = explode('&', $id)[1] ?? null;

        if ($paginate) {
            $produk = $this->reviewModel->where('id_produk', $idProduk)->findAll($paginate);
        } else {
            $produk = $this->reviewModel->where('id_produk', $idProduk)->findAll();
        }

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

        // Menghitung denominator untuk m dan c
        $denominator = ($n * $sumX2 - pow($sumX, 2));

        // Cek apakah denominator bernilai nol
        if ($denominator == 0) {
            // Jika denominator nol, gunakan fallback
            $m = 0;  // Slope dianggap nol
            $c = $sumY / $n;  // Intercept dianggap sebagai rata-rata Y
        } else {
            // Jika denominator tidak nol, lakukan perhitungan normal
            $m = ($n * $sumXY - $sumX * $sumY) / $denominator;
            $c = ($sumY * $sumX2 - $sumX * $sumXY) / $denominator;
        }

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
        if ($ssTotal == 0) {
            $rSquared = 1;  // Set rSquared ke 1 karena tidak ada variabilitas
        } else {
            $rSquared = 1 - ($ssResidual / $ssTotal);
        }

        // Menentukan hubungan harga dan rating
        $relationship = "";
        $suggestion = "";
        $kesimpulan = "";

        if ($m > 0) {
            $relationship = "😁 Pelanggan Puas";
            $suggestion = "Pertahankan kualitas produk dan pelayanan yang baik untuk menjaga kepuasan pelanggan. Terus dengarkan umpan balik dari pelanggan untuk perbaikan lebih lanjut.";
            $kesimpulan = "Dengan slope yang positif, menunjukkan bahwa peningkatan harga diiringi dengan peningkatan rating, pelanggan merasa bahwa harga yang dibayarkan sebanding dengan kualitas yang diterima. Pastikan untuk terus meningkatkan pengalaman pelanggan agar kepuasan tetap terjaga.";
        } elseif ($m < 0) {
            $relationship = "😔 Pelanggan Tidak Puas";
            $suggestion = "Untuk meningkatkan kepuasan, Anda mungkin bisa mempertimbangkan untuk menyesuaikan harga atau meningkatkan kualitas produk dan pelayanan agar sejalan dengan harga yang ditetapkan.";
            $kesimpulan = "Dengan slope yang negatif, pelanggan cenderung tidak puas dengan kenaikan harga produk. Meskipun nilai slope sangat kecil, menunjukkan bahwa penurunan rating ini tidak terlalu tajam, tetap ada pengaruh signifikan dari harga terhadap kepuasan pelanggan. Oleh karena itu, penting untuk mengoptimalkan hubungan antara harga dan kualitas produk, serta mempertimbangkan strategi promosi untuk menarik pelanggan.";
        } else {
            $relationship = "😐 Pelanggan Biasa Saja";
            $suggestion = "Harga produk bisa dipertahankan, namun tetap perhatikan kualitas produk dan pelayanan. Upayakan untuk meningkatkan engagement dengan pelanggan untuk mengetahui keinginan dan harapan mereka lebih baik.";
            $kesimpulan = "Dengan slope nol, menunjukkan bahwa perubahan harga tidak berpengaruh signifikan terhadap rating pelanggan. Hal ini bisa berarti pelanggan merasa netral terhadap harga yang ditawarkan. Disarankan untuk melakukan survei untuk memahami lebih dalam tentang persepsi pelanggan dan meningkatkan nilai tambah produk.";
        }

        $data = [
            'title' => 'Review',
            'produk' => $produk,
            'uniqueProduk' => $this->uniqueProduk,
            'id_produk' => $idProduk,
            'paginate' => $paginate,
            'koefisien' => number_format($m, 10, '.', ','),
            'intersep' => round($c, 2),
            'averageRating' => round($averageRating, 2),
            'relationship' => $relationship,
            'rSquared' => round($rSquared, 2),
            'suggestion' => $suggestion,
            'kesimpulan' => $kesimpulan
        ];

        return view('admin/review/review', $data);
    }
}
