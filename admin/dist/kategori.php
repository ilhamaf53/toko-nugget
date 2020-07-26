<?php
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $semuadata[] = $tiap;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>
<h2>Data Kategori Produk</h2>
<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($semuadata as $key => $value) : ?>
            <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $value['nama_kategori']; ?></td>
                <td>
                    <a href="index.php?halaman=ubahkategori&id=<?= $value['id_kategori']; ?>" class="btn btn-secondary btn-sm">Ubah</a>
                    <a href="index.php?halaman=hapuskategori&id=<?= $value['id_kategori']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahkategori&id=<?= $value['id_kategori']; ?>" class="btn btn-primary">Tambah</a>