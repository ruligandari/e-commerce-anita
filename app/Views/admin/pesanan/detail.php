<?= $this->extend('layouts/admin_layout'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- sweet alert -->
    <!-- berhasil menyimpan -->
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "<?= session()->getFlashdata('success') ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>
    <!-- gagal menyimpan -->
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "<?= session()->getFlashdata('error') ?>",
                icon: "warning"
            });
        </script>
    <?php endif; ?>
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="card-title">
                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <h5 class=" fw-semibold">Detail Pesanan</h5>
                            <!-- btn konfirmasi pesanan -->
                            <?php if ($transaksi['status'] == 'Menunggu Validasi') : ?>
                                <a href="<?= base_url('dashboard/pesanan/validasi/' . $transaksi['no_transaksi']) ?>" class="btn btn-primary">Proses Pesanan</a>
                            <?php elseif ($transaksi['status'] == 'Pesanan Diproses') : ?>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Kirim Pesanan</button>
                            <?php elseif ($transaksi['status'] == 'Pesanan Dikirim') : ?>
                                <a href="<?= base_url('dashboard/pesanan/pesanan_selesai/' . $transaksi['no_transaksi']) ?>" class="btn btn-primary">Pesanan Selesai</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Nama: <?= $transaksi['name'] ?></h6>
                                            <h6>Email: <?= $transaksi['email'] ?></h6>
                                            <h6>No. Telp: <?= $transaksi['phone'] ?></h6>
                                            <!-- alamat -->
                                            <h6>Alamat: <?= $transaksi['address'] ?></h6>
                                        </div>
                                        <div class="col-6">

                                            <h6>Nomor Transaksi: <?= $transaksi['no_transaksi'] ?></h6>
                                            <h6>Tanggal: <?= $transaksi['tanggal'] ?></h6>
                                            <!-- status pembayaran -->
                                            <?php if ($transaksi['status'] == 'Menunggu Pembayaran') : ?>
                                                <h6>Status Pembayaran: <span class="badge bg-danger">Belum Bayar</span></h6>
                                            <?php elseif ($transaksi['status'] == 'Menunggu Validasi') : ?>
                                                <h6>Status Pembayaran: <span class="badge bg-warning">Menunggu Validasi</span></h6>
                                            <?php elseif ($transaksi['status'] == 'Pesanan Diproses') : ?>
                                                <h6>Status Pesanan: <span class="badge bg-success">Pesanan Diproses</span></h6>
                                            <?php elseif ($transaksi['status'] == 'Pesanan Dikirim') : ?>
                                                <h6>Status Pesanan: <span class="badge bg-success">Pesanan Telah Dikirim</span></h6>
                                            <?php endif; ?>
                                            <h6>Nomor resi: <?= $transaksi['no_resi'] ?? 'Belum Ada Resi' ?></h6>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-start">Produk</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-start">Harga</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Qty</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pesanan as $item) : ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $item['name'] ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $item['harga'] ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $item['qty'] ?></h6>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td>
                                                <h5 class="fw-semibold mb-1">Total Pembayaran : </h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <h5 class="fw-semibold mb-1">Rp. <?= $transaksi['total_bayar'] ?></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- card foto bukti pembayaran -->
                                <div class="card">
                                    <div class="card-body">
                                        <?php if ($transaksi['bukti_pembayaran'] != '-') : ?>
                                            <h5 class="card-title">Bukti Pembayaran</h5>
                                            <img src="<?= base_url('uploads/bukti/' . $transaksi['bukti_pembayaran']) ?>" class="img-fluid" alt="bukti pembayaran">
                                        <?php else : ?>
                                            <h5>Belum Ada Bukti Pembayaran.</h5>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Masukan Resi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form action="<?= base_url('dashboard/pesanan/kirim_pesanan') ?>" method="post">
                    <div class="mb-3">
                        <label for="resi" class="form-label">Nomor Resi</label>
                        <input type="text" class="form-control" id="resi" name="resi" required>
                    </div>
                    <input type="text" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>" hidden>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
<?= $this->endSection(); ?>