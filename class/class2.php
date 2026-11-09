<?php
class Class2 {
    private PDO $db;
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM class");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update(string $id) {
        $stmt = $this->db->prepare("UPDATE class WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function deleteClass(string $id){
        $stmt = $this->db->prepare("DELETE class WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>