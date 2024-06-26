<?php
class BaoTri {
    private $conn;
    private $table_name = "maintenance_schedule ";

    public $schedule_id;
    public $vi_tri_id;
    public $ngay_bat_dau;
    public $ngay_ket_thuc;
    public $mo_ta;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (vi_tri_id, ngay_bat_dau, ngay_ket_thuc, mo_ta) VALUES (:vi_tri_id, :ngay_bat_dau, :ngay_ket_thuc, :mo_ta)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':vi_tri_id', $this->vi_tri_id);
        $stmt->bindParam(':ngay_bat_dau', $this->ngay_bat_dau);
        $stmt->bindParam(':ngay_ket_thuc', $this->ngay_ket_thuc);
        $stmt->bindParam(':mo_ta', $this->mo_ta);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT bt.*, vt.ten_vi_tri FROM " . $this->table_name . " bt 
                  JOIN vi_tri vt ON vt.vi_tri_id = bt.vi_tri_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE schedule_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readByViTri($vi_tri_id){
        $query = "SELECT schedule_id FROM " . $this->table_name . " WHERE vi_tri_id = :vi_tri_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':vi_tri_id', $vi_tri_id);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET vi_tri_id = :vi_tri_id, ngay_bat_dau = :ngay_bat_dau, ngay_ket_thuc = :ngay_ket_thuc, mo_ta = :mo_ta WHERE schedule_id = :schedule_id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':vi_tri_id', $this->vi_tri_id);
        $stmt->bindParam(':ngay_bat_dau', $this->ngay_bat_dau);
        $stmt->bindParam(':ngay_ket_thuc', $this->ngay_ket_thuc);
        $stmt->bindParam(':mo_ta', $this->mo_ta);
        $stmt->bindParam(':schedule_id', $this->schedule_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE schedule_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
?>
