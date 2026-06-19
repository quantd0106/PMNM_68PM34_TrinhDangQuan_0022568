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
        <h1>Sửa Thông Tin Sinh Viên</h1>
        <?php if (!empty($sinhvien)): ?>
            <form action="/QLSINHVIEN/public/sinhvien/update/<?php echo $sinhvien['id']; ?>" method="POST">
                <input type="hidden"
                    name="id"
                    value="<?php echo $sinhvien['id']; ?>">

                <div class="mb-3">
                    <label for="hoten" class="form-label fw-bold">Họ tên</label>

                    <input
                        type="text"
                        class="form-control"
                        id="hoten"
                        name="hoten"
                        value="<?php echo htmlspecialchars($sinhvien['sinhvien']); ?>"
                        required pattern=".*\S+.*" title="Họ tên không được để trống">
                </div>

                <div class="mb-3">
                    <label for="gioitinh" class="form-label fw-bold">Giới tính</label>

                    <select class="form-select" id="gioitinh" name="gioitinh" required>
                        <option value="Nam"
                            <?php echo ($sinhvien['gioitinh'] == 'Nam') ? 'selected' : ''; ?>>
                            Nam
                        </option>

                        <option value="Nu"
                            <?php echo ($sinhvien['gioitinh'] == 'Nu') ? 'selected' : ''; ?>>
                            Nữ
                        </option>

                        <option value="Khac"
                            <?php echo ($sinhvien['gioitinh'] == 'Khac') ? 'selected' : ''; ?>>
                            Khác
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="mssv" class="form-label fw-bold">Mã số sinh viên</label>

                    <input
                        type="text"
                        class="form-control"
                        id="mssv"
                        name="mssv"
                        value="<?php echo htmlspecialchars($sinhvien['mssv']); ?>"
                        required pattern=".*\S+.*" title="MSSV không được để trống">
                </div>

                <div class="mb-4">
                    <label for="lop_id" class="form-label fw-bold">Lớp học</label>
                    <select class="form-select" name="lop_id" id="lop_id" required>
                        <?php foreach ($lophocs as $lop): ?>
                            <option value="<?= $lop['id'] ?>" <?php echo ($sinhvien['lop_id'] == $lop['id']) ? 'selected' : ''; ?>>
                                    <?= $lop['malop'] ?> - <?= $lop['tenlop'] ?>
                                </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="d-flex gap-2 mt-4">

                    <a href="/QLSINHVIEN/public/sinhvien/index"
                        class="btn btn-secondary w-50 py-2">
                        Hủy
                    </a>

                    <button type="submit"
                        class="btn btn-primary w-50 py-2">
                        Lưu thay đổi
                    </button>

                </div>

            </form>

        <?php else: ?>

            <div class="error-box">

                <p class="error-message">
                    Không tìm thấy sinh viên.
                </p>

                <a href="/QLSINHVIEN/public/sinhvien/index"
                    class="btn-back">
                    Quay lại danh sách
                </a>
            </div>
        <?php endif; ?>
</div>