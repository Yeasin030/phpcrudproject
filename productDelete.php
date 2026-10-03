<?php
    include_once "dbconfig.php";
    require_once "Product.php";

    $product = new Product($conn);
    $id = $_GET['id'] ?? 0;

    $product->delete($id);
    header("Location: index.php");
    exit;
?>