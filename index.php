<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="css/universal.css" />
    <link rel="stylesheet" href="css/universalv2.css" />
    <link rel="stylesheet" href="css/index/group.css">
  </head>
  <body>
    <section class="container-sidebar"></section>

    
    <main>

    
      <section class="container-filter">
        <form method="GET">

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
          <td>Harga</td>
          <td>Stok</td>
        </tr>

        <?php
        include 'koneksi.php';

       

        $query = "SELECT * FROM barang";

    
        if (isset($_GET['group'])) {
    switch ($_GET['group']) {

        case 'makanan':
            $query .= " WHERE kategori = 'makanan' ";
            break;

        case 'minuman':
            $query .= " WHERE kategori = 'minuman' ";
            break;
    }
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
            echo "<tr><td colspan='5'>Error: " . mysqli_error($koneksi) . "</td></tr>";
        }

        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='5'>Tidak ada data barang.</td></tr>";
        }

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr class="table-barang">
                <td><?= $row['kode_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
            </tr>
        <?php
        }
        ?>
      </table>

    </section>
    </main>

    <script>
      let lokasi='home'
      console.log(lokasi)
    </script>
    <script type="module" src="javascrip/index.js"></script>
  </body>
</html>
