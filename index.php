<?php
session_start();

// Koneksi
include 'koneksi.php';

?>
<!DOCTYPE html>
    <?php include 'header.php' ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Toko Nugget</h2>
                        <div class="breadcrumb__option">
                            <span>Home</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">

                <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
                <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="foto_produk/<?= $perproduk['foto_produk']; ?>">
                                <ul class="product__item__pic__hover">
                                    <li><a href="detail.php?id=<?= $perproduk['id_produk'] ?>"><i class="fa fa-info-circle"></i></a></li>
                                    <li><a href="beli.php?id=<?= $perproduk['id_produk'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><?= $perproduk['nama_produk']; ?> (<?= $perproduk['berat_produk']; ?>gr)</a></h6>
                                <h5>Rp. <?= number_format($perproduk['harga_produk']); ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php include 'footer.php' ?>