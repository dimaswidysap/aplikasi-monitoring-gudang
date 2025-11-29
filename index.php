<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="css/universal.css" />
  </head>
  <body>
    <section class="container-sidebar"></section>
    <main>
      <br>
      <table>
        <tr>
          <td>Kode Barang</td>
          <td>Nama Barang</td>
          <td>Kategori</td>
          <td>Harga</td>
          <td>Stok</td>
        </tr>
        <?php
                // 1. Panggil file koneksi
                include 'koneksi.php';

                // 2. Siapkan Query untuk mengambil semua data barang
                $query = "SELECT * FROM barang";
                
                // 3. Eksekusi Query
                $result = mysqli_query($koneksi, $query);

               

                // 4. Lakukan Perulangan (Looping)
                // mysqli_fetch_assoc mengubah data baris database menjadi array PHP
                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <tr>
                    
                    <td><?php echo $row['kode_barang']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    
                    <td><?php echo $row['kategori']; ?></td>
                    <td>Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                    
                    <td><?php echo $row['stok']; ?></td>
                </tr>

                <?php
                } // Akhir dari kurung kurawal while
                ?>
      </table>
    </main>

    <script type="module" src="javascrip/index.js"></script>
  </body>
</html>
