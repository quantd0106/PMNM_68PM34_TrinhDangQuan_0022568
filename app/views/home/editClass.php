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
        <h1>Sửa Thông Tin Lớp Học</h1>

        <?php if (isset($error)): ?>
            <div style="color: #d9534f; background-color: #f2dede; padding: 10px; margin-bottom: 20px; border: 1px solid #ebccd1; border-radius: 4px; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($lop)): ?>
            <form action="/QLSINHVIEN/public/home/update/<?php echo $lop['id']; ?>" method="POST">
                <input type="hidden"
                    name="id"
                    value="<?php echo $lop['id']; ?>">

                <div class="mb-3">
                    <label for="malop" class="form-label fw-bold">Mã Lớp <span class="text-danger">*</span></label>

                    <input
                        type="text"
                        class="form-control"
                        id="malop"
                        name="malop"
                        value="<?php echo htmlspecialchars($lop['malop']); ?>"
                        required pattern=".*\S+.*" title="Mã lớp không được để trống">
                </div>

                <div class="mb-3">
                    <label for="tenlop" class="form-label fw-bold">Tên Lớp <span class="text-danger">*</span></label>

                    <input
                        type="text"
                        class="form-control"
                        id="tenlop"
                        name="tenlop"
                        value="<?php echo htmlspecialchars($lop['tenlop']); ?>"
                        required pattern=".*\S+.*" title="Tên lớp không được để trống">
                </div>

                <div class="mb-4">
                    <label for="ghichu" class="form-label fw-bold">Ghi Chú</label>

                    <input
                        type="text"
                        class="form-control"
                        id="ghichu"
                        name="ghichu"
                        value="<?php echo htmlspecialchars($lop['ghichu'] ?? ''); ?>">
                </div>

                <div class="d-flex gap-2 mt-4">

                    <a href="/QLSINHVIEN/public/home/index"
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
                    Không tìm thấy lớp học.
                </p>

                <a href="/QLSINHVIEN/public/home/index"
                    class="btn-back">
                    Quay lại danh sách
                </a>
            </div>
        <?php endif; ?>
</div>