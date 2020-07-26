<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost", "root", "", "toko_nugget");

if (!isset($_SESSION["admin"])) {
    // ubah link disini
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Toko Nugget Admin Page</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/costum.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Toko Nugget</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="logout.php" role="button">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                        <a href="index.php" style="display: block; margin: auto;">
                            <div class="logo">
                                <img src="../../foto_produk/logo_toko_nugget.png">
                            </div>
                        </a>
                        <br>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="index.php?halaman=kategori">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kategori Produk
                        </a>
                        <a class="nav-link" href="index.php?halaman=produk">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href="index.php?halaman=pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Pembelian
                        </a>
                        <a class="nav-link" href="index.php?halaman=laporan_pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Laporan
                        </a>
                        <a class="nav-link" href="index.php?halaman=pelanggan">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Pelanggan
                        </a>

                    </div>

                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <br>
                    <?php
                    if (isset($_GET['halaman'])) {
                        if ($_GET['halaman'] == "produk") {
                            include 'produk.php';
                        } elseif ($_GET['halaman'] == "pembelian") {
                            include 'pembelian.php';
                        } elseif ($_GET['halaman'] == "pelanggan") {
                            include 'pelanggan.php';
                        } elseif ($_GET['halaman'] == "detail") {
                            include 'detail.php';
                        } elseif ($_GET['halaman'] == "tambahproduk") {
                            include 'tambahproduk.php';
                        } elseif ($_GET['halaman'] == "hapusproduk") {
                            include 'hapusproduk.php';
                        } elseif ($_GET['halaman'] == "ubahproduk") {
                            include 'ubahproduk.php';
                        } elseif ($_GET['halaman'] == "logout") {
                            include 'logout.php';
                        } elseif ($_GET['halaman'] == "pembayaran") {
                            include 'pembayaran.php';
                        } elseif ($_GET['halaman'] == "laporan_pembelian") {
                            include 'laporan_pembelian.php';
                        } elseif ($_GET['halaman'] == "kategori") {
                            include 'kategori.php';
                        } elseif ($_GET['halaman'] == "detailproduk") {
                            include 'detailproduk.php';
                        } elseif ($_GET['halaman'] == "hapusfotoproduk") {
                            include 'hapusfotoproduk.php';
                        } elseif ($_GET['halaman'] == "ubahkategori") {
                            include 'ubahkategori.php';
                        } elseif ($_GET['halaman'] == "hapuskategori") {
                            include 'hapuskategori.php';
                        } elseif ($_GET['halaman'] == "tambahkategori") {
                            include 'tambahkategori.php';
                        }
                    } else {
                        include 'home.php';
                    }
                    ?>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; 2020 Toko Nugget Inc. All rights reserved.</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>