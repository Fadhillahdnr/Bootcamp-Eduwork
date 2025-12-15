<?php
include 'koneksi.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';

$where = "WHERE 1";
$params = [];
$types = "";

if ($keyword != '') {
    $where .= " AND nama LIKE ?";
    $params[] = "%$keyword%";
    $types .= "s";
}

if ($kategori != '') {
    $where .= " AND kategori = ?";
    $params[] = $kategori;
    $types .= "s";
}

// DATA
$sql = "SELECT * FROM produk $where ORDER BY id DESC LIMIT ?, ?";
$params[] = $start;
$params[] = $limit;
$types .= "ii";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$data = $stmt->get_result();

// TOTAL DATA
$count = $koneksi->prepare("SELECT COUNT(*) FROM produk $where");
if ($types != "ii") {
    $count->bind_param(substr($types, 0, -2), ...array_slice($params, 0, -2));
}
$count->execute();
$count->bind_result($total);
$count->fetch();
$totalPage = ceil($total / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
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


<div class="container mt-4">
<div class="card shadow">
<div class="card-body">

<form class="row g-2 mb-3" method="get">
    <div class="col-md-4">
        <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="<?= $keyword ?>">
    </div>
    <div class="col-md-3">
        <select name="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            <option <?= $kategori=='Skincare'?'selected':'' ?>>Skincare</option>
            <option <?= $kategori=='Make Up'?'selected':'' ?>>Make Up</option>
            <option <?= $kategori=='Parfum'?'selected':'' ?>>Parfum</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Gambar</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=$start+1; while($row=$data->fetch_assoc()) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td>Rp <?= number_format($row['harga']) ?></td>
            <td><img src="uploads/<?= $row['gambar'] ?>" width="70"></td>
            <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<!-- PAGINATION -->
<nav>
    <ul class="pagination">
    <?php for($i=1;$i<=$totalPage;$i++): ?>
        <li class="page-item <?= $page==$i?'active':'' ?>">
            <a class="page-link" href="?page=<?= $i ?>&keyword=<?= $keyword ?>&kategori=<?= $kategori ?>">
            <?= $i ?>
            </a>
        </li>
    <?php endfor; ?>
    </ul>
</nav>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
