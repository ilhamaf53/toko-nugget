<h2>Tambah Kategori Produk</h2>
<br>
<form method="POST">
    <div class="form-group">
        <label>Kategori Produk</label>
        <input type="text" name="nama_kategori" class="form-control" value="">
    </div>
    <button class="btn btn-primary" name="tambah">Tambah</button>
</form>
<?php
if (isset($_POST['tambah'])) {
    $koneksi->query("INSERT INTO kategori(nama_kategori) VALUES ('$_POST[nama_kategori]')");

    echo "<script>location='index.php?halaman=kategori';</script>";
}
?>