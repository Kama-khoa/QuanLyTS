<?php
// models/ChiTietHoaDonMua.php

class ChiTietHoaDonMua {
    private $conn;
    private $table_name = "chi_tiet_hoa_don_mua";

    public $chi_tiet_id;
    public $hoa_don_id;
    public $tai_san_id;
    public $so_luong;
    public $don_gia;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET hoa_don_id=:hoa_don_id, tai_san_id=:tai_san_id, so_luong=:so_luong, don_gia=:don_gia";

        $stmt = $this->conn->prepare($query);

        $this->hoa_don_id = htmlspecialchars(strip_tags($this->hoa_don_id));
        $this->tai_san_id = htmlspecialchars(strip_tags($this->tai_san_id));
        $this->so_luong = htmlspecialchars(strip_tags($this->so_luong));
        $this->don_gia = htmlspecialchars(strip_tags($this->don_gia));

        $stmt->bindParam(':hoa_don_id', $this->hoa_don_id);
        $stmt->bindParam(':tai_san_id', $this->tai_san_id);
        $stmt->bindParam(':so_luong', $this->so_luong);
        $stmt->bindParam(':don_gia', $this->don_gia);

        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function readByHoaDonId($hoa_don_id) {
        $query = "SELECT ct.*, ts.ten_tai_san, lts.ten_loai_tai_san
                  FROM " . $this->table_name . " ct
                  LEFT JOIN tai_san ts ON ct.tai_san_id = ts.tai_san_id
                  LEFT JOIN loai_tai_san lts ON ts.loai_tai_san_id = lts.loai_tai_san_id
                  WHERE ct.hoa_don_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $hoa_don_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET tai_san_id=:tai_san_id, so_luong=:so_luong, don_gia=:don_gia 
                  WHERE chi_tiet_id=:chi_tiet_id";

        $stmt = $this->conn->prepare($query);

        $this->tai_san_id = htmlspecialchars(strip_tags($this->tai_san_id));
        $this->so_luong = htmlspecialchars(strip_tags($this->so_luong));
        $this->don_gia = htmlspecialchars(strip_tags($this->don_gia));
        $this->chi_tiet_id = htmlspecialchars(strip_tags($this->chi_tiet_id));

        $stmt->bindParam(':tai_san_id', $this->tai_san_id);
        $stmt->bindParam(':so_luong', $this->so_luong);
        $stmt->bindParam(':don_gia', $this->don_gia);
        $stmt->bindParam(':chi_tiet_id', $this->chi_tiet_id);

        return $stmt->execute();
    }

    public function delete($chi_tiet_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE chi_tiet_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $chi_tiet_id);
        return $stmt->execute();
    }

    public function deleteByHoaDonId($hoa_don_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE hoa_don_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $hoa_don_id);
        return $stmt->execute();
    }
}
?>