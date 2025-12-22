<?php
include 'koneksi.php'; // 🔹 Koneksi database MySQL

// ============================
// PAGINATION SETUP
// ============================
$limit = 5; // 🔹 Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// ============================
// FILTER & SEARCH INPUT
// ============================
$keyword  = $_GET['keyword'] ?? '';   // 🔹 Keyword pencarian nama produk
$kategori = $_GET['kategori'] ?? '';  // 🔹 Filter kategori produk

// ============================
// QUERY DINAMIS (FILTER + SEARCH)
// ============================
$where  = "WHERE 1";  // 🔹 Default WHERE agar mudah ditambahkan kondisi
$params = [];
$types  = "";

// 🔹 Jika keyword diisi, cari berdasarkan nama produk
if ($keyword != '') {
    $where .= " AND nama LIKE ?";
    $params[] = "%$keyword%";
    $types   .= "s";
}

// 🔹 Jika kategori dipilih, filter berdasarkan kategori
if ($kategori != '') {
    $where .= " AND kategori = ?";
    $params[] = $kategori;
    $types   .= "s";
}

// ============================
// QUERY AMBIL DATA PRODUK
// ============================
$sql = "SELECT * FROM produk $where ORDER BY id DESC LIMIT ?, ?";
$params[] = $start;
$params[] = $limit;
$types   .= "ii";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$data = $stmt->get_result(); // 🔹 Data produk ditampung di sini

// ============================
// HITUNG TOTAL DATA (UNTUK PAGINATION)
// ============================
$countSql = "SELECT COUNT(*) FROM produk $where";
$count = $koneksi->prepare($countSql);

// 🔹 Parameter pagination tidak ikut dihitung
if ($types != "ii") {
    $count->bind_param(substr($types, 0, -2), ...array_slice($params, 0, -2));
}

$count->execute();
$count->bind_result($total);
$count->fetch();

$totalPage = ceil($total / $limit); // 🔹 Total halaman
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- ============================
     NAVBAR
============================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">TOKO PRODUK</a>

            <div class="ms-auto d-flex gap-2">
                <a href="tambah.php" class="btn btn-success btn-sm">
                    + Tambah Produk
                </a>
                <a href="keranjang.php" class="btn btn-primary btn-sm">
                    Keranjang Saya
                </a>
            </div>
        </div>
    </nav>


<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <!-- ============================
                FORM SEARCH & FILTER
            ============================= -->
            <form class="row g-2 mb-3" method="get">
                <div class="col-md-4">
                    <!-- 🔹 Input pencarian produk -->
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari produk..." value="<?= $keyword ?>">
                </div>

                <div class="col-md-3">
                    <!-- 🔹 Filter kategori menggunakan SELECT -->
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Skincare" <?= $kategori=='Skincare'?'selected':'' ?>>Skincare</option>
                        <option value="Make Up" <?= $kategori=='Make Up'?'selected':'' ?>>Make Up</option>
                        <option value="Parfum" <?= $kategori=='Parfum'?'selected':'' ?>>Parfum</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </form>

            <!-- ============================
                TABEL DATA PRODUK
            ============================= -->
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <!-- 🔹 LOOPING PHP UNTUK MENAMPILKAN DATA PRODUK -->
                <?php $no=$start+1; while($row=$data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['kategori'] ?></td>
                        <td>Rp <?= number_format($row['harga']) ?></td>
                        <td>
                            <img src="uploads/<?= $row['gambar'] ?>" width="70">
                        </td>
                        <td>
                            <button 
                                class="btn btn-primary btn-sm btn-cart"
                                data-id="<?= $row['id'] ?>">
                                + Keranjang
                            </button>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data ini?')">
                            Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>

                </tbody>
            </table>

            <!-- ============================
                PAGINATION
            ============================= -->
            <nav>
                <ul class="pagination">
                <?php for($i=1;$i<=$totalPage;$i++): ?>
                    <li class="page-item <?= $page==$i?'active':'' ?>">
                        <a class="page-link"
                        href="?page=<?= $i ?>&keyword=<?= $keyword ?>&kategori=<?= $kategori ?>">
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
<script>
document.querySelectorAll('.btn-cart').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.dataset.id;

        fetch('cart_ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + id
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
        });
    });
});
</script>

</body>
</html>
