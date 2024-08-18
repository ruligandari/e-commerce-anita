<?= $this->extend('user/layouts'); ?>

<?= $this->section('header'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- breadcrumb -->
<div class="container mt-3">

</div>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Checkout Berhasil!",
            text: "<?= session()->getFlashdata('success') ?>",
            icon: "success",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Lanjutkan Pembayaran!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('shop/Pemesanan') ?>";
            }
        });
    </script>
<?php elseif (session()->getFlashdata('error')) : ?>

<?php endif; ?>
<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" method="POST" action="<?= base_url('shop/upload_bukti') ?>" enctype="multipart/form-data">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mb-3">
                <h4 class="fw-bold">INVOICE TRANSAKSI <?= $transaksi['no_pemesanan'] ?></h4>
            </div>
            <div class=" col-lg-6 md-12 sm-12">
                <table>
                    <tr>
                        <td style="width: 120px;">Kode Transaksi</td>
                        <td>: <?= $transaksi['no_transaksi'] ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>: <?= $transaksi['tanggal'] ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class=" col-lg-6 md-12 sm-12">
                <table>
                    <tr>
                        <td style="width: 120px;">Nama Customer</td>
                        <td>: <?= $transaksi['name'] ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>: <?= $transaksi['phone'] ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td valign="top">Alamat</td>
                        <td valign="top">: <?= $transaksi['address'] ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr color="black">
        <div class="d-flex justify-content-center">
            <img src="<?= base_url('fashion/img/banner/spay.jpeg') ?>" class="img-fluid" style="max-width:250px; min-width:100px; height-auto" alt="">
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>SUB Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($order as $data) :
                            ?>
                                <tr>
                                    <td class=" product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <p class="mb-3"><?= $data['name'] ?><br><span class="mt-2">Rp.<?= $data['harga'] ?>,-</span></p>
                                            <img src="<?= base_url('uploads/produk/' . $data['gambar']) ?>" class="h-50 w-50" alt="">
                                        </div>
                                    </td>
                                    <td class="quantity__item" valign="top">
                                        <div class="quantity">
                                            <div class="">
                                                <?= $data['qty'] ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price" valign="top"><?= $data['harga'] * $data['qty'] ?>,-</td>
                                </tr>
                            <?php
                                $total = $total = $data['harga'] * $data['qty'];
                            endforeach;
                            ?>
                            <tr>
                                <td class="cart__price" valign="top" colspan="2">SUB TOTAL</td>
                                <td class="cart__price" valign="top">Rp.<?= $transaksi['total_bayar'] ?>,-</td>
                            </tr>
                            <tr>
                                <td class="cart__price" valign="top" colspan="2">Ongkir (JNE)</td>
                                <td class="cart__price" valign="top">Rp.<?= $ongkir ?>,-</td>
                            </tr>

                            <tr>
                                <td class="cart__price" valign="top" colspan="2">TOTAL</td>
                                <td class="cart__price" valign="top">Rp.<?= $transaksi['total_bayar'] + $ongkir ?>,-</td>
                            </tr>
                            <?php $totalTransaksi = $transaksi['total_bayar'] + $ongkir ?>
                            <tr>
                                <td class="cart__price" valign="top" colspan="3">Pembayaran Daapat Dilakukan Transfer Bank BCA (763 0414 673) a.n Toko Baju</td>
                            </tr>
                            <tr>
                                <td class="cart__price" valign="top" colspan="3">Pembayaran Daapat Dilakukan Dengan QRIS <br><img width="200px" src="<?= base_url('qr.png') ?>" class="img-fluid" style="" alt=""> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row lg-mx-5 md-mx-5 sm-mx-2 d-flex justify-content-center">
            <div class="categories__deal__countdown">
                <center>
                    <h6 class="my-3">Harap Lakukan Pembayaran Sebelum</h6>
                </center>
                <div class="categories__deal__countdown__timer" id="timer">
                    <div class="cd-item">
                        <span id="days">0</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span id="hours">23</span>
                        <p>Hours</p>
                    </div>
                    <div class="cd-item">
                        <span id="minutes">59</span>
                        <p>Minutes</p>
                    </div>
                    <div class="cd-item">
                        <span id="seconds">59</span>
                        <p>Seconds</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row lg-mx-5 md-mx-5 sm-mx-2 mb-3">
            <div class="categories__deal__countdown">
                <strong> Upload Bukti Pembayaran</strong>
                <input class="form-control my-2" type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                <input class="form-control my-2" type="text" id="no_transaksi" name="no_transaksi" value="<?= $transaksi['no_transaksi'] ?>" hidden>
                <input class="form-control my-2" type="text" id="total_bayar" name="total_bayar" value="<?= $totalTransaksi ?>" hidden>
                <img src="" id="output" alt="" width="100%" class="mb-3">
                <button class="btn btn-dark text-light w-100 my-2">Kirim</button>

            </div>
        </div>
    </div>
</form>

<script>
    let countdownDate = new Date().setSeconds(new Date().getSeconds() + 84600);
    let timerInterval;
    const daysElem = document.getElementById("days"),
        hoursElem = document.getElementById("hours"),
        minutesElem = document.getElementById("minutes"),
        secondsElem = document.getElementById("seconds"),
        timer = document.getElementById("timer"),
        content = document.getElementById("content");

    const formatTime = (time) => {
        return time == 1 ? `${time} ` : `${time} `;
    };

    const startCountdown = () => {
        const now = new Date().getTime();
        const countdown = new Date(countdownDate).getTime();

        const difference = (countdown - now) / 1000;

        if (difference < 1) {
            endCountdown();
        }

        let days = Math.floor(difference / (60 * 60 * 24));
        let hours = Math.floor((difference % (60 * 60 * 24)) / (60 * 60));
        let minutes = Math.floor((difference % (60 * 60)) / 60);
        let seconds = Math.floor(difference % 60);

        daysElem.innerHTML = formatTime(days);
        hoursElem.innerHTML = formatTime(hours);
        minutesElem.innerHTML = formatTime(minutes);
        secondsElem.innerHTML = formatTime(seconds);
    };

    const endCountdown = () => {
        clearInterval(timerInterval);
        timer.remove();
        content.classList.add("visible");
    };

    window.addEventListener("load", () => {
        startCountdown();
        timerInterval = setInterval(startCountdown, 1000);
    });
</script>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>