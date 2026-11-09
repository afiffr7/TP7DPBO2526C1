<?php
require_once 'class/Customer.php';
require_once 'class/Product.php';
require_once 'class/Transaction.php';

// Instansiasi objek untuk setiap kelas
$customers = new Customer();
$products = new Product();
$transactions = new Transaction();

$pages = ['customer', 'product', 'transaction']; // daftar halaman yang valid
$page = $_GET['page'] ?? 'customer'; // set page ke default yaitu customer jika belum diset
$error = ''; // error message

if (!is_string($page) || !in_array($page, $pages, true)) {
    $page = 'customer';
}

// logic untuk form CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedPage = $_POST['page'] ?? ''; // deklarasi variabel page yaitu class yang sedang dikenakan CRUD saat ini
    $action = $_POST['action'] ?? ''; // deklarasi action CRUD yang sedang dilakukan
    $id = $_POST['id'] ?? ''; // deklarasi id dari data yang sedang dikenakan CRUD

    $requiresId = !in_array($action, ['add_customer', 'add_product', 'add_transaction'], true);

    // set page ke halaman yang sesuai dengan form yang dikirimkan
    if (is_string($postedPage) && in_array($postedPage, $pages, true)) {
        $page = $postedPage;
    }

    // cek validasi data form
    if (
        !is_string($postedPage) ||
        !in_array($postedPage, $pages, true) ||
        !is_string($action) ||
        ($requiresId && (
            !is_string($id) ||
            !ctype_digit($id) ||
            (int) $id < 1
        ))
    ) {
        $error = 'Invalid form data. Please check the submitted values.';
    } else {
        // Ambil data dari form berupa seluruh attribut pada class
        $name = $_POST['name'] ?? '';
        $membership = $_POST['membership'] ?? '';
        $price = $_POST['price'] ?? '';
        $customerId = $_POST['customer_id'] ?? '';
        $productId = $_POST['product_id'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        $totalPrice = $_POST['total_price'] ?? '';

        $valid = true; // variabel pengecek validasi data form jika diupdate
        $updated = false;

        if ($action === 'add_customer' && $postedPage === 'customer') {
            $valid = is_string($name) && trim($name) !== ''
                && is_string($membership) && trim($membership) !== '';
            if ($valid) {
                $updated = $customers->addData(trim($name), trim($membership));
            }
        } elseif ($action === 'add_product' && $postedPage === 'product') {
            $valid = is_string($name) && trim($name) !== ''
                && is_string($price) && ctype_digit($price);
            if ($valid) {
                $updated = $products->addData(trim($name), $price);
            }
        } elseif ($action === 'add_transaction' && $postedPage === 'transaction') {
            $valid = is_string($customerId) && ctype_digit($customerId) && (int) $customerId > 0
                && is_string($productId) && ctype_digit($productId) && (int) $productId > 0
                && is_string($quantity) && ctype_digit($quantity) && (int) $quantity > 0
                && is_string($totalPrice) && ctype_digit($totalPrice);
            if ($valid) {
                $updated = $transactions->addData($customerId, $productId, $quantity, $totalPrice);
            }
        } elseif ($action === 'update_customer' && $postedPage === 'customer') {
            $valid = is_string($name) && trim($name) !== ''
                && is_string($membership) && trim($membership) !== '';
            if ($valid) {
                $updated = $customers->update($id, trim($name), trim($membership));
            }
        } elseif ($action === 'update_product' && $postedPage === 'product') {
            $valid = is_string($name) && trim($name) !== ''
                && is_string($price) && ctype_digit($price);
            if ($valid) {
                $updated = $products->update($id, trim($name), $price);
            }
        } elseif ($action === 'update_transaction' && $postedPage === 'transaction') {
            $valid = is_string($customerId) && ctype_digit($customerId) && (int) $customerId > 0
                && is_string($productId) && ctype_digit($productId) && (int) $productId > 0
                && is_string($quantity) && ctype_digit($quantity) && (int) $quantity > 0
                && is_string($totalPrice) && ctype_digit($totalPrice);
            if ($valid) {
                $updated = $transactions->update($id, $customerId, $productId, $quantity, $totalPrice);
            }
        } elseif ($action === 'delete_customer' && $postedPage === 'customer') {
            $updated = $customers->deleteById($id);
        } elseif ($action === 'delete_product' && $postedPage === 'product') {
            $updated = $products->deleteById($id);
        } elseif ($action === 'delete_transaction' && $postedPage === 'transaction') {
            $updated = $transactions->deleteById($id);
        } else {
            $valid = false;
        }

        if (!$valid) {
            $error = 'Please enter valid values for all fields.';
        } elseif (!$updated) {
            $error = 'The requested change could not be completed.';
        } else {
            header('Location: Index.php?page=' . urlencode($postedPage) . '&status=success');
            exit;
        }
    }
}

$notice = ($_GET['status'] ?? '') === 'success' ? 'Changes saved successfully.' : '';
?>