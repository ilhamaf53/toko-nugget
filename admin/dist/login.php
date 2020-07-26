<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost", "root", "", "toko_nugget");
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
                                    <h3 class="text-center font-weight-light my-4">Toko Nugget Admin</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" role="form">
                                        <div class="form-group">
                                            <label class="small mb-1" for="username">Email</label>
                                            <input class="form-control py-4" id="username" type="text" placeholder="Masukkan email or username" name="username" />
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
                                        $ambil = mysqli_query($koneksi, "SELECT * FROM admin 
                                        WHERE username='$_POST[username]' 
                                        AND password='$_POST[password]'");
                                        $yangcocok = mysqli_num_rows($ambil);

                                        if ($yangcocok == 1) {
                                            $_SESSION['admin'] = mysqli_fetch_assoc($ambil);
                                            header("location:index.php");
                                        } else {
                                            echo "<script>alert('Login Gagal')</script>";
                                            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                            die();
                                        }
                                    }
                                    ?>
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
    <script src="js/scripts.js"></script>
</body>

</html>