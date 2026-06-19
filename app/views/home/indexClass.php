<style>
    .sv-container {
        width: 100%;
        max-width: 1000px;
        min-height: 535px;
        height: auto;
        margin: 0 auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    .table-custom th {
        background-color: #3498db;
        color: white;
        border-bottom: 2px solid #2980b9;
    }
    .table-custom td {
        vertical-align: middle;
    }
</style>

<div class="sv-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
             <h2><?php echo $title ?></h2>
             <a href="/QLSINHVIEN/public/home/create" class="btn btn-primary">
                + Thêm lớp học
             </a>
         </div>
        
        <!-- Search Form -->
        <form method="GET" action="/QLSINHVIEN/public/home/index" style="margin-bottom: 20px;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" name="search" placeholder="Tìm kiếm theo mã lớp hoặc tên lớp..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
                <a href="/QLSINHVIEN/public/home/index" class="btn btn-secondary">Đặt lại</a>
                <select name="limit" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-left: auto;">
                    <option value="3" <?php echo ($limit == 3) ? 'selected' : ''; ?>>3 bản ghi/trang</option>
                    <option value="5" <?php echo ($limit == 5) ? 'selected' : ''; ?>>5 bản ghi/trang</option>
                    <option value="10" <?php echo ($limit == 10) ? 'selected' : ''; ?>>10 bản ghi/trang</option>
                    <option value="20" <?php echo ($limit == 20) ? 'selected' : ''; ?>>20 bản ghi/trang</option>
                </select>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-custom text-center mb-0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Lớp</th>
                        <th>Tên Lớp</th>
                        <th>Ghi Chú</th>
                        <th colspan="2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt = ($currentpage - 1) * $limit + 1;
                    foreach ($lops as $lop) { ?> 
                        <tr>
                            <td> <?php echo $stt++; ?> </td>
                            <td> <?php echo $lop['malop']; ?> </td>
                            <td> <?php echo $lop['tenlop']; ?> </td>
                            <td> <?php echo htmlspecialchars($lop['ghichu'] ?? ''); ?> </td>
                            <td style="width: 80px;">
                                <a href="/QLSINHVIEN/public/home/edit/<?php echo $lop['id']; ?>" class="btn btn-sm btn-warning w-100">Sửa</a>
                            </td>
                            <td style="width: 80px;">
                                <a href="/QLSINHVIEN/public/home/delete/<?php echo $lop['id']; ?>" class="btn btn-sm btn-danger w-100" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 10px; font-style: italic; color: #555;">
            Bản ghi từ <?php echo $start_record; ?> đến <?php echo $end_record; ?> trong tổng <?php echo $totalrecord; ?> bản ghi (Tổng: <?php echo $totalpage; ?> trang)
        </div>

        <nav aria-label="Page navigation" style="margin-top: 20px;">
            <ul class="pagination justify-content-center">
                <?php 
                $start = max(1, $currentpage - 2);
                $end = min($totalpage, $currentpage + 2);
                $query_string = '';
                if ($search !== '') {
                    $query_string .= '?search=' . urlencode($search);
                }
                if (isset($sort_order) && $sort_order !== 'ASC') {
                    $query_string .= ($query_string === '' ? '?' : '&') . 'sort_order=' . urlencode($sort_order);
                }
                if (isset($limit) && $limit != 3) {
                    $query_string .= ($query_string === '' ? '?' : '&') . 'limit=' . $limit;
                }
                
                for ($i = $start; $i <= $end; $i++) { ?>
                    <li class="page-item <?php echo ($i == $currentpage) ? 'active' : ''; ?>">
                        <a class="page-link" href="/QLSINHVIEN/public/home/index/<?php echo $i; ?><?php echo $query_string; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    </div>