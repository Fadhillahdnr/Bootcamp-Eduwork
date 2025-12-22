<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data produk
$query = $koneksi->prepare("SELECT * FROM produk WHERE id=?");
$query->bind_param("i", $id);
$query->execute();
$produk = $query->get_result()->fetch_assoc();

// Simpan ke session
$_SESSION['cart'][$id] = [
    'nama' => $produk['nama'],
    'harga' => $produk['harga'],
    'qty' => ($_SESSION['cart'][$id]['qty'] ?? 0) + 1
];

header("Location: keranjang.php");
