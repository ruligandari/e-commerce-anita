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
                            <form action="<?= base_url('dashboard/produk/edit') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" value="<?= $produk['name'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kategori</label>
                                    <select name="id_kategori" id="" class="form-control">
                                        <option value="" selected>Pilih kategori</option>
                                        <?php foreach ($kategori as $item) : ?>
                                            <option value="<?= $item['id_kategori'] ?>" <?= ($produk['kategori_id'] == $item['id_kategori']) ? 'selected' : '' ?>><?= $item['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" value="<?= $produk['harga'] ?>" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10"><?= $produk['description'] ?></textarea>
                                </div>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-4">Foto Produk</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" name="foto_produk" id="fotoProduk" onchange="previewImage(event)">
                                <input type="text" name="gambarLama" value="<?= $produk['gambar'] ?>" hidden>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                            <div id="latesImage" class="mt-3">

                            </div>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-4">Variasi Ukuran</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Ukuran & Stok</label>
                                <?php foreach ($produkSize as $item) : ?>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3"><?= $item['size'] ?></span>
                                        <input type="number" class="form-control" id="basic-url" name="size[]" value="<?= $item['stok'] ?>" aria-describedby="basic-addon3">
                                    </div>
                                <?php endforeach; ?>
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
    // jalankan function dibawah saat pertama diload

    function latesImage() {
        var output = document.getElementById('latesImage');
        output.innerHTML = '<span class="text-dark">Foto Produk Sebelumnya</span><br><img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" class="img-fluid" style="height:100px;">';
    }

    if (document.getElementById('fotoProduk').value == '') {
        latesImage();
    } else {
        // hapus DOM id latesImage
        document.getElementById('latesImage').remove();
    }
</script>

<?= $this->endSection(); ?>