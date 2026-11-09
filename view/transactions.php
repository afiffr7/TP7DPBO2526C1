<?php
$customerOptions = $customers->getAll();
$productOptions = $products->getAll();
?>
<h3>Transaction List</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions->getAll() as $transaction): ?>
            <?php $formId = 'transaction-' . $transaction['id']; ?>
            <tr>
                <td><?= htmlspecialchars((string) $transaction['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <select form="<?= $formId ?>" name="customer_id" disabled required>
                        <?php foreach ($customerOptions as $customer): ?>
                            <option value="<?= htmlspecialchars((string) $customer['id'], ENT_QUOTES, 'UTF-8') ?>" <?= (string) $customer['id'] === (string) $transaction['customer_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars((string) $customer['name'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select form="<?= $formId ?>" name="product_id" disabled required>
                        <?php foreach ($productOptions as $product): ?>
                            <option value="<?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?>" <?= (string) $product['id'] === (string) $transaction['product_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars((string) $product['name'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input form="<?= $formId ?>" type="number" name="quantity" value="<?= htmlspecialchars((string) $transaction['quantity'], ENT_QUOTES, 'UTF-8') ?>" min="1" readonly required></td>
                <td><input form="<?= $formId ?>" type="number" name="total_price" value="<?= htmlspecialchars((string) $transaction['total_price'], ENT_QUOTES, 'UTF-8') ?>" min="0" readonly required></td>
                <td>
                    <form id="<?= $formId ?>" method="post">
                        <input type="hidden" name="page" value="transaction">
                        <input type="hidden" name="action" value="update_transaction">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $transaction['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="edit-toggle" type="button">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                        <input type="hidden" name="page" value="transaction">
                        <input type="hidden" name="action" value="delete_transaction">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $transaction['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="button-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form method="post">
    <h3>Add Data</h3>
    <input type="hidden" name="page" value="transaction">
    <input type="hidden" name="action" value="add_transaction">
    <label for="new-transaction-customer">Customer:</label>
    <select id="new-transaction-customer" name="customer_id" required>
        <option value="">Select a customer</option>
        <?php foreach ($customerOptions as $customer): ?>
            <option value="<?= htmlspecialchars((string) $customer['id'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars((string) $customer['name'], ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="new-transaction-product">Product:</label>
    <select id="new-transaction-product" name="product_id" required>
        <option value="">Select a product</option>
        <?php foreach ($productOptions as $product): ?>
            <option value="<?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars((string) $product['name'], ENT_QUOTES, 'UTF-8') ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="new-transaction-quantity">Quantity:</label>
    <input type="number" id="new-transaction-quantity" name="quantity" min="1" required>
    <label for="new-transaction-total-price">Total Price:</label>
    <input type="number" id="new-transaction-total-price" name="total_price" min="0" required>
    <button type="submit">Add Transaction</button>
</form>