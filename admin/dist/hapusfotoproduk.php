<?php
// Mendapatkan id dari url
$id_foto = $_GET['idfoto'];
$id_produk = $_GET['idproduk'];

// ambil dulu datanya
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_produk'");
$detailfoto = $ambilfoto->fetch_assoc();

$namafilefoto = $detailfoto['nama_produk_foto'];
// Menghapus file foto dari folder
unlink('../foto_produk/' . $namafilefoto);

// Mengahapus data di mysql
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto'");

echo "<script>alert('Foto berhasil di hapus')</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
