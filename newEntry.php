<?php
    include_once "dbconfig.php";
    require_once __DIR__ . "/Product.php";

    $productClass = 'Product';
    $product = new $productClass($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'] ?? '';
        $category = $_POST['category'] ?? '';
        $price = $_POST['price'] ?? 0;
        $quantity = $_POST['quantity'] ?? 0;
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? 'Active';

        if ($product->create($name, $category, $price, $quantity, $description, $status)) {
            echo "Product added successfully";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Entry Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h3>Product Entry Form</h3>
    <form action="" method="post">
        <label>Product Name</label>
        <input type="text" name="name" value="" placeholder="Enter product name" required> <br> <br>
        <label>Category</label>
        <input type="text" name="category" value="" placeholder="Enter category" required> <br><br>
        <label>Price</label>
        <input type="number" name="price" value="" min="0" step="0.01" placeholder="0.00" required> <br><br>
        <label>Quantity</label>
        <input type="number" name="quantity" value="" min="0" step="1" placeholder="Enter quantity" required> <br><br>
        <label>Description</label>
        <textarea name="description" placeholder="Enter description" required></textarea> <br><br>
        <label>Status</label>
        <select name="status" required>
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Discontinued">Discontinued</option>
        </select> <br><br>
        <input type="submit" name="submit" value="save">
    </form>
    <br> <br>
    <a href="index.php">Back to product List</a> <br> <br>
</body>
</html>