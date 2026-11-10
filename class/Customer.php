<?php
require_once 'config/db.php';
class Customer {
    // Menyimpan koneksi database yang digunakan seluruh operasi customer.
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Menambahkan customer baru beserta tingkat membership-nya.
    public function addData(string $name, string $membership) {
        $stmt = $this->db->prepare("INSERT INTO customer (name, membership) VALUES (?, ?)");
        return $stmt->execute([$name, $membership]);
    }

    // Mengambil seluruh customer untuk tabel dan pilihan transaksi.
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM customer");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Memperbarui nama dan membership customer berdasarkan ID.
    public function update(string $id, string $name, string $membership) {
        $stmt = $this->db->prepare("UPDATE customer SET name = ?, membership = ? WHERE id = ?");
        return $stmt->execute([$name, $membership, $id]);
    }

    // Menghapus customer berdasarkan ID.
    public function deleteById(string $id){
        $stmt = $this->db->prepare("DELETE FROM customer WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>