<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Produk</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Fredoka', sans-serif;
      background: linear-gradient(135deg,rgb(95, 149, 172) 0%,rgb(53, 75, 183) 100%);
      padding: 40px 20px;
      color: #333;
    }

    .container {
      max-width: 1100px;
      margin: auto;
      background: white;
      border-radius: 20px;
      box-shadow: 12px 12px 0px #ff6b6b;
      padding: 30px;
    }

    h1 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 30px;
      color: #f368e0;
    }

    .header-action {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }
    .btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 6px;
    border: 1px solid #333;
    background-color: #fff;
    color: #333;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
    }


    .btn:hover {
      background-color: #1e90ff;
      transform: scale(1.05);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background-color: #fff9f4;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 16px;
      text-align: left;
      border-bottom: 2px dashed #ffc8dd;
    }

    th {
      background-color: #ffe0f0;
      color: #333;
    }

    tr:hover {
      background-color: #fceff9;
    }

    .btn-edit {
      background-color: #ffb142;
    }

    .btn-edit:hover {
      background-color: #ff9f1a;
    }

    .btn-delete {
      background-color: #ff6b81;
    }

    .btn-delete:hover {
      background-color: #e55039;
    }

    .no-data {
      text-align: center;
      padding: 20px;
      color: #999;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>✨ Edit Produk ✨</h1>

    <div class="header-action">
      <a href="tambah.php" class="btn">+ Tambah Produk</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>ID Produk</th>
          <th>Harga</th>
          <th>Deskripsi</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once("config.php");

        $result = mysqli_query($conn, "SELECT * FROM keranjang ORDER BY id_product DESC");

        if (mysqli_num_rows($result) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$row['product']."</td>";
                echo "<td>".$row['id_product']."</td>";
                echo "<td>Rp ".number_format($row['harga'], 0, ',', '.')."</td>";
                echo "<td>".$row['deskripsi']."</td>";
                echo "<td>".$row['jumlah']."</td>";
                echo "<td>
                        <a href='edit.php?id=".$row['id_product']."' class='btn btn-edit'>Edit</a>
                        <a href='hapus.php?id=".$row['id_product']."' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='no-data'>🚫 Tidak ada data produk</td></tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
