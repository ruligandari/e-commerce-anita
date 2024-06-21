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
<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" method="POST" action="<?= base_url('shop/checkout') ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Produk</th>
                                <th class="column-2"></th>
                                <th class="column-3">Harga</th>
                                <th class="column-4">Kuantitas</th>
                                <th class="column-5">Subtotal</th>
                                <th class="column-6"></th>
                            </tr>
                            <?php
                            $total = 0;
                            foreach ($cart as $cart) : ?>

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
                                    <td class="column-6">
                                        <a href="<?= base_url('shop/edit/' . $cart['id_produk'] . '/' . $cart['id_cart']) ?>" class="btn btn-text">Edit</a>
                                    </td>
                                </tr>
                                <?php $total += $subtotal ?>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

                        <a href="<?= base_url('shop') ?>" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Pengiriman
                    </h4>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Alamat:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                <?= session()->get('alamat') ?>
                            </p>

                            <!-- <div class="p-t-15">
                                <span class="stext-112 cl8">
                                    Calculate Shipping
                                </span>

                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2" name="time">
                                        <option>Select a country...</option>
                                        <option>USA</option>
                                        <option>UK</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                </div>

                                <div class="flex-w">
                                    <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                        Update Totals
                                    </div>
                                </div>

                            </div> -->
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                Rp. <?= $total ?>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="id_user" value="<?= session()->get('id') ?>">
                    <input type="hidden" name="total" value="<?= $total ?>">

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>