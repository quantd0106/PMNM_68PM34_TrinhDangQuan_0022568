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

        public function getAllLop() {
            $query = "SELECT * FROM tbl_lophoc";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($hoten, $gioitinh, $mssv, $lop_id) {
            $query = "INSERT INTO tbl_sinhvien (sinhvien, gioitinh, mssv, lop_id) VALUES (:hoten, :gioitinh, :mssv, :lop_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioitinh', $gioitinh);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->bindParam(':lop_id', $lop_id, PDO::PARAM_INT);
            if($stmt->execute()) { 
                return true;
            } else {
                return false;
            }
        }

        public function paging($limit, $offset, $search = '', $filter_lop = '', $sort_order = 'ASC', $sort_by = 'mssv') {
            // Xây dựng WHERE clause
            $where_conditions = array();
            
            if ($search !== '') {
                $where_conditions[] = "(sv.sinhvien LIKE :search1 OR sv.mssv LIKE :search2 OR lh.malop LIKE :search3)";
            }
            
            if ($filter_lop !== '') {
                $where_conditions[] = "sv.lop_id = :filter_lop";
            }
            
            $where_clause = "";
            if (!empty($where_conditions)) {
                $where_clause = " WHERE " . implode(" AND ", $where_conditions);
            }
            
            // Chuẩn bị parameters
            $params = array();
            if ($search !== '') {
                $search_param = '%' . $search . '%';
                $params[':search1'] = $search_param;
                $params[':search2'] = $search_param;
                $params[':search3'] = $search_param;
            }
            if ($filter_lop !== '') {
                $params[':filter_lop'] = (int)$filter_lop;
            }
            
            // Đếm tổng số bản ghi
            $sqlCount = "SELECT COUNT(*) as total FROM tbl_sinhvien sv JOIN tbl_lophoc lh ON sv.lop_id = lh.id" . $where_clause;
            $stmtCount = $this->conn->prepare($sqlCount);
            $stmtCount->execute($params);
            $total_count = $stmtCount->fetchColumn();
            $totalpage = ceil($total_count / $limit);

            // Lấy dữ liệu
            $valid_sort_order = strtoupper($sort_order) === 'DESC' ? 'DESC' : 'ASC';
            $valid_sort_by = $sort_by === 'hoten' ? 'sv.sinhvien' : 'sv.mssv';
            $sql = "SELECT sv.*, lh.malop, lh.tenlop FROM tbl_sinhvien sv JOIN tbl_lophoc lh ON sv.lop_id = lh.id" . $where_clause . " ORDER BY " . $valid_sort_by . " " . $valid_sort_order . " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'sinhviens' => $result,
                'totalpage' => $totalpage,
                'totalrecord' => $total_count
            ];
        }

        public function getById($id) {
            $query = "SELECT * FROM tbl_sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $hoten, $gioitinh, $mssv, $lop_id) {
            $query = "UPDATE tbl_sinhvien SET sinhvien = :hoten, gioitinh = :gioitinh, mssv = :mssv, lop_id = :lop_id WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioitinh', $gioitinh);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->bindParam(':lop_id', $lop_id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function delete($id) {
            $query = "DELETE FROM tbl_sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

        public function checkMssvExist($mssv) {
            $query = "SELECT COUNT(*) FROM tbl_sinhvien WHERE mssv = :mssv";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
    }
?>