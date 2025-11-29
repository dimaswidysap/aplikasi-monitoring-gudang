<?php
include '../../koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM barang WHERE kode_barang='$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="../../css/universal.css">
    <link rel="stylesheet" href="../../css/update/edit.css">
</head>
<body>

    
    <form class="edit" action="update_proses.php" method="POST">
    <h2>Edit Data Barang</h2>

    <div>
        <input type="hidden" name="kode_barang" value="<?= $data['kode_barang'] ?>">
    </div>


    <div>
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>"><br><br>
    </div>

    <div>
        <label>Kategori:</label><br>
        <input type="text" name="kategori" value="<?= $data['kategori'] ?>"><br><br>
    </div>

    <div>
        <label>Harga Jual:</label><br>
        <input type="number" name="harga_jual" value="<?= $data['harga_jual'] ?>"><br><br>
    </div>

    <div>
        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?= $data['stok'] ?>"><br><br>
    </div>

    <div>
        <button type="submit"><span></span><span>Simpan Perubahan</span></button>
    </div>
</form>

</body>
</html>
