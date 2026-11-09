<?php
require_once 'config/db.php';
class Transaction {
    private PDO $db; // attribut PDO untuk koneksi database
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // method menambah data transaction
    public function addData(string $customer_id, string $product_id, string $quantity, string $total_price) {
        $stmt = $this->db->prepare("INSERT INTO transactions (customer_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$customer_id, $product_id, $quantity, $total_price]);
    }

    // method mengambil data transaction
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

    // method update data transaction
    public function update(string $id, string $customer_id, string $product_id, string $quantity, string $total_price) {
        $stmt = $this->db->prepare("UPDATE transactions SET customer_id = ?, product_id = ?, quantity = ?, total_price = ? WHERE id = ?");
        return $stmt->execute([$customer_id, $product_id, $quantity, $total_price, $id]);
    }

    // method delete data transaction
    public function deleteById(string $id){
        $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>