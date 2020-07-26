<h2>Detail Pembelian</h2>

<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON 
pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE
pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- <pre>
    <?php print_r($detail); ?>
</pre> -->

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <p>
            <strong>No. Purchase: <?= $detail['id_pembelian'] ?></strong><br>
            Tanggal: <?= $detail['tanggal_pembelian']; ?><br>
            Status: <?= $detail['status_pembelian']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong>Nama Pelanggan: <?= $detail['nama_pelanggan']; ?></strong><br>
        <p>
            Email: <?= $detail['email_pelanggan']; ?><br>
            Nomor Telepon: <?= $detail['telepon_pelanggan']; ?><br>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?= $detail['nama_kota']; ?></strong>
        <p>
            Jasa Ekspedisi : <?= $detail['nama_ekspedisi']; ?><br>
            Alamat: <?= $detail['alamat_pengiriman']; ?>
        </p>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
        pembelian_produk.id_produk=produk.id_produk WHERE
        pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php $nomor = 1; ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama_produk']; ?></td>
                <td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
                <td><?= $pecah['jumlah']; ?></td>
                <td>Rp. <?= number_format($pecah['harga_produk'] * $pecah['jumlah']); ?></td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total Shipping Cost</th>
            <th>Rp. <?= number_format($detail['tarif']); ?></th>
        </tr>
        <tr>
            <th colspan="4">Total Prices</th>
            <th>Rp. <?= number_format($detail['total_pembelian']) ?></th>
        </tr>
    </tfoot>
</table>