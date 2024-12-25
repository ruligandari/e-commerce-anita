<?= $this->extend('layouts/admin_layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Riwayat Pesanan</h5>
                        </div>
                    </div>
                    <a href="<?= base_url('dashboard/pesanan') ?>">
                        <div id="chart"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    var datas = <?= json_encode($data) ?>;
    //    masukan ke data ini var dataPenjualan; var tanggalPenjualan;
    var dataPenjualan = [];
    var tanggalPenjualan = [];
    // mencari maksimal dari dataPenjualan

    datas.forEach(function(data) {
        dataPenjualan.push(data.total_penjualan);
        tanggalPenjualan.push(data.tanggal);
    });
    var maxData = Math.max(...dataPenjualan.map(Number));

    // convert tanggalPenjualan ke format yang lebih mudah dibaca, misal 2021-08-01 menjadi 01 Agus 2021
    tanggalPenjualan = tanggalPenjualan.map(function(tanggal) {
        var date = new Date(tanggal);
        var options = {
            year: "numeric",
            month: "short",
            day: "numeric"
        };
        return date.toLocaleDateString("id-ID", options);
    });

    // console.log(dataPenjualan);
    // console.log(tanggalPenjualan);
    var chart = {
        series: [{
            name: "Total Pesanan",
            data: dataPenjualan
        }, ],

        chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: {
                show: false
            },
            foreColor: "#adb0bb",
            fontFamily: 'inherit',
            sparkline: {
                enabled: false
            },
        },


        colors: ["#5D87FF", "#49BEFF"],


        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "35%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            },
        },
        markers: {
            size: 0
        },

        dataLabels: {
            enabled: false,
        },


        legend: {
            show: false,
        },


        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: false,
                },
            },
        },

        xaxis: {
            type: "category",
            categories: tanggalPenjualan,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color"
                },
            },
        },


        yaxis: {
            show: true,
            min: 0,
            max: maxData + 10,
            tickAmount: 4,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },
        stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
        },


        tooltip: {
            theme: "light"
        },

        responsive: [{
            breakpoint: 600,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 3,
                    }
                },
            }
        }]


    };

    var chart = new ApexCharts(document.querySelector("#chart"), chart);
    chart.render();
</script>
<?= $this->endSection(); ?>