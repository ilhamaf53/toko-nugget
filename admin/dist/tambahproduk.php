<?php
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>
<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Kategori Produk</label>
        <select class="form-control" name="id_kategori">

            <?php foreach ($datakategori as $key => $value) : ?>
                <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
            <?php endforeach ?>

        </select>
    </div>
    <div class="form-group">
        <label>Harga (Rp.)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label>
        <input type="number" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok">
    </div>
    <div class="form-group">
        <label>Foto</label>
        <div class="letak-input" style="margin-bottom: 10px;">
            <input type="file" name="foto[]" class="form-control">
        </div>
        <span class="btn btn-primary btn-tambah">
            <i class="fa fa-plus"></i>
        </span>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="10" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save'])) {
    $namanamafoto = $_FILES['foto']['name'];
    $lokasilokasifoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasilokasifoto[0], "../foto_produk/" . $namanamafoto[0]);
    $koneksi->query("INSERT INTO produk(nama_produk,harga_produk,berat_produk,foto_produk,deskripsi_produk,id_kategori,stok_produk) 
    VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$namanamafoto[0]','$_POST[deskripsi]','$_POST[id_kategori]','$_POST[stok]')");

    // Mendapatkan id_produk barusan
    $id_produk_barusan = $koneksi->insert_id;

    foreach ($namanamafoto as $key => $tiap_nama) {
        $tiap_lokasi = $lokasilokasifoto[$key];
        move_uploaded_file($tiap_lokasi, "../foto_produk/" . $tiap_nama);

        // Simpan ke mysql dengan menggunakan id_produk barusan
        $koneksi->query("INSERT INTO produk_foto(id_produk,nama_produk_foto) 
        VALUES ('$id_produk_barusan','$tiap_nama')");
    }

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

    // echo "<pre>";
    // print_r($_FILES['foto']);
    // echo "</pre>";
}
?>

<script>
    $(document).ready(function() {
        $(".btn-tambah").on("click", function() {
            $(".letak-input").append("<input type='file' name='foto[]' class='form-control'>");
        })
    })
</script>