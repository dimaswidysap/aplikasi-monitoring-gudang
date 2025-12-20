<?php
include '../../koneksi.php';


if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $queryJual = "SELECT * FROM barang WHERE kode_barang = '$id'";
    $resultJual = mysqli_query($koneksi, $queryJual);
    $row = mysqli_fetch_assoc($resultJual);

    if (!$row) {
        echo "<script>alert('Data barang tidak ditemukan!'); window.location='../../transaksi.php';</script>";
        exit;
    }
} else {
    header("Location: ../../transaksi.php");
    exit;
}


if (isset($_POST['input-pembeli'])) {
    $id_kode_transaksi = mysqli_real_escape_string($koneksi, $_POST['kode_pembeli']);
    $nama_pembeli      = mysqli_real_escape_string($koneksi, $_POST['nama_pembeli']);
    $kode_barang       = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $jumlah_barang     = (int)$_POST['qty'];
    $harga_satuan      = (float)$_POST['harga_jual'];
    $total_bayar       = $jumlah_barang * $harga_satuan;


    mysqli_begin_transaction($koneksi);

    try {
      
        $sqlTrx = "INSERT INTO transaksi (id_transaksi, total_bayar) VALUES ('$id_kode_transaksi', '$total_bayar')";
        mysqli_query($koneksi, $sqlTrx);

      
        $sqlDetail = "INSERT INTO detail_transaksi (id_transaksi, nama_pembeli, kode_barang, jumlah, harga_satuan) 
                      VALUES ('$id_kode_transaksi', '$nama_pembeli', '$kode_barang', '$jumlah_barang', '$harga_satuan')";
        mysqli_query($koneksi, $sqlDetail);

 
        $sqlStok = "UPDATE barang SET stok = stok - $jumlah_barang WHERE kode_barang = '$kode_barang'";
        mysqli_query($koneksi, $sqlStok);

        mysqli_commit($koneksi);
        echo "<script>alert('Transaksi Berhasil!'); window.location.href='../../transaksi.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        echo "<script>alert('Gagal: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Barang</title>
    <link rel="stylesheet" href="../../css/universal.css">
    <link rel="stylesheet" href="../../css/universalv2.css">
    <link rel="stylesheet" href="../../css/transaksi/transaksi.css">
    <link rel="stylesheet" href="../../css/jual/jual.css">
</head>
<body>

<main>
    <a class="hbgskn" href="../../transaksi.php">Kembali</a>
    <h1>Detail Barang</h1>
    
    <section class="container-table">
        <table>
            <tr>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Harga</td>
                <td>Stok</td>
                <td>Keterangan</td>
            </tr>

            <tr class="table-barang">                  
                <td><?= $row['kode_barang']; ?></td>                  
                <td><?= $row['nama_barang']; ?></td>                  
                <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td><?= $row['keterangan']; ?></td>
            </tr>
        </table>
    </section>

    <form action="" method="POST" class="form-pembeli">
        <section>
            <div><label for="kode_pembeli">Kode pembelian</label></div>
            <div><input id="kode_pembeli" type="text" name="kode_pembeli" placeholder="Masukkan kode pembelian" required></div>
        </section>

        <section>
            <div><label for="nama_pembeli">Nama Pembeli</label></div>
            <div><input id="nama_pembeli" type="text" name="nama_pembeli" placeholder="Masukkan nama pembeli" required></div>
        </section>

        <section>
            <div><label for="kode_barang">Kode Barang</label></div>
            <div><input id="kode_barang" type="text" name="kode_barang" readonly value="<?= $row['kode_barang']; ?>"></div>
        </section>

        <section>
            <div><label>Nama Barang</label></div>
            <div>
                <input type="text" value="<?= $row['nama_barang']; ?>" readonly style="background-color: #f0f0f0;">      
            </div>
        </section>

        <section>
            <div><label>Harga satuan Barang</label></div>
            <div>
                <input type="text" value="Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?>" readonly style="background-color: #f0f0f0;">      
                <input type="hidden" name="harga_jual" value="<?= $row['harga_jual']; ?>">
            </div>
        </section>

        <section>
            <div><label for="qty">Jumlah Beli</label></div>
            <div>
                <input id="qty" type="number" name="qty" min="1" max="<?= $row['stok']; ?>" placeholder="Stok tersedia: <?= $row['stok']; ?>" required>
            </div>
        </section>

        <section class="con-pembeli-submit">
            <input type="submit" name="input-pembeli" value="Simpan Transaksi">
        </section>
    </form>
</main>

</body>
</html>