<?php

$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$id_kategori = $_GET['id'];

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<h2>Ubah Kategori Produk</h2>
<br>
<form method="POST">
    <div class="form-group">
        <label>Kategori Produk</label>
        <input type="text" name="nama_kategori" class="form-control" value="<?= $pecah['nama_kategori'] ?>">
    </div>
    <button class="btn btn-warning" name="ubah">Ubah</button>
</form>
<?php
if (isset($_POST['ubah'])) {
    $koneksi->query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]'
    WHERE id_kategori='$id_kategori'");

    echo "<script>location='index.php?halaman=kategori';</script>";
}
?>