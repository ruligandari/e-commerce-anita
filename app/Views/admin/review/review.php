<?= $this->extend('layouts/admin_layout'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
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
                    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold">Review Produk</h5>
                    </div>
                    <!-- menampilkan select untuk memilih produk -->
                    <div class="col-12 mb-4">
                        <label for="selectProduk" class="form-label">Pilih Produk:</label>
                        <select class="form-select" id="selectProduk">
                            <option value="">Pilih Produk</option>
                            <?php foreach ($uniqueProduk as $items) : ?>
                                <option value="<?= $items ?>" <?= ($items == $id_produk) ? 'selected' : '' ?>><?= $items ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if ($id_produk != '') : ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-semibold p-2">Analisis Metode Least Square</h5>
                                <div class="col-12 mb-4">
                                    <label for="selectProduk" class="form-label">Pilih Jumlah Data:</label>
                                    <select class="form-select" id="selectTotalData">
                                        <option value="">Semua</option>
                                        <option value="10" <?= $paginate == 10 ? 'selected' : '' ?>>10</option>
                                        <option value="20" <?= $paginate == 20 ? 'selected' : '' ?>>20</option>
                                        <option value="50" <?= $paginate == 50 ? 'selected' : '' ?>>50</option>
                                    </select>
                                </div>
                                <div class="row d-flex ">
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Determinasi</h5>
                                                <p class="card-text"> <?= $rSquared ?></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Regresi</h5>
                                                <p class="card-text"> <?= $koefisien ?></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Rata-Rata Rating</h5>
                                                <p class="card-text">⭐️ <?= $averageRating ?></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Tingkat Kepuasan</h5>
                                                <p class="card-text"> <?= $relationship ?></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        Saran: <?= $suggestion ?>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        Kesimpulan: <?= $kesimpulan ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped text-nowrap mb-0 align-middle" id="myTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-start">Nama Pelanggan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-start">Nama Produk</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-start">Harga Produk</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-start">Rating</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($produk as $item) : ?>
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1 text-start"><?= $item['customer'] ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><?= $item['id_produk'] ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success rounded-3 fw-semibold">Rp. <?= number_format($item['harga_produk'], 0, ',', '.') ?></span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success rounded-3 fw-semibold">⭐️ <?= $item['rating'] ?></span>
                                            </div>
                                        </td>
                                        <!-- tambah aksi -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
    </div> -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    // select produk
    $('#selectProduk').change(function() {
        let id = $(this).val();
        if (id != '') {
            window.location.href = '<?= base_url('dashboard/review') ?>' + '/' + id;
        } else {
            window.location.href = '<?= base_url('dashboard/review') ?>';
        }
    });

    // select total data
    $('#selectTotalData').change(function() {
        let id = $(this).val();
        let selectedProduk = $('#selectProduk').val();
        if (id != '') {
            window.location.href = '<?= base_url('dashboard/review') ?>' + '/' + selectedProduk + '&' + id;
        } else {
            window.location.href = '<?= base_url('dashboard/review') ?>' + '/' + selectedProduk;
        }
    });
</script>
<script>
    let table = new DataTable('#myTable');
</script>
<script>
    // delete
    function deleteData(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // ajax request post
                $.ajax({
                    url: '<?= base_url('dashboard/produk/delete') ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function() {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    },
                    // error
                    error: function() {
                        console.log('error');
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection(); ?>