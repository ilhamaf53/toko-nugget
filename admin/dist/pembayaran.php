<h2>Data Pembayaran</h2>

<?php
// Mendapatkan id_pembelian dari url
$id_pembelian = $_GET['id'];

// Mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
// print_r($detail);

?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $detail['nama']; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?= $detail['bank']; ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td><?= number_format($detail['jumlah']); ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= $detail['tanggal']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../../bukti_pembayaran/<?= $detail['bukti']; ?>" class="img-responsive" width="220">
    </div>
</div>

<form method="post">
    <div class="form-group">
        <label>No. Resi Pengiriman</label>
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">Pilih Status</option>
            <option value="lunas">Lunas</option>
            <option value="barang dikirim">Barang Dikirim</option>
            <option value="batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST['resi'])) {
    $resi = $_POST['resi'];
    $status = $_POST['status'];
    $koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' 
    WHERE id_pembelian='$id_pembelian'");

    echo "<script>alert('Data pembelian terupdate')</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>