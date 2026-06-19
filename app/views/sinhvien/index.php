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
             <a href="/QLSINHVIEN/public/sinhvien/create" class="btn btn-primary">
                + Thêm sinh viên
             </a>
         </div>
        
        <!-- Search and Filter Form -->
        <form method="GET" action="/QLSINHVIEN/public/sinhvien/index" style="margin-bottom: 20px;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" name="search" placeholder="Tìm kiếm theo họ tên, MSSV, mã lớp..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                
                <?php if (isset($sort_by)): ?>
                    <input type="hidden" name="sort_by" value="<?php echo htmlspecialchars($sort_by); ?>">
                <?php endif; ?>
                <?php if (isset($sort_order)): ?>
                    <input type="hidden" name="sort_order" value="<?php echo htmlspecialchars($sort_order); ?>">
                <?php endif; ?>
                <select name="filter_lop" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Tất cả lớp --</option>
                    <?php foreach ($lophocs as $lop): ?>
                        <option value="<?= $lop['id'] ?>" <?php echo ((string)$filter_lop === (string)$lop['id']) ? 'selected' : ''; ?>>
                            <?= $lop['malop'] ?> - <?= $lop['tenlop'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="btn btn-success">Tìm kiếm</button>
                <a href="/QLSINHVIEN/public/sinhvien/index" class="btn btn-secondary">Đặt lại</a>
                
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
                        <th>
                            <?php 
                            $order_mssv = (isset($sort_by) && $sort_by === 'mssv' && isset($sort_order) && $sort_order === 'ASC') ? 'DESC' : 'ASC';
                            $url_mssv = "?search=".urlencode($search)."&filter_lop=".urlencode($filter_lop)."&limit=".$limit."&sort_by=mssv&sort_order=".$order_mssv;
                            ?>
                            <a href="/QLSINHVIEN/public/sinhvien/index/1<?php echo $url_mssv; ?>" style="color: white; text-decoration: none;">
                                MSSV
                                <?php if (isset($sort_by) && $sort_by === 'mssv') echo ($sort_order === 'ASC') ? '▲' : '▼'; ?>
                            </a>
                        </th>
                        <th>
                            <?php 
                            $order_hoten = (isset($sort_by) && $sort_by === 'hoten' && isset($sort_order) && $sort_order === 'ASC') ? 'DESC' : 'ASC';
                            $url_hoten = "?search=".urlencode($search)."&filter_lop=".urlencode($filter_lop)."&limit=".$limit."&sort_by=hoten&sort_order=".$order_hoten;
                            ?>
                            <a href="/QLSINHVIEN/public/sinhvien/index/1<?php echo $url_hoten; ?>" style="color: white; text-decoration: none;">
                                Họ và tên
                                <?php if (isset($sort_by) && $sort_by === 'hoten') echo ($sort_order === 'ASC') ? '▲' : '▼'; ?>
                            </a>
                        </th>
                        <th>Giới tính</th>
                        <th>Lớp</th>
                        <th colspan="2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt = ($currentpage - 1) * $limit + 1;
                    foreach ($sinhvien as $sv) { ?> 
                        <tr>
                            <td> <?php echo $stt++; ?> </td>
                            <td> <?php echo $sv['mssv']; ?> </td>
                            <td> <?php echo $sv['sinhvien']; ?> </td>
                            <td> <?php echo $sv['gioitinh']; ?> </td>
                            <td> <?php echo $sv['tenlop'] . ' - ' . $sv['malop']; ?> </td>
                            <td style="width: 80px;">
                                <a href="/QLSINHVIEN/public/sinhvien/edit/<?php echo $sv['id']; ?>" class="btn btn-sm btn-warning w-100">Sửa</a>
                            </td>
                            <td style="width: 80px;">
                                <a href="/QLSINHVIEN/public/sinhvien/delete/<?php echo $sv['id']; ?>" class="btn btn-sm btn-danger w-100" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 10px; font-style: italic; color: #555;">
            Hiển thị bản ghi từ <?php echo $start_record; ?> đến <?php echo $end_record; ?> trong tổng số <?php echo $totalrecord; ?> bản ghi (Tổng cộng <?php echo $totalpage; ?> trang)
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
                if ($filter_lop !== '') {
                    $query_string .= ($query_string === '' ? '?' : '&') . 'filter_lop=' . $filter_lop;
                }
                if (isset($sort_order) && $sort_order !== 'ASC') {
                    $query_string .= ($query_string === '' ? '?' : '&') . 'sort_order=' . urlencode($sort_order);
                }
                if (isset($sort_by) && $sort_by !== 'mssv') {
                    $query_string .= ($query_string === '' ? '?' : '&') . 'sort_by=' . urlencode($sort_by);
                }
                if (isset($limit) && $limit != 3) {
                    $query_string .= ($query_string === '' ? '?' : '&') . 'limit=' . $limit;
                }
                
                for ($i = $start; $i <= $end; $i++) { ?>
                    <li class="page-item <?php echo ($i == $currentpage) ? 'active' : ''; ?>">
                        <a class="page-link" href="/QLSINHVIEN/public/sinhvien/index/<?php echo $i; ?><?php echo $query_string; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    </div>