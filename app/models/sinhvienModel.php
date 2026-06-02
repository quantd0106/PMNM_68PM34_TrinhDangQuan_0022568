<?php
    require_once '../app/core/DB.php';
    class sinhvienModel {
        public function __construct(){
            $db = new ConnectDB();
            $this->conn = $db->connect();
        }
        public function getALLSinhVien() {
            $query = "SELECT * FROM tbl_sinhvien";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($hoten, $gioitinh, $mssv) {
            $query = "INSERT INTO tbl_sinhvien (sinhvien, giotinh, mssv) VALUES (:hoten, :gioitinh, :mssv)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioitinh', $gioitinh);
            $stmt->bindParam(':mssv', $mssv);
            if($stmt->execute()) { 
                return true;
            } else {
                return false;
            }
        }
    }
?>