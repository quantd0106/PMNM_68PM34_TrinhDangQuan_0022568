<?php
require_once '../app/models/sinhvienModel.php';
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getALLSinhVien();

        $this->view("sinhvien/index", ["sinhvien" => $sinhvien, "title" => "Danh sach sinh vien"]);
    }
    public function create() {
        // trả về view
        require_once '../app/views/sinhvien/create.php';
    }
}
?><?php
require_once '../app/models/sinhvienModel.php';
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getALLSinhVien();

        $this->view("layout/masterlayout", ["viewname" => "sinhvien/index","sinhvien" => $sinhvien, "title" => "Danh sach sinh vien"]);
    }
    public function create() {
        // trả về view
        require_once '../app/views/sinhvien/create.php';
    }
    public function store(){
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $mssv = $_POST['mssv'];
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->create($hoten, $gioitinh, $mssv);
        if($result) {
            header("Location: /QLSINHVIEN/public/sinhvien/index");
        } else {
            echo "Thêm mới sinh viên thất bại";
        }
    }
}
?>