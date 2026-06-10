<?php
require_once '../app/models/sinhvienModel.php';
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($page = 1) {
        // lấy dữ liệu phân trang từ model
        $currentpage = max(1, (int)$page);
        $limit = 3;
        $offset = ($currentpage - 1) * $limit;


        $sinhvienModel = $this->model('sinhvienModel');
        // $sinhvien = $sinhvienModel->getALLSinhVien();

        $result = $sinhvienModel->paging($limit, $offset);
        $sinhviens = $result['sinhviens'];
        $totalpage = $result['totalpage'];
        $this->view("layout/masterlayout", 
        [
            "viewname" => "sinhvien/index",
            "sinhvien" => $sinhviens, 
            "title" => "Danh sach sinh vien", 
            "currentpage" => $currentpage, 
            "totalpage" => $totalpage
        ]);
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

    public function edit($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getById($id);
        $this->view("layout/masterlayout", 
        [
            "viewname" => "sinhvien/edit",
            "sinhvien" => $sinhvien, 
            "title" => "Sửa thông tin sinh viên"
        ]);
    }

    public function update($id) {
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $mssv = $_POST['mssv'];
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->update($id, $hoten, $gioitinh, $mssv);
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