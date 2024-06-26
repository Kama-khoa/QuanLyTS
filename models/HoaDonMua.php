<?php
// models/HoaDonMua.php

class HoaDonMua {
    private $conn;
    private $table_name = "hoa_don_mua";

    public $hoa_don_id;
    public $ngay_mua;
    public $tong_gia_tri;
    public $nha_cung_cap_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT hm.*, ncc.ten_nha_cung_cap 
                  FROM " . $this->table_name . " hm
                  LEFT JOIN nha_cung_cap ncc ON hm.nha_cung_cap_id = ncc.nha_cung_cap_id
                  ORDER BY hm.ngay_mua DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllPaginated($page = 1, $recordsPerPage = 10) {
        $start = ($page - 1) * $recordsPerPage;
        $query = "SELECT hm.*, ncc.ten_nha_cung_cap 
                  FROM " . $this->table_name . " hm
                  LEFT JOIN nha_cung_cap ncc ON hm.nha_cung_cap_id = ncc.nha_cung_cap_id
                  ORDER BY hm.ngay_mua DESC
                  LIMIT :start, :records";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":start", $start, PDO::PARAM_INT);
        $stmt->bindParam(":records", $recordsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $query = "SELECT hm.*, ncc.ten_nha_cung_cap 
                  FROM " . $this->table_name . " hm
                  LEFT JOIN nha_cung_cap ncc ON hm.nha_cung_cap_id = ncc.nha_cung_cap_id
                  WHERE hm.hoa_don_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET ngay_mua=:ngay_mua, tong_gia_tri=:tong_gia_tri, nha_cung_cap_id=:nha_cung_cap_id";

        $stmt = $this->conn->prepare($query);

        $this->ngay_mua = htmlspecialchars(strip_tags($this->ngay_mua));
        $this->tong_gia_tri = htmlspecialchars(strip_tags($this->tong_gia_tri));
        $this->nha_cung_cap_id = htmlspecialchars(strip_tags($this->nha_cung_cap_id));

        $stmt->bindParam(':ngay_mua', $this->ngay_mua);
        $stmt->bindParam(':tong_gia_tri', $this->tong_gia_tri);
        $stmt->bindParam(':nha_cung_cap_id', $this->nha_cung_cap_id);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET ngay_mua=:ngay_mua, tong_gia_tri=:tong_gia_tri, nha_cung_cap_id=:nha_cung_cap_id 
                  WHERE hoa_don_id=:hoa_don_id";

        $stmt = $this->conn->prepare($query);

        $this->ngay_mua = htmlspecialchars(strip_tags($this->ngay_mua));
        $this->tong_gia_tri = htmlspecialchars(strip_tags($this->tong_gia_tri));
        $this->nha_cung_cap_id = htmlspecialchars(strip_tags($this->nha_cung_cap_id));
        $this->hoa_don_id = htmlspecialchars(strip_tags($this->hoa_don_id));

        $stmt->bindParam(':ngay_mua', $this->ngay_mua);
        $stmt->bindParam(':tong_gia_tri', $this->tong_gia_tri);
        $stmt->bindParam(':nha_cung_cap_id', $this->nha_cung_cap_id);
        $stmt->bindParam(':hoa_don_id', $this->hoa_don_id);

        return $stmt->execute();
    }

    public function delete($id) {
        // $this->conn->beginTransaction();

        try {
            // Xóa chi tiết hóa đơn
            $chiTietQuery = "SELECT tai_san_id FROM chi_tiet_hoa_don_mua WHERE hoa_don_id = ?";
            $stmt = $this->conn->prepare($chiTietQuery);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $chiTietHoaDon = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Xóa chi tiết hóa đơn
            $deleteChiTietQuery = "DELETE FROM chi_tiet_hoa_don_mua WHERE hoa_don_id = ?";
            $stmtDeleteChiTiet = $this->conn->prepare($deleteChiTietQuery);
            $stmtDeleteChiTiet->bindParam(1, $id);
            $stmtDeleteChiTiet->execute();

            foreach ($chiTietHoaDon as $chiTiet) {
                // Xóa tài sản liên quan
                $taiSanQuery = "DELETE FROM tai_san WHERE tai_san_id = ?";
                $stmtTaiSan = $this->conn->prepare($taiSanQuery);
                $stmtTaiSan->bindParam(1, $chiTiet['tai_san_id']);
                $stmtTaiSan->execute();
            }

            

            // Xóa hóa đơn
            $deleteHoaDonQuery = "DELETE FROM " . $this->table_name . " WHERE hoa_don_id = ?";
            $stmtDeleteHoaDon = $this->conn->prepare($deleteHoaDonQuery);
            $stmtDeleteHoaDon->bindParam(1, $id);
            $stmtDeleteHoaDon->execute();

            // $this->conn->commit();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getTotalRecords() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function search($searchTerm, $page = 1, $recordsPerPage = 10) {
        $start = ($page - 1) * $recordsPerPage;
        $query = "SELECT hm.*, ncc.ten_nha_cung_cap 
                  FROM " . $this->table_name . " hm
                  LEFT JOIN nha_cung_cap ncc ON hm.nha_cung_cap_id = ncc.nha_cung_cap_id
                  WHERE hm.ngay_mua LIKE :search 
                     OR ncc.ten_nha_cung_cap LIKE :search
                  ORDER BY hm.ngay_mua DESC
                  LIMIT :start, :records";
        
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%{$searchTerm}%";
        $stmt->bindParam(":search", $searchTerm);
        $stmt->bindParam(":start", $start, PDO::PARAM_INT);
        $stmt->bindParam(":records", $recordsPerPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function generateReport($startDate, $endDate) {
        $query = "SELECT hm.*, ncc.ten_nha_cung_cap 
                  FROM " . $this->table_name . " hm
                  LEFT JOIN nha_cung_cap ncc ON hm.nha_cung_cap_id = ncc.nha_cung_cap_id
                  WHERE hm.ngay_mua BETWEEN :start_date AND :end_date
                  ORDER BY hm.ngay_mua ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":start_date", $startDate);
        $stmt->bindParam(":end_date", $endDate);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>