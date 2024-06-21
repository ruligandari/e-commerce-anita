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
                    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold">Kategori Produk</h5>
                        <button type="button " class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ti ti-plus"></i>Tambah Kategori</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap mb-0 align-middle" id="myTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama Kategori</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-center">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kategori as $item) : ?>
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-regular mb-1"><?= $item['nama_kategori'] ?></span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2 justify-content-center">
                                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id_kategori'] ?>"><i class="ti ti-edit"></i> Edit</a>
                                                <a href="#" class="btn btn-danger" onclick="deleteData(<?= $item['id_kategori'] ?>)"><i class="ti ti-trash"></i> Hapus</a>
                                            </div>
                                        </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('dashboard/kategori/add') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($kategori as $data) : ?>
        <div class="modal fade" id="editModal<?= $data['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('dashboard/kategori/update') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $data['nama_kategori'] ?>">
                                <input type="hidden" class="form-control" id="id_kategori" name="id_kategori" value="<?= $data['id_kategori'] ?>">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
    </div> -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
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
                    url: '<?= base_url('dashboard/kategori/delete') ?>',
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