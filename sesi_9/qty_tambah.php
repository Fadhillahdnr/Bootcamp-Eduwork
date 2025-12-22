<?php
session_start();
$id = $_GET['id'];

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty']++;
}

header("Location: keranjang.php");
