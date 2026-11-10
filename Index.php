<?php include 'backend/application-logic.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP7DPBO2526C1</title>
    <!-- Tampilan dan interaksi dipisah agar mudah dikelola. -->
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <!-- Bagian header dipakai bersama oleh seluruh halaman. -->
    <?php include 'view/header.php'; ?>

    <!-- Parameter page memilih fitur yang ditampilkan. -->
    <nav>
        <a href="?page=customer">Customer</a>
        <a href="?page=product">Product</a>
        <a href="?page=transaction">Transaction</a>
    </nav>

    <main>
        <!-- Umpan balik untuk hasil pemrosesan form. -->
        <?php if ($error !== ''): ?>
            <p class="message error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php elseif ($notice !== ''): ?>
            <p class="message success" role="status"><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <!-- Muat satu tampilan CRUD sesuai halaman yang sudah divalidasi. -->
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

    <!-- Footer juga digunakan bersama oleh seluruh halaman. -->
    <?php include 'view/footer.php'; ?>
</body>
</html>