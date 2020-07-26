<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="toko_nugget, Ogani, unica, creative, html">
    
    <title>Toko Nugget</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/costum.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="index.php"><img src="foto_produk/logo_toko_nugget.png" width="120" height="75"></a>
        </div>

        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <!-- Jika sudah ada session pelanggan maka munculkan ini -->
                <?php if (isset($_SESSION['pelanggan'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                <?php else : ?>
                    <a href="daftar.php"><i class="fa fa-plus"></i> Sign-up</a>
                    <a href="login.php"><i class="fa fa-user"></i> Login</a>
                <?php endif ?>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Shopping Pages</a>
                    <ul class="header__menu__dropdown">
                        <?php if (isset($_SESSION['pelanggan'])) : ?>
                            <li><a href="keranjang.php">Shopping Cart</a></li>
                            <li><a href="checkout.php">Check Out</a></li>
                            <li><a href="riwayat.php">Shopping History</a></li>
                        <?php else : ?>
                            <li><a href="keranjang.php">Shopping Cart</a></li>
                        <?php endif ?>
                    </ul>
                </li>
                <li><a href="kontak.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> toko_nugget@gmail.com</li>
                <li>Jabodetabek Shipping</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> toko_nugget@gmail.com</li>
                                <li>Jabodetabek Shipping</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__auth" style="display: inline;">
                                <!-- Jika sudah ada session pelanggan maka munculkan ini -->
                                <?php if (isset($_SESSION['pelanggan'])) : ?>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                <?php else : ?>
                                    <a href="daftar.php"><i class="fa fa-plus"></i> Sign-up</a>
                                    <a href="login.php"><i class="fa fa-user"></i> Login</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="index.php"><img src="foto_produk/logo_toko_nugget.png" width="120" height="75"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#">Shopping Pages</a>
                                <ul class="header__menu__dropdown">
                                    <?php if (isset($_SESSION['pelanggan'])) : ?>
                                        <li><a href="keranjang.php">Shopping Cart</a></li>
                                        <li><a href="checkout.php">Check Out</a></li>
                                        <li><a href="riwayat.php">Shopping History</a></li>
                                    <?php else : ?>
                                        <li><a href="keranjang.php">Shopping Cart</a></li>
                                    <?php endif ?>
                                </ul>
                            </li>
                            <li><a href="kontak.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Product Categories</span>
                        </div>
                        <ul>
                            <li><a href="kategori.php?id=1">Nugget Champ</a></li>
                            <li><a href="kategori.php?id=2">Nugget Fiesta</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="pencarian.php" method="GET">
                                <input type="text" placeholder="What do yo u need?" name="keyword">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+6285280120079</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->