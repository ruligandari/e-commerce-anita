<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url('user') ?>/images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/vendor1/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('user') ?>/css/style.css">
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('header'); ?>
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <img src="<?= base_url('user') ?>/images/icons/beniing.png" alt="IMG-LOGO" width="150">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="<?= $title == 'Home' ? 'active-menu' : '' ?>">
                                <a href="<?= base_url('/') ?>">Home</a>
                            </li>

                            <li class="<?= $title == 'Shop' ? 'active-menu' : '' ?>">
                                <a href="<?= base_url('shop') ?>">Shop</a>
                            </li>

                            <!-- <li>
                                <a href="about.html">About</a>
                            </li>

                            <li>
                                <a href="contact.html">Contact</a>
                            </li> -->
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <?php if (session()->get('isloginCustomer')) : ?>
                            <!-- <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                                <i class="zmdi zmdi-search"></i>
                            </div> -->

                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart icon-header-noti" data-notify="2">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>

                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11  d-flex item-center">
                                <i class="zmdi zmdi-account"></i><span class="stext-102 px-2"><?= session()->get('name') ?></span>
                            </div>
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11  d-flex item-center">
                                <button onclick="logout()">
                                    <span class="stext-102 px-2">Logout</span>
                                </button>
                            </div>
                        <?php else : ?>
                            <a href="<?= base_url('customer/login') ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ml-2" tabindex="-1">
                                Login
                            </a>
                        <?php endif ?>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="<?= base_url('user') ?>/images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                </li>

                <li>
                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            Help & FAQs
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            My Account
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            EN
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            USD
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="index.html">Home</a>
                    <ul class="sub-menu-m">
                        <li><a href="index.html">Homepage 1</a></li>
                        <li><a href="home-02.html">Homepage 2</a></li>
                        <li><a href="home-03.html">Homepage 3</a></li>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>

                <li>
                    <a href="product.html">Shop</a>
                </li>

                <li>
                    <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
                </li>

                <li>
                    <a href="blog.html">Blog</a>
                </li>

                <li>
                    <a href="about.html">About</a>
                </li>

                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="<?= base_url('user') ?>/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Pesanan
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    <div id="pesanan">

                    </div>
                </ul>
            </div>
        </div>
    </div>

    <?= $this->renderSection('content'); ?>


    <!-- Footer -->
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <!-- <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Categories
                    </h4>

                    <ul>
                        <?php foreach ($kategori as $key) : ?>
                            <li class="p-b-10">
                                <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                    <?= $key['nama_kategori'] ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div> -->



                <!-- <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        GET IN TOUCH
                    </h4>

                    <p class="stext-107 cl7 size-201">
                        Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                    </p>

                    <div class="p-t-27">
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </div>
                </div> -->
            </div>

            <div class="p-t-40">

                <p class="stext-107 cl6 txt-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by beniing.co
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </p>
            </div>
        </div>
    </footer>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>


    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/jquery/jquery-3.2.1.min.js"></script>

    <!--===============================================================================================-->

    <!-- script get pesanan dengan id customer -->
    <script>
        function get_pesanan(id) {
            $.ajax({
                url: "<?= base_url('shop/get_pesanan') ?>",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    // count pesanan
                    var count = response.total;
                    $('.js-show-cart').attr('data-notify', count);

                    // tampilkan pesanan di modal cart
                    var pesanan = response.transaksi;
                    // cari dalam pesanan no_transaksi yang sama

                    var html = '';
                    pesanan.forEach(item => {
                        html += `
                        <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="<?= base_url('uploads/produk') ?>/${item.gambar}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt">
                            <a href="<?= base_url('shop/detail/') ?>${item.no_transaksi}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            ${item.name}
                            </a>

                            <span class="header-cart-item-info badge bg-success text-white">
                    ${item.status}
                            </span>
                            <span class="header-cart-item-info">
                             ${item.qty} x Rp. ${item.harga}
                            </span>
                        </div>
                    </li>`;
                    });
                    $('#pesanan').html(html);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        // jalankan function get_pesanan
        get_pesanan(<?= session()->get('id') ?>);
    </script>

    <script>
        $('input[type="file"]').change(function(e) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        });
    </script>
    <!-- script logout popup sweet alert -->
    <script>
        function logout() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan keluar dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('customer/logout') ?>";
                }
            })
        }
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('user') ?>/vendor1/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url('user') ?>/vendor1/daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url('user') ?>/js/jquery.countdown.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/slick/slick.min.js"></script>
    <script src="<?= base_url('user') ?>/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/sweetalert/sweetalert.min.js"></script>
    <?= $this->renderSection('script'); ?>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.js-addcart-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to cart !", "success");
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/vendor1/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('user') ?>/js/main.js"></script>

    <!-- render script -->
    <?= $this->renderSection('script'); ?>

</body>

</html>