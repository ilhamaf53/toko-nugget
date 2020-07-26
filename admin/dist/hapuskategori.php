<?php
$id_kategori = $_GET['id'];

$koneksi->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");

echo "<script>location='index.php?halaman=kategori';</script>";
