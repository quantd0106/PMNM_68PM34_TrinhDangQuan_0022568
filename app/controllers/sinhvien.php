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
?>