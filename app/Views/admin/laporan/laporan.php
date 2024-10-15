<?= $this->extend('layouts/admin_layout'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
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
                        <h5 class="card-title fw-semibold">Data Transaksi</h5>
                        <table border="0" cellspacing="5" cellpadding="5" class="mb-4">
                            <tbody>
                                <tr>
                                    <td>Tanggal Awal:</td>
                                    <td><input type="text" id="min" name="min"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Akhir:</td>
                                    <td><input type="text" id="max" name="max"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped text-nowrap mb-0 align-middle" id="myTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-start">Tanggal</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-start">Customer</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Transaksi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Total (Rp)</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transaksi as $item) : ?>
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><?= $item['tanggal'] ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><?= $item['name'] ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><?= $item['no_transaksi'] ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <?= number_format($item['total_bayar'], 0, ',', '.') ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success rounded-3 fw-semibold"><?= $item['status'] ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Total</th>
                                    <th id="total"></th>
                                    <th></th>
                                </tr>
                            </tfoot>
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
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script>
    $(document).ready(function() {

        let table, minDate, maxDate;

        minDate = new DateTime('#min', {
            format: 'YYYY-MM-DD'
        });

        maxDate = new DateTime('#max', {
            format: 'YYYY-MM-DD'
        });
        DataTable.ext.search.push(function(settings, data, dataIndex) {
            let min = minDate.val();
            let max = maxDate.val();
            let date = new Date(data[0]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });

        table = $('#myTable').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    footer: true,
                    title: "List Transaksi -  <?= date('d-m-Y') ?>"

                },
                {
                    extend: 'pdfHtml5',
                    footer: true,
                    title: "List Transaksi -  <?= date('d-m-Y') ?>"

                }
            ],
            order: [
                [0, 'desc']
            ],
        });

        function totalHarga() {
            let total = 0;
            let totalData = table.rows({
                search: 'applied'
            }).nodes(); // Ambil semua baris yang difilter
            let currentPageData = table.rows({
                search: 'applied',
                page: 'current'
            }).nodes(); // Ambil baris di halaman saat ini

            // Debug: Tampilkan data yang diambil dari halaman saat ini

            $(currentPageData).each(function() {
                let value = $(this).find('td:eq(3)').text(); // Ambil data dari kolom ke-4 (Total Rp)
                let parsedValue = parseInt(value.replace(/\./g, ''), 10); // Parsing value

                total += isNaN(parsedValue) ? 0 : parsedValue; // Tambahkan nilai ke total
            });

            // Format total ke dalam format mata uang IDR
            $('#total').html(new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total));

        }


        document.querySelectorAll('#min, #max').forEach((el) => {
            el.addEventListener('change', function() {
                table.draw();
                totalHarga();
            });
        });

        // tambahkan kode pada saat search data menampilkam total harga
        table.on('search.dt', function() {
            totalHarga();
        });

        totalHarga();
        // Move the buttons container to the dataTables_filter container
        table.buttons().container().appendTo($('#myTable_wrapper .dataTables_filter'));

        table.on('draw.dt', function() {
            totalHarga(); // Panggil ulang totalHarga setelah halaman berubah
        });
    });
</script>
<?= $this->endSection(); ?>