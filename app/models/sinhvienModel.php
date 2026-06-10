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

        public function paging($limit, $offset, $search = '') {
            // đếm tổng số bản ghi
            $sqlCount = "SELECT COUNT(*) as total FROM tbl_sinhvien";
            $stmtCount = $this->conn->prepare($sqlCount);
            $stmtCount->execute();
            $totalRecord = $stmtCount->fetchColumn();
            $totalRecord = ceil($totalRecord / $limit);


            $sql = "SELECT * FROM tbl_sinhvien LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'sinhviens' => $result,
                'totalpage' => $totalRecord
            ];
        }

        public function getById($id) {
            $query = "SELECT * FROM tbl_sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $hoten, $gioitinh, $mssv) {
            $query = "UPDATE tbl_sinhvien SET sinhvien = :hoten, giotinh = :gioitinh, mssv = :mssv WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioitinh', $gioitinh);
            $stmt->bindParam(':mssv', $mssv);
            return $stmt->execute();
        }

        public function delete($id) {
            $query = "DELETE FROM tbl_sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }
    }
?>