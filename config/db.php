<?php
class Database {
    // Konfigurasi koneksi MySQL untuk database aplikasi.
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "db_TP7DPBO";
    public $conn;

    public function __construct() {
        try {
            // Aktifkan exception PDO agar kegagalan query dapat diketahui.
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>