<?php 
    include_once ("dbconfig.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="list-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Product Management</p>
                <h1>Product list</h1>
                <p class="page-description">Manage your products.</p>
            </div>
            <a class="primary-action" href="newEntry.php">+ <span>New product</span></a>
        </header>

        <?php $rowData = $conn->query("SELECT * FROM items"); ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col" aria-label="Actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($rowData && $rowData->num_rows > 0) { ?>
                    <?php $counter = 1; ?>
                        <?php while ($row = $rowData->fetch_assoc()) { ?>
                            <tr>
                                <td class="id-cell"><?php echo $counter ; ?></td>
                                <td class="name-cell"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo number_format((float) $row['price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="status-cell"><span><?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?></span></td>
                                <td>
                                    <a class="edit-action" href="productEdit.php?id=<?php echo urlencode($row['id']); ?>" aria-label="Edit product" title="Edit product"><i class="bi bi-pencil-square action-icon" aria-hidden="true"></i></a>
                                    |
                                    <a class="delete-action" onclick="return confirm('Delete this product?')" href="productDelete.php?id=<?php echo urlencode($row['id']); ?>" aria-label="Delete product" title="Delete product"><i class="bi bi-trash3 action-icon" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td class="empty-state" colspan="8">No products yet. Add a product to get started.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
