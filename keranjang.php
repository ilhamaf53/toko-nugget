<?php
session_start();

// Koneksi
include 'koneksi.php';

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('keranjang kosong');</script>";
    echo "<script>location='index.php';</script>";
}
?>
<?php include 'header.php'; ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Toko Nugget</h2>
                    <div class="breadcrumb__option">
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Weight</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalberat = 0; ?>
                            <?php $totalbelanja = 0; ?>
                            <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                                <!-- Menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
                                <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
                                <?php $pecah = $ambil->fetch_assoc(); ?>
                                <?php $subharga = $pecah['harga_produk'] * $jumlah; ?>
                                <?php $beratbarang = $pecah["berat_produk"] * $jumlah; ?>
                                <!-- <pre>
                                <?php print_r($pecah); ?>
                                </pre> -->
                                <tr>
                                    <td class="shoping__cart__item">
                                        <h5><?= $pecah['nama_produk']; ?></h5>
                                    </td>

                                    <td class="shoping__cart__price">
                                        Rp. <?= number_format($pecah['harga_produk']); ?>
                                    </td>

                                    <td class="shoping__cart__quantity">
                                        <?= $jumlah; ?>
                                    </td>

                                    <td class="shoping__cart__quantity">
                                        <?= number_format($beratbarang) . " gr"; ?>
                                    </td>

                                    <td class="shoping__cart__total">
                                        Rp. <?= number_format($subharga); ?>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <a href="hapuskeranjang.php?id=<?= $id_produk; ?>" class="btn btn-danger btn-ss">Delete</a>
                                    </td>
                                </tr>
                                <?php $totalberat += $beratbarang; ?>
                                <?php $totalbelanja += $subharga; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                </div>
            </div>

            <div class="col-md-4 ml-auto">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Total Weight <span><?= $totalberat . " gr"; ?></span></li>
                        <li>Total Price <span>Rp. <?= number_format($totalbelanja); ?></span></li>

                    </ul>
                    <a href="checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->


<?php include 'footer.php'; ?>