<?php
include 'koneksi.php';

$id = $_GET['id'];

// 1️⃣ Ambil nama gambar
$stmt = $koneksi->prepare("SELECT gambar FROM produk WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($gambar);
$stmt->fetch();
$stmt->close(); // ⭐ WAJIB

// 2️⃣ Hapus file gambar
if ($gambar && file_exists("uploads/$gambar")) {
    unlink("uploads/$gambar");
}

// 3️⃣ Hapus data produk
$del = $koneksi->prepare("DELETE FROM produk WHERE id=?");
$del->bind_param("i", $id);
$del->execute();
$del->close();

header("Location: index.php");
exit;
