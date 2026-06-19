<?php

require_once '../app/models/lopModel.php';
require_once '../app/core/Controller.php';

class home extends Controller {
    public function index($page = 1){
        $currentpage = max(1, (int)$page);
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
        $offset = ($currentpage - 1) * $limit;
        
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        
        $lopModel = $this->model('lopModel');
        $result = $lopModel->paging($limit, $offset, $search);
        $lops = $result['lops'];
        $totalpage = $result['totalpage'];
        $totalrecord = $result['totalrecord'];
        
        $start_record = ($totalrecord > 0) ? $offset + 1 : 0;
        $end_record = min($offset + $limit, $totalrecord);
        
        $this->view('layout/masterlayout', [
            "viewname" => "home/indexClass",
            "title" => "Danh sách lớp học",
            "lops" => $lops,
            "currentpage" => $currentpage,
            "totalpage" => $totalpage,
            "search" => $search,
            "limit" => $limit,
            "totalrecord" => $totalrecord,
            "start_record" => $start_record,
            "end_record" => $end_record
        ]);
    }
    
    public function create(){
        $this->view('layout/masterlayout', [
            "viewname" => "home/createClass",
            "title" => "Tạo lớp học mới"
        ]);
    }
    
    public function store(){
        $malop = $_POST['malop'];
        $tenlop = $_POST['tenlop'];
        $ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
        $lopModel = $this->model('lopModel');

        if ($lopModel->checkLopExist($malop, $tenlop)) {
            $this->view('layout/masterlayout', [
                "viewname" => "home/createClass",
                "title" => "Tạo lớp học mới",
                "error" => "Lớp học đã tồn tại!"
            ]);
            return;
        }

        $result = $lopModel->create($malop, $tenlop, $ghichu);
        if($result) {
            header("Location: /QLSINHVIEN/public/home/index");
        } else {
            echo "Tạo lớp học thất bại";
        }
    }
    
    public function edit($id) {
        $lopModel = $this->model('lopModel');
        $lop = $lopModel->getById($id);
        $this->view('layout/masterlayout', [
            "viewname" => "home/editClass",
            "lop" => $lop,
            "title" => "Sửa thông tin lớp học"
        ]);
    }
    
    public function update($id) {
        $malop = $_POST['malop'];
        $tenlop = $_POST['tenlop'];
        $ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
        $lopModel = $this->model('lopModel');

        if ($lopModel->checkLopExist($malop, $tenlop, $id)) {
            $lop = clone (object)$_POST;
            $lop = ['id' => $id, 'malop' => $malop, 'tenlop' => $tenlop, 'ghichu' => $ghichu];
            $this->view('layout/masterlayout', [
                "viewname" => "home/editClass",
                "lop" => $lop,
                "title" => "Sửa thông tin lớp học",
                "error" => "Lớp học đã tồn tại!"
            ]);
            return;
        }

        $result = $lopModel->update($id, $malop, $tenlop, $ghichu);
        if($result) {
            header("Location: /QLSINHVIEN/public/home/index");
        } else {
            echo "Cập nhật lớp học thất bại";
        }
    }
    
    public function delete($id) {
        $lopModel = $this->model('lopModel');
        $result = $lopModel->delete($id);
        if($result) {
            header("Location: /QLSINHVIEN/public/home/index");
        } else {
            echo "Xóa lớp học thất bại";
        }
    }
    
    public function login(){
        require_once '../app/views/auth/Login.php';
    }
}
?>