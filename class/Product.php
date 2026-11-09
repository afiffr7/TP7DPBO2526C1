<?php
require_once 'config/db.php';
class Product {
    private PDO $db; // attribut PDO untuk koneksi database
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // method menambah data product
    public function addData(string $name, string $price) {
        $stmt = $this->db->prepare("INSERT INTO product (name, price) VALUES (?, ?)");
        return $stmt->execute([$name, $price]);
    }

    // method mengambil data product
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // method update data product
    public function update(string $id, string $name, string $price) {
        $stmt = $this->db->prepare("UPDATE product SET name = ?, price = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $id]);
    }

    // method delete data product
    public function deleteById(string $id){
        $stmt = $this->db->prepare("DELETE FROM product WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>