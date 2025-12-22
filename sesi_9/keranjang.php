<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Keranjang Belanja</h3>

<table class="table table-bordered align-middle text-center">
<thead class="table-dark">
<tr>
    <th>Nama</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php
$total = 0;
if (!empty($_SESSION['cart'])):
foreach ($_SESSION['cart'] as $id => $item):
$subtotal = $item['harga'] * $item['qty'];
$total += $subtotal;
?>
<tr>
    <td><?= $item['nama'] ?></td>
    <td>Rp <?= number_format($item['harga']) ?></td>
    <td>
        <div class="d-flex justify-content-center gap-2">
            <a href="qty_kurang.php?id=<?= $id ?>" class="btn btn-danger btn-sm">-</a>
            <span class="fw-bold"><?= $item['qty'] ?></span>
            <a href="qty_tambah.php?id=<?= $id ?>" class="btn btn-success btn-sm">+</a>
        </div>
    </td>
    <td>Rp <?= number_format($subtotal) ?></td>
    <td>
        <a href="hapus_cart.php?id=<?= $id ?>" 
           class="btn btn-outline-danger btn-sm"
           onclick="return confirm('Hapus produk ini dari keranjang?')">
           Hapus
        </a>
    </td>
</tr>
<?php endforeach; else: ?>
<tr>
    <td colspan="5">Keranjang masih kosong</td>
</tr>
<?php endif; ?>

</tbody>

<tfoot>
<tr>
    <th colspan="3">Total</th>
    <th colspan="2">Rp <?= number_format($total) ?></th>
</tr>
</tfoot>
</table>

<a href="index.php" class="btn btn-secondary">← Belanja Lagi</a>

</body>
</html>
