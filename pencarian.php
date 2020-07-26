<?php
session_start();

// koneksi
include 'koneksi.php';

$keyword = $_GET['keyword'];
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' 
        OR deskripsi_produk LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuadata[] = $pecah;
}

// echo '<pre>';
// print_r($semuadata);
// echo '</pre>';

?>
<?php include 'header.php' ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Toko Nugget</h2>
                    <div class="breadcrumb__option">
                        <span>Form New User</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product">
    <div class="container">
        <h3>Search Result : <?= $keyword; ?></h3><br>
        <div class="row">
            <div class="col">
                <div class="row">
                    <?php foreach ($semuadata as $key => $value) : ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="foto_produk/<?= $value['foto_produk'] ?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="detail.php?id=<?= $value['id_produk']; ?>"><i class="fa fa-info-circle"></i></a></li>
                                        <li><a href="beli.php?id=<?= $value['id_produk']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $value['nama_produk']; ?></a></h6>
                                    <h5>Rp. <?= number_format($value['harga_produk']); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php include 'footer.php' ?>