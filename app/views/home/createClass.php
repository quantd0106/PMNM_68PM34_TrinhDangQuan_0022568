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

    <h2>Tạo lớp học mới</h2>

    <?php if (isset($error)): ?>
        <div style="color: #d9534f; background-color: #f2dede; padding: 10px; margin-bottom: 20px; border: 1px solid #ebccd1; border-radius: 4px; text-align: center;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="/QLSINHVIEN/public/home/store" method="POST">

        <div class="mb-3">
            <label class="form-label fw-bold">Mã Lớp <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="malop" required pattern=".*\S+.*" title="Mã lớp không được để trống">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tên Lớp <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="tenlop" required pattern=".*\S+.*" title="Tên lớp không được để trống">
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Ghi Chú</label>
            <input type="text" class="form-control" name="ghichu">
        </div>

        <div class="d-flex gap-2 mt-4">
            <a href="/QLSINHVIEN/public/home/index" class="btn btn-secondary w-50 py-2">Hủy</a>
            <button type="submit" class="btn btn-primary w-50 py-2">Tạo lớp học</button>
        </div>

    </form>

</div>