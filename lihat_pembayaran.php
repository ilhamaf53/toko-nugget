<?php
session_start();

// koneksi
include 'koneksi.php';

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
    LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
    WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detbay);
// echo "</pre>";

// jika belum ada data pembayaran
if (empty($detbay)) {
    echo "<script>alert('Belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// jika data pelanggan yang bayar tidak sesuai dengan yang login
if ($_SESSION['pelanggan']['id_pelanggan'] !== $detbay['id_pelanggan']) {
    echo "<script>alert('Anda tidak berhak melihat pembayaran orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
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
                        <span>View Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<br>

<div class="container">
    <h3>View Payment</h3>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><?= $detbay['nama']; ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?= $detbay['bank']; ?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><?= $detbay['tanggal']; ?></td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>Rp. <?= number_format($detbay['jumlah']); ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <img src="bukti_pembayaran/<?= $detbay['bukti'] ?>" width="30%" height="90%">
        </div>
    </div>
</div>
</div>

<?php include 'footer.php' ?>;