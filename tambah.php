<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Produk</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Fredoka', sans-serif;
      background: linear-gradient(135deg,rgb(138, 20, 104) 0%,rgb(7, 41, 98) 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .card {
      background: #fff;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 8px 8px 0px #333;
      width: 100%;
      max-width: 550px;
      position: relative;
      border: 3px dashed #ff6b6b;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    h1 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 25px;
      color: #ff6b6b;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 6px;
      color: #444;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 2px solid #ffd6e0;
      border-radius: 10px;
      background-color: #fdfdfd;
      font-size: 14px;
      box-shadow: 2px 2px 0px #aaa;
      transition: all 0.3s ease;
    }

    input:focus,
    textarea:focus {
      border-color: #7ed6df;
      outline: none;
      box-shadow: 0 0 5px rgba(126, 214, 223, 0.8);
    }

    textarea {
      height: 80px;
      resize: vertical;
    }

    .btn {
      display: inline-block;
      font-weight: bold;
      font-size: 14px;
      padding: 12px 20px;
      border: none;
      border-radius: 12px;
      background-color: #70a1ff;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 3px 3px 0px #333;
    }

    .btn:hover {
      background-color: #1e90ff;
      transform: scale(1.03);
    }

    .btn-secondary {
      background-color: #ff7f50;
      margin-left: 10px;
    }

    .btn-secondary:hover {
      background-color: #ff5722;
    }

    .msg {
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .msg.success {
      background-color: #dff9fb;
      color: #27ae60;
    }

    .msg.error {
      background-color: #ffeaa7;
      color: #d63031;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>🎉 Tambah Produk Baru</h1>

    <?php
    include_once("config.php");

    if (isset($_POST['submit'])) {
        $product = $_POST['product'];
        $id_product = $_POST['id_product'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $jumlah = $_POST['jumlah'];

        $errors = [];

        if (empty($product)) $errors[] = "Nama produk tidak boleh kosong";
        if (empty($id_product)) $errors[] = "ID produk tidak boleh kosong";
        if (empty($harga) || !is_numeric($harga)) $errors[] = "Harga harus berupa angka";
        if (empty($jumlah) || !is_numeric($jumlah)) $errors[] = "Jumlah harus berupa angka";

        if (empty($errors)) {
            $query = "INSERT INTO keranjang (product, id_product, harga, deskripsi, jumlah)
                      VALUES ('$product', '$id_product', '$harga', '$deskripsi', '$jumlah')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<div class='msg success'>✅ Produk berhasil ditambahkan. <a href='index.php'>Lihat Data</a></div>";
            } else {
                echo "<div class='msg error'>❌ Error: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='msg error'><ul>";
            foreach ($errors as $error) {
                echo "<li>⚠️ $error</li>";
            }
            echo "</ul></div>";
        }
    }
    ?>

    <form action="tambah.php" method="post">
      <div class="form-group">
        <label for="product">Nama Produk</label>
        <input type="text" name="product" id="product" required>
      </div>

      <div class="form-group">
        <label for="id_product">ID Produk</label>
        <input type="text" name="id_product" id="id_product" required>
      </div>

      <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" required>
      </div>

      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"></textarea>
      </div>

      <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" required>
      </div>

      <div style="margin-top: 25px;">
        <button type="submit" name="submit" class="btn">💾 Simpan</button>
        <a href="index.php" class="btn btn-secondary">🔙 Batal</a>
      </div>
    </form>
  </div>
</body>
</html>
