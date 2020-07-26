<?php
session_start();
// koneksi
include 'koneksi.php';

// jika tidak ada session pelanggan (belum login)
if (!isset($_SESSION['pelanggan']) or empty($_SESSION['pelanggan'])) {
    echo "<script>alert('Silahkan login terlebih dahulu!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Mendapatkan id_pembelian dari url
$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// echo "<pre>";

// print_r($detpem);
// print_r($_SESSION);

// echo "</pre>";

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem['id_pelanggan'];

//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

if ($id_pelanggan_login !== $id_pelanggan_beli) {
    echo "<script>alert('Jangan nakal');</script>";
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
                        <span>Input Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<br>

<div class="container">
    <h2>Payment Confirmation</h2>
    <p>Input on here</p>
    <div class="alert alert-info">
        Total your payment <strong>Rp. <?= number_format($detpem['total_pembelian']); ?></strong>
    </div>


    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Depositor's name</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="form-group">
            <label>Bank</label>
            <input type="text" name="bank" class="form-control">
        </div>
        <div class="form-group">
            <label>Total</label>
            <input type="number" name="jumlah" class="form-control" min="1">
        </div>
        <div class="form-group">
            <label>Payment Receipt</label>
            <input type="file" name="bukti" class="form-control">
            <p class="text-danger">Payment receipt must JPG or PNG maximum 2MB</p>
        </div>
        <button class="btn btn-primary" name="kirim">Send</button>
    </form>
</div>

<?php
// jika ada tombol kirim
if (isset($_POST['kirim'])) {
    // upload dulu foto bukti
    $namabukti = $_FILES['bukti']['name'];
    $lokasibukti = $_FILES['bukti']['tmp_name'];
    $namafiks = date("YmdHis") . $namabukti;
    move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date("Y-m-d");


    // simpan pembayaran
    $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) 
        VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

    // update data pembelian dari pending menjadi sudah mengirim pembayaran
    $koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE 
        id_pembelian='$idpem'");

    echo "<script>alert('Terima kasih telah melakukan pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
}
?>

<?php include 'footer.php' ?>