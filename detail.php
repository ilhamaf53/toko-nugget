<?php
session_start();

// Koneksi
include 'koneksi.php';

// Mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// Query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
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
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
`
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="foto_produk/<?= $detail['foto_produk'] ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?= $detail['nama_produk'] ?></h3>
                    <div class="product__details__price">Rp. <?= number_format($detail['harga_produk']) ?></div>
                    <p><?= $detail['deskripsi_produk']; ?></p>

                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" name="jumlah" min="1" max="<?= $detail['stok_produk'] ?>" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" name="beli">Buy</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['beli'])) {
                        // Mendapatkan jumlah yang di inputkan, gunakan $_POST jika mengambil data dari formulir
                        $jumlah = $_POST['jumlah'];

                        // Masukkan di keranjang belanja
                        $_SESSION['keranjang'][$id_produk] = $jumlah;

                        echo "<script>location='keranjang.php';</script>";
                    }
                    ?>

                    <ul>
                        <li><b>Availability</b> <span><?= $detail['stok_produk'] ?></span></li>
                        <li><b>Weight</b> <span><?= $detail['berat_produk']; ?> gr</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>



        </div>
    </div>
</section>
<!-- Product Details Section End -->



<?php include 'footer.php'; ?>