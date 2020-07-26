<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>
<h2>Ubah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?= $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Kategori Produk</label>
        <select class="form-control" name="id_kategori">

            <?php foreach ($datakategori as $key => $value) : ?>
                <option value="<?= $value['id_kategori']; ?>" <?php if ($pecah['id_kategori'] == $value['id_kategori']) {
                                                                    echo 'selected';
                                                                } ?>>
                    <?= $value['nama_kategori']; ?>
                </option>
            <?php endforeach ?>

        </select>
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="<?= $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label>
        <input type="number" name="berat" class="form-control" value="<?= $pecah['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="<?= $pecah['stok_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Foto</label><br>
        <img src="../../foto_produk/<?= $pecah['foto_produk']; ?>" width="100">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="10" class="form-control"><?= $pecah['deskripsi_produk']; ?></textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    // jika foto dirubah
    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', 
        harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',
        foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]',
        id_kategori='$_POST[id_kategori]',stok_produk='$_POST[stok]'
        WHERE id_produk='$_GET[id]'");
    } else {
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', 
        harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',
        deskripsi_produk='$_POST[deskripsi]',id_kategori='$_POST[id_kategori]',
        stok_produk='$_POST[stok]' WHERE id_produk='$_GET[id]'");
    }

    echo "<script>alert('Data produk telah di ubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>