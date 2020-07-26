<?php
include 'koneksi.php';
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

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><br></h3>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name*</label>
                            <div class="col-md-7">
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email*</label>
                            <div class="col-md-7">
                                <input type="text" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password*</label>
                            <div class="col-md-7">
                                <input type="text" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address*</label>
                            <div class="col-md-7">
                                <textarea name="alamat" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Handphone*</label>
                            <div class="col-md-7">
                                <input type="text" name="telepon" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button class="btn btn-primary" name="daftar" class="form-control">Sign Up</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    // jika ada tombol daftar ditekan
                    if (isset($_POST['daftar'])) {
                        // Mengambil isian nama,email,password,alamat,telepon
                        $nama = $_POST['nama'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $alamat = $_POST['alamat'];
                        $telepon = $_POST['telepon'];

                        // cek email apakah sudah digunakan atau belum
                        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                        $yangcocok = $ambil->num_rows;

                        if ($yangcocok == 1) {
                            echo "<script>alert('Pendaftaran gagal, email sudah di gunakan');</script>";
                            echo "<script>location='daftar.php';</script>";
                        } else {
                            // Query insert ke tabel pelanggan
                            $koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,
                                nama_pelanggan,telepon_pelanggan,alamat_pelanggan) 
                                VALUES('$email','$password','$nama','$telepon','$alamat')");

                            echo "<script>alert('Pendaftaran sukses, Silahkan login');</script>";
                            echo "<script>location='login.php';</script>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>