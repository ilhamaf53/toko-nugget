<?php
session_start();
// koneksi
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User's Login</title>
    <link href="admin/dist/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">User's Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" role="form">
                                        <div class="form-group">
                                            <label class="small mb-1" for="username">Email</label>
                                            <input class="form-control py-4" id="username" type="email" placeholder="Masukkan email or username" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Password</label>
                                            <input class="form-control py-4" id="password" type="password" placeholder="Masukkan password" name="password" />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['login'])) {
                                        $email = $_POST['email'];
                                        $password = $_POST['password'];
                                        $ambil = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE 
                                        email_pelanggan='$email' AND password_pelanggan='$password'");
                                        $yangcocok = mysqli_num_rows($ambil);

                                        if ($yangcocok == 1) {
                                            $_SESSION['pelanggan'] = mysqli_fetch_assoc($ambil);

                                            // jika sudah belanja
                                            if (isset($_SESSION['keranjang']) or !empty($_SESSION['keranjang'])) {
                                                echo "<script>location='checkout.php';</script>";
                                            } else {
                                                echo "<script>location='riwayat.php';</script>";
                                            }
                                        } else {
                                            echo "<script>alert('username/password salah')</script>";
                                            echo "<script>location='login.php';</script>";
                                            die();
                                        }
                                    }
                                    ?>

                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="daftar.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Toko Nugget Inc. All rights reserved.</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="admin/dist/js/scripts.js"></script>
</body>

</html>