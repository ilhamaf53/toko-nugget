<?php
session_start();

// Koneksi
include 'koneksi.php';

if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silahkan login terlebih dahulu')</script>";
    echo "<script>location='login.php';</script>";
}

// Menonaktifkan pesan error di php
error_reporting(0);
$error = $koneksi;

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
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form method="POST">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Name<span>*</span></p>
                                    <input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Phone<span>*</span></p>
                            <input type="text" readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan'] ?>">
                        </div>
                        <div class="checkout__input form-group">
                            <p>Address<span>*</span></p>
                            <input type="text" name="alamat_pengiriman" class="form-control" placeholder="Input your address">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>

                            <?php $totalbelanja = 0; ?>
                            <?php $totalberat = 0; ?>
                            <?php $ongkir = 0; ?>
                            <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                                <!-- Menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
                                <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
                                <?php $pecah = $ambil->fetch_assoc(); ?>
                                <?php $subharga = $pecah['harga_produk'] * $jumlah; ?>
                                <?php $beratbarang = $pecah["berat_produk"] * $jumlah; ?>
                                <!-- <pre>
                                    <?php print_r($pecah) ?>
                                </pre> -->

                                <ul>
                                    <li><?= $pecah['nama_produk']; ?> x <?= $jumlah; ?> <span>Rp. <?= number_format($pecah['harga_produk']); ?></span></li>
                                </ul>
                                <ul>
                                    <?php $totalberat += $beratbarang; ?>
                                    <li>Weight<span><?= $pecah['berat_produk'] . " gr"; ?></span></li>
                                </ul>
                                <div class="checkout__order__subtotal">
                                    Subtotal Weight <span><?= $beratbarang . " gr"; ?></span><br>
                                    Subtotal Price<span>Rp. <?= number_format($subharga); ?></span>
                                </div>

                                <?php $totalbelanja += $subharga; ?>
                            <?php endforeach; ?>

                            <div class="checkout__order__total">
                                Delivery Services
                                <span>
                                    <select name="id_ekspedisi">
                                        <option>--Choose Delivery Services--</option>
                                        <?php $ambil_ekspedisi = $koneksi->query("SELECT * FROM ekspedisi") ?>
                                        <?php while ($perekspedisi = $ambil_ekspedisi->fetch_assoc()) { ?>
                                            <option value="<?= $perekspedisi['id_ekspedisi'] ?>">
                                                <?= $perekspedisi['nama_ekspedisi']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </span><br><br>

                                Total Shipping Cost
                                <span>
                                    <select name="id_ongkir">
                                        <option>--Choose Shipping City</option>
                                        <?php $ambil_ongkir = $koneksi->query("SELECT * FROM ongkir") ?>
                                        <?php while ($perongkir = $ambil_ongkir->fetch_assoc()) { ?>
                                            <?php $bagi_ongkir = ceil($totalberat / 1000) ?>
                                            <?php $ongkir_wilayah = $perongkir['tarif'] * $bagi_ongkir ?>
                                            <option value="<?= $perongkir['id_ongkir'] ?>">
                                                <?= $perongkir['nama_kota'] ?> - Rp. <?= number_format($ongkir_wilayah) ?>
                                            </option>
                                        <?php } ?>


                                    </select>
                                </span><br><br>

                                Total Weight <span><?= $totalberat . " gr"; ?></span><br>
                                Total Price <span>Rp. <?= number_format($totalbelanja) ?></span>
                            </div>
                            <button type="submit" class="site-btn" name="checkout" id="checkout">CHECK OUT</button>

                        </div>
                    </div>
                </div>
            </form>

            <?php
            if (isset($_POST['checkout'])) {
                $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                $tanggal_pembelian = date("Y-m-d");
                $alamat_pengiriman = $_POST['alamat_pengiriman'];

                $id_ongkir = $_POST['id_ongkir'];

                $ambil_id_ongkir = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arrayongkir = $ambil_id_ongkir->fetch_assoc();
                $nama_kota = $arrayongkir['nama_kota'];
                $tarif = $arrayongkir['tarif'];
                $bagi_ongkir = ceil($totalberat / 1000);
                $totalongkir = $tarif * $bagi_ongkir;

                $total_pembelian = $totalbelanja + $totalongkir;

                // 1. Menyimpan data ke tabel pembelian
                $koneksi->query("INSERT INTO pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman)
                    VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$totalongkir','$alamat_pengiriman')");

                // mendapatkan id_pembelian barusan terjadi
                $id_pembelian_barusan = $koneksi->insert_id;

                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                    // mendapatkan data produk berdasarkan id_produk
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $perproduk = $ambil->fetch_assoc();

                    $nama = $perproduk['nama_produk'];
                    $harga = $perproduk['harga_produk'];
                    $berat = $perproduk['berat_produk'];

                    $subberat = $perproduk['berat_produk'] * $jumlah;
                    $subharga = $perproduk['harga_produk'] * $jumlah;

                    $koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
                    VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                    // skrip update stok
                    $koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");
                }

                // mengkosongkan keranjang belanja
                unset($_SESSION['keranjang']);


                // tampilan di alihkan ke halaman nota, nota dari pembelian yang barusan
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }
            ?>

        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>

<script>

</script>