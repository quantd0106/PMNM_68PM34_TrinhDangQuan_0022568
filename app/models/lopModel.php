<?php
    require_once '../app/core/DB.php';
    class lopModel {
        public function __construct(){
            $db = new ConnectDB();
            $this->conn = $db->connect();
        }

        public function getAll() {
            $query = "SELECT * FROM tbl_lophoc ORDER BY malop ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getById($id) {
            $query = "SELECT * FROM tbl_lophoc WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function create($malop, $tenlop, $ghichu) {
            $query = "INSERT INTO tbl_lophoc (malop, tenlop, ghichu) VALUES (:malop, :tenlop, :ghichu)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':malop', $malop);
            $stmt->bindParam(':tenlop', $tenlop);
            $stmt->bindParam(':ghichu', $ghichu);
            if($stmt->execute()) { 
                return true;
            } else {
                return false;
            }
        }

        public function update($id, $malop, $tenlop, $ghichu) {
            $query = "UPDATE tbl_lophoc SET malop = :malop, tenlop = :tenlop, ghichu = :ghichu WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':malop', $malop);
            $stmt->bindParam(':tenlop', $tenlop);
            $stmt->bindParam(':ghichu', $ghichu);
            return $stmt->execute();
        }

        public function delete($id) {
            $query = "DELETE FROM tbl_lophoc WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

        public function paging($limit, $offset, $search = '', $sort_order = 'ASC') {
            $where_clause = "";
            $params = array();
            
            if ($search !== '') {
                $where_clause = " WHERE (malop LIKE :search1 OR tenlop LIKE :search2)";
                $params[':search1'] = '%' . $search . '%';
                $params[':search2'] = '%' . $search . '%';
            }
            
            // Đếm tổng số bản ghi
            $sqlCount = "SELECT COUNT(*) as total FROM tbl_lophoc" . $where_clause;
            $stmtCount = $this->conn->prepare($sqlCount);
            $stmtCount->execute($params);
            $total_count = $stmtCount->fetchColumn();
            $totalpage = ceil($total_count / $limit);

            $sql = "SELECT * FROM tbl_lophoc" . $where_clause . " ORDER BY malop " . " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'lops' => $result,
                'totalpage' => $totalpage,
                'totalrecord' => $total_count
            ];
        }
        public function checkLopExist($malop, $tenlop, $exclude_id = null) {
            $query = "SELECT COUNT(*) FROM tbl_lophoc WHERE malop = :malop AND tenlop = :tenlop";
            if ($exclude_id) {
                $query .= " AND id != :exclude_id";
            }
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':malop', $malop);
            $stmt->bindParam(':tenlop', $tenlop);
            if ($exclude_id) {
                $stmt->bindParam(':exclude_id', $exclude_id);
            }
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
    }
?>