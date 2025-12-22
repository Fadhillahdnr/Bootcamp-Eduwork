<?php
include 'koneksi.php';

$nama = "";
$harga = "";
$deskripsi = "";
$error = "";
$sukses = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // VALIDASI
    if (empty($nama) || empty($harga) || empty($deskripsi)) {
        $error = "Semua field wajib diisi!";
    } else {
        // SIMPAN KE DATABASE
        $query = "INSERT INTO produk (nama, harga, deskripsi) 
                  VALUES ('$nama', '$harga', '$deskripsi')";

        if (mysqli_query($koneksi, $query)) {
            $sukses = "Produk berhasil disimpan ke database!";
            $nama = $harga = $deskripsi = "";
        } else {
            $error = "Gagal menyimpan data!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            background: blue;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            margin-top: 10px;
        }
        .error {
            color: red;
        }
        .sukses {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Tambah Produk</h2>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($sukses): ?>
        <p class="sukses"><?= $sukses ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nama Produk</label>
        <input type="text" name="nama" value="<?= $nama ?>">

        <label>Harga</label>
        <input type="number" name="harga" value="<?= $harga ?>">

        <label>Deskripsi</label>
        <textarea name="deskripsi"><?= $deskripsi ?></textarea>

        <button type="submit">Simpan</button>
    </form>
</div>

</body>
</html>
