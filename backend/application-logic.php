<?php
// Muat model yang menangani akses data untuk tiap fitur.
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

// Batasi halaman yang dapat dipilih melalui URL.
if (!is_string($page) || !in_array($page, $pages, true)) {
    $page = 'customer';
}

// Tangani seluruh operasi tambah, ubah, dan hapus yang dikirim melalui POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedPage = $_POST['page'] ?? ''; // deklarasi variabel page yaitu class yang sedang dikenakan CRUD saat ini
    $action = $_POST['action'] ?? ''; // deklarasi action CRUD yang sedang dilakukan
    $id = $_POST['id'] ?? ''; // deklarasi id dari data yang sedang dikenakan CRUD

    $requiresId = !in_array($action, ['add_customer', 'add_product', 'add_transaction'], true);

    // set page ke halaman yang sesuai dengan form yang dikirimkan
    if (is_string($postedPage) && in_array($postedPage, $pages, true)) {
        $page = $postedPage;
    }

    // Periksa halaman, aksi, dan ID sebelum menggunakan data kiriman.
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
        // Ambil nilai form; validasi spesifik dilakukan sebelum memanggil model.
        $name = $_POST['name'] ?? '';
        $membership = $_POST['membership'] ?? '';
        $price = $_POST['price'] ?? '';
        $customerId = $_POST['customer_id'] ?? '';
        $productId = $_POST['product_id'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        $totalPrice = $_POST['total_price'] ?? '';

        // Cocokkan aksi dengan fitur dan lakukan validasi sebelum CRUD.
        $valid = true;
        $updated = false;

        // Customer dapat ditambahkan, diperbarui, atau dihapus.
        if ($action === 'add_customer' && $postedPage === 'customer') {
            $valid = is_string($name) && trim($name) !== ''
                && is_string($membership) && trim($membership) !== '';
            if ($valid) {
                $updated = $customers->addData(trim($name), trim($membership));
            }
        // Product menyimpan nama dan harga berupa angka.
        } elseif ($action === 'add_product' && $postedPage === 'product') {
            $valid = is_string($name) && trim($name) !== ''
                && is_string($price) && ctype_digit($price);
            if ($valid) {
                $updated = $products->addData(trim($name), $price);
            }
        // Transaction menghubungkan customer dan product dengan jumlah serta total harga.
        } elseif ($action === 'add_transaction' && $postedPage === 'transaction') {
            $valid = is_string($customerId) && ctype_digit($customerId) && (int) $customerId > 0
                && is_string($productId) && ctype_digit($productId) && (int) $productId > 0
                && is_string($quantity) && ctype_digit($quantity) && (int) $quantity > 0
                && is_string($totalPrice) && ctype_digit($totalPrice);
            if ($valid) {
                $updated = $transactions->addData($customerId, $productId, $quantity, $totalPrice);
            }
        // Pembaruan memakai validasi yang sama dengan penambahan data.
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
        // Hapus data berdasarkan fitur dan ID yang dikirim.
        } elseif ($action === 'delete_customer' && $postedPage === 'customer') {
            $updated = $customers->deleteById($id);
        } elseif ($action === 'delete_product' && $postedPage === 'product') {
            $updated = $products->deleteById($id);
        } elseif ($action === 'delete_transaction' && $postedPage === 'transaction') {
            $updated = $transactions->deleteById($id);
        } else {
            $valid = false;
        }

        // Tampilkan kesalahan, atau alihkan kembali agar form tidak terkirim ulang.
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