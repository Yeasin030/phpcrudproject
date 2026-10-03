<?php
    include_once "dbconfig.php";
    require_once "Product.php";

    $product = new Product($conn);
    $id = $_GET['id'] ?? 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'] ?? '';
        $category = $_POST['category'] ?? '';
        $price = $_POST['price'] ?? 0;
        $quantity = $_POST['quantity'] ?? 0;
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? 'Active';

        if ($product->update($id, $name, $category, $price, $quantity, $description, $status)) {
            echo "<div class='massage'>Update Completed</div>";
        }
    }

    $row = $product->findById($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Update Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h3>Product Update Form</h3>
    <form action="" method="post">
        <label>Product Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required> <br> <br>
        <label>Category</label>
        <input type="text" name="category" value="<?php echo htmlspecialchars($row['category'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required> <br><br>
        <label>Price</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($row['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" min="0" step="0.01" required> <br><br>
        <label>Quantity</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" min="0" step="1" required> <br><br>
        <label>Description</label>
        <textarea name="description" placeholder="Enter description" required><?php echo htmlspecialchars($row['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea> <br><br>
        <label>Status</label>
        <select name="status" required>
            <option value="Active" <?php echo ($row['status'] ?? 'Active') === 'Active' ? 'selected' : ''; ?>>Active</option>
            <option value="Inactive" <?php echo ($row['status'] ?? '') === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
            <option value="Discontinued" <?php echo ($row['status'] ?? '') === 'Discontinued' ? 'selected' : ''; ?>>Discontinued</option>
        </select> <br><br>
        <input type="submit" name="submit" value="Update">
    </form>
    <br> <br>
    <a href="index.php">Back to product List</a> <br> <br>
</body>
</html>