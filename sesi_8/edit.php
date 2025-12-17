<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori']; 
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($koneksi,
        "UPDATE produk SET 
        nama='$nama',
        kategori='$kategori', 
        harga='$harga',
        deskripsi='$deskripsi'
        WHERE id='$id'"
    );

    header("Location: index.php");
}
?>

<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'")
);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // CEK JIKA GAMBAR DIGANTI
    if (!empty($_FILES['gambar']['name'])) {
        // hapus gambar lama
        unlink("uploads/" . $data['gambar']);

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
        $gambarBaru = uniqid() . '.' . $ext;

        move_uploaded_file($tmp, "uploads/" . $gambarBaru);
    } else {
        $gambarBaru = $data['gambar'];
    }

    mysqli_query($koneksi, "
        UPDATE produk SET
            nama='$nama',
            kategori='$kategori',
            harga='$harga',
            deskripsi='$deskripsi',
            gambar='$gambarBaru'
        WHERE id='$id'
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">TOKO PRODUK</a>
            <div>
            <a href="tambah.php" class="btn btn-success btn-sm">+ Tambah Produk</a>
            </div>
        </div>
    </nav>


<div class="container mt-5">
<div class="card shadow">

<div class="card-header bg-warning">
    <h4 class="mb-0">Edit Produk</h4>
</div>

<div class="card-body">

<form method="post" enctype="multipart/form-data">

<div class="mb-3">
    <label class="form-label">Nama Produk</label>
    <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-select" required>
        <option <?= $data['kategori']=="Skincare"?'selected':'' ?>>Skincare</option>
        <option <?= $data['kategori']=="Make Up"?'selected':'' ?>>Make Up</option>
        <option <?= $data['kategori']=="Parfum"?'selected':'' ?>>Parfum</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Harga</label>
    <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" class="form-control" required><?= $data['deskripsi'] ?></textarea>
</div>

<div class="mb-3">
    <label class="form-label">Gambar Produk</label><br>
    <img src="uploads/<?= $data['gambar'] ?>" width="120" class="mb-2 rounded"><br>
    <input type="file" name="gambar" class="form-control">
    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
</div>

<button name="update" class="btn btn-warning">Update</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

