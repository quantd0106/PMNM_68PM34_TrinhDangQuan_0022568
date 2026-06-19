<?php
require_once '../app/models/sinhvienModel.php';
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($page = 1) {
        // lấy dữ liệu phân trang từ model
        $currentpage = max(1, (int)$page);
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
        $offset = ($currentpage - 1) * $limit;

        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $filter_lop = isset($_GET['filter_lop']) ? (string)trim($_GET['filter_lop']) : '';
        $sort_order = isset($_GET['sort_order']) ? (string)trim($_GET['sort_order']) : 'ASC';
        $sort_by = isset($_GET['sort_by']) ? (string)trim($_GET['sort_by']) : 'mssv';

        $sinhvienModel = $this->model('sinhvienModel');
        $lophocs = $sinhvienModel->getAllLop();
        
        $result = $sinhvienModel->paging($limit, $offset, $search, $filter_lop, $sort_order, $sort_by);
        $sinhviens = $result['sinhviens'];
        $totalpage = $result['totalpage'];
        $totalrecord = $result['totalrecord'];

        $start_record = ($totalrecord > 0) ? $offset + 1 : 0;
        $end_record = min($offset + $limit, $totalrecord);

        $this->view("layout/masterlayout", 
        [
            "viewname" => "sinhvien/index",
            "sinhvien" => $sinhviens,
            "lophocs" => $lophocs, 
            "title" => "Danh sách sinh viên", 
            "currentpage" => $currentpage, 
            "totalpage" => $totalpage,
            "search" => $search,
            "filter_lop" => $filter_lop,
            "sort_order" => $sort_order,
            "sort_by" => $sort_by,
            "limit" => $limit,
            "totalrecord" => $totalrecord,
            "start_record" => $start_record,
            "end_record" => $end_record
        ]);
    }
    

    public function create() {
        $sinhvienModel = $this->model('sinhvienModel');
        $lophocs = $sinhvienModel->getAllLop();
        $this->view("layout/masterlayout", 
        [
            "viewname" => "sinhvien/create",
            "lophocs" => $lophocs, 
            "title" => "Thêm mới sinh viên"
        ]);
    }
    public function store(){
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $mssv = $_POST['mssv'];
        $lop_id = $_POST['malop'];
        $sinhvienModel = $this->model('sinhvienModel');

        if ($sinhvienModel->checkMssvExist($mssv)) {
            $lophocs = $sinhvienModel->getAllLop();
            $this->view("layout/masterlayout", 
            [
                "viewname" => "sinhvien/create",
                "lophocs" => $lophocs, 
                "title" => "Thêm mới sinh viên",
                "error" => "Sinh viên đã tồn tại!"
            ]);
            return;
        }

        $result = $sinhvienModel->create($hoten, $gioitinh, $mssv, $lop_id);
        if($result) {
            header("Location: /QLSINHVIEN/public/sinhvien/index");
        } else {
            echo "Thêm mới sinh viên thất bại";
        }
    }

    public function edit($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getById($id);
        $lophocs = $sinhvienModel->getAllLop();
        $this->view("layout/masterlayout", 
        [
            "viewname" => "sinhvien/edit",
            "sinhvien" => $sinhvien,
            "lophocs" => $lophocs, 
            "title" => "Sửa thông tin sinh viên"
        ]);
    }

    public function update($id) {
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $mssv = $_POST['mssv'];
        $lop_id = $_POST['lop_id'];
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->update($id, $hoten, $gioitinh, $mssv, $lop_id);
        if($result) {
            header("Location: /QLSINHVIEN/public/sinhvien/index");
        } else {
            echo "Cập nhật sinh viên thất bại";
        }
    }

    public function delete($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete($id);
        if($result) {
            header("Location: /QLSINHVIEN/public/sinhvien/index");
        } else {
            echo "Xóa sinh viên thất bại";
        }
    }
}
?>