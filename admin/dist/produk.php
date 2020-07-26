<h2>Menu Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <thead>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama_produk']; ?></td>
                <td><?= $pecah['nama_kategori']; ?></td>
                <td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
                <td><?= $pecah['berat_produk']; ?> gr</td>
                <td><?= $pecah['stok_produk']; ?></td>
                <td>
                    <img src="../../foto_produk/<?= $pecah['foto_produk']; ?>" width="100">
                </td>
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-danger">Hapus</a>
                    <a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-warning">Ubah</a>
                    <a href="index.php?halaman=detailproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-info">Detail</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </thead>
</table>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>