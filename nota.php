<?php
session_start();

// koneksi
include 'koneksi.php';
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
                        <span>Payment Note</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<br>

<!-- Purchase Orders Section Begin -->

<body>
    <section class="content">
        <div class="container">

            <!-- nota -->

            <?php
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON 
                pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE
                pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            ?>
            <!-- <h1>data orang yang beli $detail</h1>
            <pre><?php print_r($detail) ?></pre>

            <h1>data orang yang login di session</h1>
            <pre><?php print_r($_SESSION) ?></pre> -->

            <!-- Jika pelanggan yang beli tidak sama dengan pelanggan yang login -->
            <!-- maka di larikan ke riwayat.php , karena tidak berhak melihat nota orang lain -->
            <!-- pelanggan yang beli harus pelanggan yang login -->
            <?php
            // mendapatkan id_pelanggan yang beli
            $idpelangganyangbeli = $detail['id_pelanggan'];

            // mendapatkan id_pelanggan yang login
            $idpelangganyanglogin = $_SESSION['pelanggan']['id_pelanggan'];

            if ($idpelangganyangbeli !== $idpelangganyanglogin) {
                echo "<script>alert('Error')</script>";
                echo "<script>location='riwayat.php';</script>";
                exit();
            }
            ?>

            <div class="row">
                <div class="col-md-4">
                    <h3>Purchase</h3>
                    <p>
                        <strong>No. Purchase: <?= $detail['id_pembelian'] ?></strong><br>
                        Date : <?= $detail['tanggal_pembelian'] ?><br>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Costumer</h3>
                    <strong><?= $detail['nama_pelanggan'] ?></strong><br>
                    <p>
                        Email : <?= $detail['email_pelanggan'] ?><br>
                        Phone : <?= $detail['telepon_pelanggan'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Shipping</h3>
                    <p>
                        <strong><?= $detail['nama_kota'] ?></strong><br>
                        Delivery Services : <?= $detail['nama_ekspedisi']; ?><br>
                        Address : <?= $detail['alamat_pengiriman'] ?>
                    </p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Weight</th>
                        <th>Quantity</th>
                        <th>Sub Weight</th>
                        <th>Sub Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                    <?php $nomor = 1; ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $nomor; ?></td>
                            <td><?= $pecah['nama']; ?></td>
                            <td>Rp. <?= number_format($pecah['harga']); ?></td>
                            <td><?= $pecah['berat']; ?> gr</td>
                            <td><?= $pecah['jumlah']; ?></td>
                            <td><?= $pecah['subberat']; ?> gr</td>
                            <td>Rp. <?= number_format($pecah['subharga']); ?></td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">Total Shipping Cost</th>
                        <th>Rp. <?= number_format($detail['tarif']); ?></th>
                    </tr>
                    <tr>
                        <th colspan="6">Total Prices</th>
                        <th>Rp. <?= number_format($detail['total_pembelian']) ?></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p style="text-align: center;">
                            Please make payment Rp. <?= number_format($detail['total_pembelian']); ?> to <br>
                            <strong>BANK MANDIRI 1770001170644 AN. ILHAM AHMAD FAHRIZAL</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align: center;">
                        Berikut ini adalah langkah-langkah pembayaran melalui Bank menggunakan ATM: <br>
                        <img src="foto_produk/bca.png" style="margin-right: 10px;">
                        <img src="foto_produk/mandiri.png" style="margin-right: 10px;">
                        <img src="foto_produk/bri.png" style="margin-right: 10px;">
                        <img src="foto_produk/bni.png"><br><br>
                    </h3><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Langkah-langkah pembayaran melalui ATM : </strong><br>
                    1. Masukkan Kartu ATM ke Slot Kartu di Mesin ATM <br>
                    2. Pilih Bahasa <br>
                    3. Masukkan Nomor PIN ATM Anda <br>
                    4. Pilih Jenis Transaksi: Pilih “Transfer” <br>
                    5. Pilih Bank Tujuan Transfer dan Masukkan Nomor Rekening Tujuan<br>
                    6. Masukkan Nominal Uang <br>
                    7. Masukkan Nomor Referensi (opsional) <br>
                    8. Konfirmasi Ulang <br>
                    9. Transfer Berhasil <br>
                    10. Transaksi Selesai <br>
                </div>
                <div class="col-md-6">
                    <strong>Langkah-langkah pembayaran melalui M-Banking : </strong><br>
                    1. Masukkan username dan password <br>
                    2. Pilih Menu Transfer <br>
                    5. Pilih Bank Tujuan Transfer dan Masukkan Nomor Rekening Tujuan<br>
                    6. Masukkan Nominal Uang <br>
                    7. Masukkan Nomor Referensi (opsional) <br>
                    8. Konfirmasi Ulang <br>
                    9. Transfer Berhasil <br>
                    10. Transaksi Selesai <br>
                </div>
            </div>
            <br>
        </div>
    </section>

</body>
<!-- Purchase Orders Section Begin -->

<?php include 'footer.php'; ?>