<?php
// Mendapatkan id_produk pada url
$id_produk = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
WHERE id_produk='$id_produk'");
$detailproduk = $ambil->fetch_assoc();

$fotoproduk = array();
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while ($tiap = $ambilfoto->fetch_assoc()) {
    $fotoproduk[] = $tiap;
}


// echo "<pre>";
// print_r($detailproduk);
// print_r($fotoproduk);
// echo "</pre>";
?>

<table class="table">
    <tr>
        <th>Nama</th>
        <td><?= $detailproduk['nama_produk']; ?></td>
    </tr>
    <tr>
        <th>Kategori Produk</th>
        <td><?= $detailproduk['nama_kategori']; ?></td>
    </tr>
    <tr>
        <th>Harga (Rp.)</th>
        <td>Rp. <?= number_format($detailproduk['harga_produk']); ?></td>
    </tr>
    <tr>
        <th>Berat (Gr)</th>
        <td><?= $detailproduk['berat_produk']; ?> gr</td>
    </tr>
    <tr>
        <th>Stok</th>
        <td><?= $detailproduk['stok_produk']; ?></td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td><?= $detailproduk['deskripsi_produk']; ?></td>
    </tr>
</table>

<div class="row">

    <?php foreach ($fotoproduk as $key => $value) : ?>
        <div class="col-md-3">
            <img src="../../foto_produk/<?= $value['nama_produk_foto'] ?>" class="img-responsive" width="200"><br>
            <a href="index.php?halaman=hapusfotoproduk&idfoto=<?= $value['id_produk_foto'] ?>&idproduk=<?= $id_produk ?>" class="btn btn-danger btn-sm">Hapus</a>
        </div>
    <?php endforeach ?>

</div>
<hr>

<form enctype="multipart/form-data" method="post">
    <div class="form-group">
        <label>File Foto</label>
        <input type="file" name="fotomu">
    </div>
    <button class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $lokasifoto = $_FILES['fotomu']['tmp_name'];
    $namafoto = $_FILES['fotomu']['name'];

    $namafoto = date('YmdHis') . $namafoto;

    // upload
    move_uploaded_file($lokasifoto, '../foto_produk/' . $namafoto);

    $koneksi->query("INSERT INTO produk_foto(id_produk,nama_produk_foto) 
    VALUES ('$id_produk','$namafoto')");

    echo "<script>alert('Foto berhasil di simpan')</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
}
?>