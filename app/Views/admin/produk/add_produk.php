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
                        <h5 class="card-title fw-semibold">Informasi Produk</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('dashboard/produk/add') ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kategori</label>
                                    <select name="id_kategori" id="" class="form-control">
                                        <option value="" selected>Pilih kategori</option>
                                        <?php foreach ($kategori as $item) : ?>
                                            <option value="<?= $item['id_kategori'] ?>"><?= $item['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10"></textarea>
                                </div>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-4">Foto Produk</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" name="foto_produk" id="exampleInputPassword1" onchange="previewImage(event)">
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-4">Variasi Ukuran</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="basic-url" class="form-label">Ukuran & Stok</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">S</span>
                                            <input type="number" class="form-control" id="basic-url" name="S" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">M</span>
                                            <input type="number" class="form-control" id="basic-url" name="M" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">L</span>
                                            <input type="number" class="form-control" id="basic-url" name="L" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">XL</span>
                                            <input type="number" class="form-control" id="basic-url" name="XL" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">XXL</span>
                                            <input type="number" class="form-control" id="basic-url" name="XXL" aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="basic-url" class="form-label">Warna</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Warna 1</span>
                                            <input type="text" class="form-control" id="basic-url" name="warna1" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Warna 2</span>
                                            <input type="text" class="form-control" id="basic-url" name="warna2" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Warna 3</span>
                                            <input type="text" class="form-control" id="basic-url" name="warna3" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Warna 4</span>
                                            <input type="text" class="form-control" id="basic-url" name="warna4" aria-describedby="basic-addon3">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Warna 5</span>
                                            <input type="text" class="form-control" id="basic-url" name="warna5" aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="ukuranLain"></div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
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
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.innerHTML = '<img src="' + reader.result + '" class="img-fluid" style="height:100px;">';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
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