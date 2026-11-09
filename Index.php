<?php include 'backend/application-logic.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP7DPBO2526C1</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <?php include 'view/header.php'; ?>

    <nav>
        <a href="?page=customer">Customer</a>
        <a href="?page=product">Product</a>
        <a href="?page=transaction">Transaction</a>
    </nav>

    <main>
        <?php if ($error !== ''): ?>
            <p class="message error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php elseif ($notice !== ''): ?>
            <p class="message success" role="status"><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <?php
            if($page == "customer") {
                include 'view/customers.php';
            }else if($page == "product") {
                include 'view/products.php';
            }else if($page == "transaction"){
                include 'view/transactions.php';
            }
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>