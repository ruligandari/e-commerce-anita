<?= $this->extend('user/layouts'); ?>

<?= $this->section('content'); ?>
<!-- breadcrumb -->
<div class="container mt-3">

</div>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Checkout Berhasil!",
            text: "Checkout Berhasil, Silahkan Lanjutkan Pembayaran!",
            icon: "success",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Lanjutkan Pembayaran!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('shop/checkout/' . session()->getFlashdata('success')) ?>";
            }
        });
    </script>
<?php elseif (session()->getFlashdata('error')) : ?>

<?php endif; ?>
<br>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
            <div class="m-l-25 m-r--38 m-lr-0-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-3">
                                    <span class="header-cart-item-info badge bg-success text-white">
                                        <?= $status[0]['status'] ?>
                                    </span>

                                </div>
                                <div class="col-9 d-flex justify-content-end">
                                    <?php if ($transaksi[0]['no_resi'] != ''): ?>
                                        <h6>Nomor Resi: <?= $transaksi[0]['no_resi'] ?></h6>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th class="column-1">Produk</th>
                            <th class="column-2"></th>
                            <th class="column-3">Harga</th>
                            <th class="column-4">Kuantitas</th>
                            <th class="column-5">Subtotal</th>
                            <th class="column-6">Aksi</th>
                        </tr>
                        <?php
                        $total = 0;
                        foreach ($transaksi as $cart) : ?>

                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="<?= base_url('uploads/produk/' . $cart['gambar']) ?>" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2"><?= $cart['name'] ?></td>
                                <td class="column-3">Rp. <?= $cart['harga'] ?></td>
                                <td class="column-4">
                                    <?= $cart['qty'] ?>
                                </td>
                                <td class="column-5">Rp. <?= $subtotal = $cart['harga'] * $cart['qty'] ?></td>
                                <td class="column-6"> <a href="<?= base_url('shop/') . $cart['id_produk'] . '#reviews' ?>" class="btn btn-primary">Review</a> </td>

                            </tr>
                            <?php $total += $subtotal ?>
                        <?php endforeach; ?>
                        <tr class="table_row">
                            <td colspan="5" class="column-1">
                                <h5 class="fw-semibold mb-1">Total Pembayaran </h5>
                                <h5 class="fw-semibold mb-1">Ongkos Kirim </h5>
                                <br>
                                <h5 class="fw-semibold mb-1">Total Pembayaran</h5>
                            </td>
                            <td class="column-2">
                                <h5 class="fw-semibold mb-1">: Rp. <?= $total ?></h5>
                                <h5 class="fw-semibold mb-1">: Rp. <?= $ongkir ?></h5>
                                <br>
                                <h5 class="fw-semibold mb-1">: Rp. <?= $total + $ongkir ?></h5>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php if ($transaksi[0]['status'] == 'Pesanan Dikirim'): ?>
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-success" onclick="modal()">Pesanan Diterima</button>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    // sweetalert
    function modal() {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Pesanan Akan diselesaikan",
            icon: "warning",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Selesaikan Pesanan!"
        }).then((result) => {
            if (result.isConfirmed) {
                // ajax post
                $.ajax({
                    url: "<?= base_url('shop/detail/terima_pesanan') ?>",
                    type: "POST",
                    data: {
                        id: <?= $transaksi[0]['id_transaksi'] ?>
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Pesanan Selesai!",
                            text: "Pesanan Telah Selesai, Terima Kasih!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //   refresh page
                                location.reload();
                            }
                        });
                    }
                })
            }
        })
    }
</script>

<?= $this->endSection(); ?>