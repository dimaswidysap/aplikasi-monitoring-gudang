<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="css/universal.css" />
    
    <link rel="stylesheet" href="css/universalv2.css" />
    <link rel="stylesheet" href="css/index/group.css">
    <link rel="stylesheet" href="css/index/index.css">
  </head>
  <body>
    <section class="container-sidebar"></section>

    
<main>

  <section class="container-navigasi">
      <ul>
      <li>
        <a href="#">Semua Data</a>
      </li>
      <li>
        <a href="transaksi.php">Data Transaksi</a>
      </li>
      <li class="sdefcd">
        <a href="landing-page.html">Logout</a>
      </li>
    </ul>
  </section>


  <section class="container-data">
    <section class="container-filter">
        <form  method="GET">
          <div>
            <label for="cari-nama">Cari Nama Barang</label>
            <input type="text" name="cari-nama" id="cari-nama" 
                   value="<?= isset($_GET['cari-nama']) ? htmlspecialchars($_GET['cari-nama']) : '' ?>" 
                   >
          </div>

          <div>
            <label for="group">Kelompokan berdasarkan ?</label>
            <select name="group" id="group">
              <option value="">pilih/kosong</option>
              <option value="makanan" <?= (isset($_GET['group']) && $_GET['group']=='makanan') ? 'selected' : '' ?>>makanan</option>
              <option value="minuman" <?= (isset($_GET['group']) && $_GET['group']=='minuman') ? 'selected' : '' ?>>minuman</option>
            </select>
          </div>

          <div>
            <label for="sort">Urutkan berdasarkan ?</label>
            <select name="sort" id="sort">
              <option value="">Pilih/kosong</option>
              <option value="stok_desc"  <?= (isset($_GET['sort']) && $_GET['sort']=='stok_desc') ? 'selected' : '' ?>>Stok terbanyak ke sedikit</option>
              <option value="stok_asc"   <?= (isset($_GET['sort']) && $_GET['sort']=='stok_asc') ? 'selected' : '' ?>>Stok sedikit ke terbanyak</option>
              <option value="harga_desc" <?= (isset($_GET['sort']) && $_GET['sort']=='harga_desc') ? 'selected' : '' ?>>Harga mahal ke murah</option>
              <option value="harga_asc"  <?= (isset($_GET['sort']) && $_GET['sort']=='harga_asc') ? 'selected' : '' ?>>Harga murah ke mahal</option>
            </select>
          </div>

          <div>
            <button type="submit" name="filterkan">Submit</button>
          </div>
        </form>
      </section>
      


      <section class="container-table">
        <table>
          <tr>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Kategori</td>
            <td>Harga </td>
            <td>Stok</td>
            <td>Keterangan (stok)</td>
          </tr>

          <?php
          include 'koneksi.php';

          $query = "SELECT * FROM barang";
          
        
          $conditions = [];

         
          if (isset($_GET['cari-nama']) && !empty($_GET['cari-nama'])) {
              $keyword = mysqli_real_escape_string($koneksi, $_GET['cari-nama']);
            
              $conditions[] = "nama_barang LIKE '%$keyword%'"; 
          }

          
          if (isset($_GET['group']) && !empty($_GET['group'])) {
              $kategori = mysqli_real_escape_string($koneksi, $_GET['group']);
              
              if ($kategori == 'makanan' || $kategori == 'minuman') {
                  $conditions[] = "kategori = '$kategori'";
              }
          }

         
          if (count($conditions) > 0) {
              $query .= " WHERE " . implode(" AND ", $conditions);
          }

         
          if (isset($_GET['sort'])) {
              switch ($_GET['sort']) {
                  case 'stok_desc':
                      $query .= " ORDER BY stok DESC";
                      break;
                  case 'stok_asc':
                      $query .= " ORDER BY stok ASC";
                      break;
                  case 'harga_desc':
                      $query .= " ORDER BY harga_jual DESC";
                      break;
                  case 'harga_asc':
                      $query .= " ORDER BY harga_jual ASC";
                      break;
              }
          }

          $result = mysqli_query($koneksi, $query);

          if (!$result) {
              echo "<tr><td colspan='6'>Error: " . mysqli_error($koneksi) . "</td></tr>";
          } elseif (mysqli_num_rows($result) == 0) {
              echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data barang yang cocok.</td></tr>";
          } else {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
              <tr class="table-barang">
                  <td><?= $row['kode_barang']; ?></td>
                  <td><?= $row['nama_barang']; ?></td>
                  <td><?= $row['kategori']; ?></td>
                  <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                  <td><?= $row['stok']; ?></td>
                  <td><?= $row['keterangan']; ?></td>
              </tr>
          <?php
              }
          }
          ?>
        </table>
      </section>
      
  </section>




      
    </main>

    <script>
      let lokasi='home'
      console.log(lokasi)
    </script>
    <script type="module" src="javascrip/index.js"></script>
  </body>
</html>
