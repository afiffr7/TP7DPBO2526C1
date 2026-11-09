<h3>Customer List</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Membership</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers->getAll() as $customer): ?>
            <?php $formId = 'customer-' . $customer['id']; ?>
            <tr>
                <td><?= htmlspecialchars((string) $customer['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><input form="<?= $formId ?>" type="text" name="name" value="<?= htmlspecialchars((string) $customer['name'], ENT_QUOTES, 'UTF-8') ?>" readonly required></td>
                <td><input form="<?= $formId ?>" type="text" name="membership" value="<?= htmlspecialchars((string) $customer['membership'], ENT_QUOTES, 'UTF-8') ?>" readonly required></td>
                <td>
                    <form id="<?= $formId ?>" method="post">
                        <input type="hidden" name="page" value="customer">
                        <input type="hidden" name="action" value="update_customer">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $customer['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="edit-toggle" type="button">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                        <input type="hidden" name="page" value="customer">
                        <input type="hidden" name="action" value="delete_customer">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $customer['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="button-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form method="post">
    <h3>Add Data</h3>
    <input type="hidden" name="page" value="customer">
    <input type="hidden" name="action" value="add_customer">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="membership">Membership:</label>
    <input type="text" id="membership" name="membership" required>
    <button type="submit">Add Customer</button>
</form>