<?php
include 'koneksi.php';
$error = "";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'] ?? '';

    // FILE GAMBAR
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $ukuran = $_FILES['gambar']['size'];
    $ekstensi = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

    $ekstensiValid = ['jpg','jpeg','png'];
    $namaGambarBaru = uniqid() . '.' . $ekstensi;

    // VALIDASI
    if (empty($nama) || empty($kategori) || empty($harga) || empty($deskripsi)) {
        $error = "Semua field wajib diisi!";
    } elseif (!in_array($ekstensi, $ekstensiValid)) {
        $error = "Format gambar harus JPG / PNG!";
    } elseif ($ukuran > 2000000) {
        $error = "Ukuran gambar maksimal 2MB!";
    } else {
        move_uploaded_file($tmp, 'uploads/' . $namaGambarBaru);

        mysqli_query($koneksi,
            "INSERT INTO produk (nama, kategori, harga, deskripsi, gambar)
            VALUES ('$nama','$kategori','$harga','$deskripsi','$namaGambarBaru')"
        );


        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-header bg-success text-white">
    <h4>Tambah Produk</h4>
</div>

<div class="card-body">
<?php if($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Nama Produk</label>
<input type="text" name="nama" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Kategori</label>
<select name="kategori" class="form-select">
    <option value="">-- Pilih Kategori --</option>
    <option>Skincare</option>
    <option>Make Up</option>
    <option>Parfum</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Harga</label>
<input type="number" name="harga" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi" class="form-control"></textarea>
</div>

<div class="mb-3">
<label class="form-label">Gambar Produk</label>
<input type="file" name="gambar" class="form-control">
</div>

<button name="simpan" class="btn btn-success">Simpan</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

