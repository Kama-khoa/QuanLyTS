<?php
class PhieuTraChiTiet
{
    private $conn;
    private $table_name = "phieu_tra_chi_tiet";

    public $phieu_tra_chi_tiet_id;
    public $phieu_tra_id;
    public $tinh_trang;
    public $so_luong;
    public $tai_san_id;
    public $vi_tri_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readDetailById($id){
        $query = "SELECT DISTINCT pt.*, ptct.*, vt.ten_vi_tri, vtct.vi_tri_id as PT_VTCT, ts.ten_tai_san, vtct.so_luong as so_luong_trong_phong_ban
          FROM phieu_tra pt
          INNER JOIN phieu_tra_chi_tiet ptct ON pt.phieu_tra_id = ptct.phieu_tra_id
          INNER JOIN tai_san ts ON ts.tai_san_id = ptct.tai_san_id
          INNER JOIN vi_tri_chi_tiet vtct ON vtct.tai_san_id = ptct.tai_san_id
          INNER JOIN vi_tri vt ON vt.vi_tri_id = ptct.vi_tri_id
          WHERE pt.phieu_tra_id = ? AND ptct.vi_tri_id = vtct.vi_tri_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET phieu_tra_id=:phieu_tra_id, tinh_trang=:tinh_trang, 
                  so_luong=:so_luong, tai_san_id=:tai_san_id, vi_tri_id =:vi_tri_id";

        $stmt = $this->conn->prepare($query);

        $this->phieu_tra_id = htmlspecialchars(strip_tags($this->phieu_tra_id));
        $this->tinh_trang = htmlspecialchars(strip_tags($this->tinh_trang));
        $this->so_luong = htmlspecialchars(strip_tags($this->so_luong));
        $this->tai_san_id = htmlspecialchars(strip_tags($this->tai_san_id));
        $this->vi_tri_id = htmlspecialchars(strip_tags($this->vi_tri_id));

        $stmt->bindParam(":phieu_tra_id", $this->phieu_tra_id);
        $stmt->bindParam(":tinh_trang", $this->tinh_trang);
        $stmt->bindParam(":so_luong", $this->so_luong);
        $stmt->bindParam(":tai_san_id", $this->tai_san_id);
        $stmt->bindParam(":vi_tri_id", $this->vi_tri_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function readByPhieuTraId($phieu_tra_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE phieu_tra_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $phieu_tra_id);
        $stmt->execute();
        return $stmt;
    }


    public function update()
    {
        $query = "UPDATE " . $this->table_name . "
                  SET tinh_trang = :tinh_trang,
                      so_luong = :so_luong,
                      tai_san_id = :tai_san_id,
                      vi_tri_id =:vi_tri_id
                  WHERE phieu_tra_chi_tiet_id = :phieu_tra_chi_tiet_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tinh_trang", $this->tinh_trang);
        $stmt->bindParam(":so_luong", $this->so_luong);
        $stmt->bindParam(":tai_san_id", $this->tai_san_id);
        $stmt->bindParam(":vi_tri_id", $this->vi_tri_id);
        $stmt->bindParam(":phieu_tra_chi_tiet_id", $this->phieu_tra_chi_tiet_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deleteByPhieuTraId($phieu_tra_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE phieu_tra_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $phieu_tra_id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}