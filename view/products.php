<!-- Tabel product menampilkan data sekaligus aksi edit dan hapus. -->
<h3>Product List</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products->getAll() as $product): ?>
            <?php $formId = 'product-' . $product['id']; ?>
            <tr>
                <td><?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><input form="<?= $formId ?>" type="text" name="name" value="<?= htmlspecialchars((string) $product['name'], ENT_QUOTES, 'UTF-8') ?>" readonly required></td>
                <td><input form="<?= $formId ?>" type="number" name="price" value="<?= htmlspecialchars((string) $product['price'], ENT_QUOTES, 'UTF-8') ?>" min="0" readonly required></td>
                <td>
                    <form id="<?= $formId ?>" method="post">
                        <input type="hidden" name="page" value="product">
                        <input type="hidden" name="action" value="update_product">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="edit-toggle" type="button">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="page" value="product">
                        <input type="hidden" name="action" value="delete_product">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="button-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Form penambahan product menerima nama dan harga. -->
<form method="post">
    <h3>Add Data</h3>
    <input type="hidden" name="page" value="product">
    <input type="hidden" name="action" value="add_product">
    <label for="product-name">Name:</label>
    <input type="text" id="product-name" name="name" required>
    <label for="product-price">Price:</label>
    <input type="number" id="product-price" name="price" min="0" required>
    <button type="submit">Add Product</button>
</form>