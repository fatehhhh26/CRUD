<?php
include_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dari database
    $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_product = '$id'");
    if ($row = mysqli_fetch_assoc($result)) {
        $product = $row['product'];
        $id_product = $row['id_product'];
        $harga = $row['harga'];
        $deskripsi = $row['deskripsi'];
        $jumlah = $row['jumlah'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data saat form disubmit
if (isset($_POST['update'])) {
    $product = $_POST['product'];
    $id_product = $_POST['id_product'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah = $_POST['jumlah'];

    $query = "UPDATE keranjang SET 
                product='$product', 
                harga='$harga', 
                deskripsi='$deskripsi', 
                jumlah='$jumlah' 
              WHERE id_product='$id_product'";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php"); // Redirect ke index setelah update
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color:rgb(29, 54, 218);
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea {
            height: 100px;
        }
        .btn {
            padding: 10px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-secondary {
            background-color: #ccc;
            margin-left: 10px;
        }
        .btn-secondary:hover {
            background-color: #aaa;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Produk</h1>

        <form action="edit.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="product">Nama Produk</label>
                <input type="text" name="product" id="product" value="<?php echo $product; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="id_product">ID Produk</label>
                <input type="text" name="id_product" id="id_product" value="<?php echo $id_product; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" value="<?php echo $harga; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi"><?php echo $deskripsi; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" value="<?php echo $jumlah; ?>" required>
            </div>

            <div style="margin-top: 20px;">
                <input type="submit" name="update" value="Update" class="btn">
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
