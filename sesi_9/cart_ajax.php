<?php
session_start();
include 'koneksi.php';

$id = $_POST['id'] ?? 0;

$query = $koneksi->prepare("SELECT nama, harga FROM produk WHERE id=?");
$query->bind_param("i", $id);
$query->execute();
$produk = $query->get_result()->fetch_assoc();

if ($produk) {
    $_SESSION['cart'][$id]['nama']  = $produk['nama'];
    $_SESSION['cart'][$id]['harga'] = $produk['harga'];
    $_SESSION['cart'][$id]['qty']   = ($_SESSION['cart'][$id]['qty'] ?? 0) + 1;

    echo json_encode([
        'status' => 'success',
        'message' => 'Produk berhasil ditambahkan ke keranjang'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Produk tidak ditemukan'
    ]);
}
