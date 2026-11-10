<?php
require_once 'config/db.php';
class Transaction {
    // Menyimpan koneksi database yang digunakan seluruh operasi transaksi.
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mencatat transaksi dengan relasi customer, product, jumlah, dan total harga.
    public function addData(string $customer_id, string $product_id, string $quantity, string $total_price) {
        $stmt = $this->db->prepare("INSERT INTO transactions (customer_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$customer_id, $product_id, $quantity, $total_price]);
    }

    // Mengambil transaksi sekaligus nama customer dan product untuk ditampilkan.
    public function getAll() {
        $stmt = $this->db->query(
            "SELECT t.id, t.customer_id, t.product_id,
                    c.name AS customer_name, p.name AS product_name,
                    t.quantity, t.total_price
             FROM transactions t
             JOIN customer c ON t.customer_id = c.id
             JOIN product p ON t.product_id = p.id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Memperbarui relasi dan rincian transaksi berdasarkan ID.
    public function update(string $id, string $customer_id, string $product_id, string $quantity, string $total_price) {
        $stmt = $this->db->prepare("UPDATE transactions SET customer_id = ?, product_id = ?, quantity = ?, total_price = ? WHERE id = ?");
        return $stmt->execute([$customer_id, $product_id, $quantity, $total_price, $id]);
    }

    // Menghapus transaksi berdasarkan ID.
    public function deleteById(string $id){
        $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>