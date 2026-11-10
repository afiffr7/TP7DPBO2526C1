<?php
require_once 'config/db.php';
class Product {
    // Menyimpan koneksi database yang digunakan seluruh operasi product.
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Menambahkan product baru beserta harganya.
    public function addData(string $name, string $price) {
        $stmt = $this->db->prepare("INSERT INTO product (name, price) VALUES (?, ?)");
        return $stmt->execute([$name, $price]);
    }

    // Mengambil seluruh product untuk tabel dan pilihan transaksi.
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Memperbarui nama dan harga product berdasarkan ID.
    public function update(string $id, string $name, string $price) {
        $stmt = $this->db->prepare("UPDATE product SET name = ?, price = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $id]);
    }

    // Menghapus product berdasarkan ID.
    public function deleteById(string $id){
        $stmt = $this->db->prepare("DELETE FROM product WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>