<h2>Data Pelanggan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $pecah['nama_pelanggan']; ?></td>
                <td><?= $pecah['email_pelanggan']; ?></td>
                <td><?= $pecah['telepon_pelanggan']; ?></td>
                <!-- <td>
                    <a href="" class="btn btn-danger">Hapus</a>
                </td> -->
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>