<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css/universal.css" />
  </head>
  <body>
    <section class="container-sidebar"></section>

    <main>
      <br>
      <form action="" method="post">
        <table>
          <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
          </tr>

          <tr>
            <td><input class="hjgy" type="text" name="kode_barang" required></td>
            <td><input class="hjgy" type="text" name="nama_barang" required></td>
            <td><input class="hjgy" type="text" name="kategori" required></td>
          </tr>

          <tr>
            <th>Harga</th>
            <th>Stok</th>
            <th></th>
          </tr>

          <tr>
            <td><input class="hjgy" type="number" name="harga" required></td>
            <td><input class="hjgy" type="number" name="stok" required></td>
            <td>
              <input class="btn-submit" type="submit" name="proses" value="Submit">
            </td>
          </tr>
        </table>

        <?php
        if (isset($_POST['proses'])) {

            include 'koneksi.php';

            $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
            $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
            $kategori    = mysqli_real_escape_string($koneksi, $_POST['kategori']);
            $harga       = (int) $_POST['harga'];
            $stok        = (int) $_POST['stok'];

            // Query
            $query = "INSERT INTO barang (kode_barang, nama_barang, kategori, harga_jual, stok) 
                      VALUES ('$kode_barang', '$nama_barang', '$kategori', '$harga', '$stok')";

            $result = mysqli_query($koneksi, $query);

            if ($result) {
                echo "<script>
                        alert('Data berhasil ditambahkan!');
                        window.location.href='index.php';
                      </script>";
            } else {
                $err = mysqli_error($koneksi);
                echo "<script>alert('Gagal menambahkan data: $err');</script>";
            }
        }
        ?>
      </form>
    </main>

    <script type="module" src="javascrip/tambah.js"></script>
  </body>
</html>
