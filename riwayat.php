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
                        <span>Shopping History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<br>

<!-- <pre><?php print_r($_SESSION) ?></pre> -->
<section class="riwayat">
    <div class="container">
        <h3>Shopping History <?= $_SESSION['pelanggan']['nama_pelanggan'] ?></h3><br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $nomor = 1;
                // Mendapatkan id_pelanggan yang login dari session
                $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

                $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                while ($pecah = $ambil->fetch_assoc()) {
                ?>

                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= $pecah['tanggal_pembelian'] ?></td>
                        <td>
                            <?= $pecah['status_pembelian'] ?>
                            <br>
                            <?php if (!empty($pecah['resi_pengiriman'])) : ?>
                                Resi : <?= $pecah['resi_pengiriman']; ?>
                            <?php endif ?>
                        </td>
                        <td>Rp. <?= number_format($pecah['total_pembelian']) ?></td>
                        <td>
                            <a href="nota.php?id=<?= $pecah['id_pembelian'] ?>" class="btn btn-info">Nota</a>

                            <?php if ($pecah['status_pembelian'] == 'pending') : ?>
                                <a href="pembayaran.php?id=<?= $pecah['id_pembelian'] ?>" class="btn btn-success">
                                    Input Payment
                                </a>
                            <?php else : ?>
                                <a href="lihat_pembayaran.php?id=<?= $pecah['id_pembelian'] ?>" class="btn btn-warning">
                                    View Payment
                                </a>
                            <?php endif ?>
                        </td>
                    </tr>

                <?php
                    $nomor++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php' ?>