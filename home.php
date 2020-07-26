<!-- Product Section Begin -->
<section class="product">
    <div class="container">
        <div class="row">
            <div class="col">
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
                                    <h6><?= $perproduk['nama_produk']; ?></a></h6>
                                    <h5>Rp. <?= number_format($perproduk['harga_produk']); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- <div class="product__pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->