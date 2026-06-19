<style>
    .form-container {
        width: 100%;
        max-width: 550px;
        margin: 30px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="form-container">

    <h2>Thêm mới sinh viên</h2>

    <?php if (isset($error)): ?>
        <div style="color: #d9534f; background-color: #f2dede; padding: 10px; margin-bottom: 20px; border: 1px solid #ebccd1; border-radius: 4px; text-align: center;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="/QLSINHVIEN/public/sinhvien/store" method="POST">

        <div class="mb-3">
            <label class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="hoten" required pattern=".*\S+.*" title="Họ tên không được để trống">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Giới tính <span class="text-danger">*</span></label>
            <select class="form-select" name="gioitinh" required>
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam">Nam</option>
                <option value="Nu">Nữ</option>
                <option value="Khac">Khác</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">MSSV <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="mssv" required pattern=".*\S+.*" title="MSSV không được để trống">
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Lớp học <span class="text-danger">*</span></label>
            <select class="form-select" name="malop" required>
                <option value="">-- Chọn lớp học --</option>

                <?php foreach($lophocs as $lop): ?>
                    <option value="<?= $lop['id'] ?>">
                        <?= $lop['malop'] ?> - <?= $lop['tenlop'] ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="d-flex gap-2 mt-4">
            <a href="/QLSINHVIEN/public/sinhvien/index" class="btn btn-secondary w-50 py-2">Hủy</a>
            <button type="submit" class="btn btn-primary w-50 py-2">Thêm mới</button>
        </div>

    </form>

</div>