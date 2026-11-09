<?php
require_once 'config/db.php';
class Customer {
    private PDO $db; // attribut PDO untuk koneksi database
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // method menambah data customer
    public function addData(string $name, string $membership) {
        $stmt = $this->db->prepare("INSERT INTO customer (name, membership) VALUES (?, ?)");
        return $stmt->execute([$name, $membership]);
    }

    // method mengambil data customer
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM customer");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // method update data customer
    public function update(string $id, string $name, string $membership) {
        $stmt = $this->db->prepare("UPDATE customer SET name = ?, membership = ? WHERE id = ?");
        return $stmt->execute([$name, $membership, $id]);
    }

    // method delete data customer
    public function deleteById(string $id){
        $stmt = $this->db->prepare("DELETE FROM customer WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>