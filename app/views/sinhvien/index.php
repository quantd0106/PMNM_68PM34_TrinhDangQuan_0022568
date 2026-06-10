<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title><?php echo $title ?></title>
</head>
<style>
    table {
        width: 100%;
    }
    table, th, td {
        text-align: center;
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
    }
    th {
        background-color: #456fc8;
        color: white;
    }
</style>
<body>

    <div class="container mt-4">
        <h1><?php echo $title ?></h1>
        <table>
            <tr>
                <th>id</th>
                <th>Ho va ten</th>
                <th>Gioi tinh</th>
                <th>mssv</th>
                <th colspan="2">Thao tác</th>
            </tr>
            <?php foreach ($sinhvien as $sv) { ?> 
                <tr>
                    <td> <?php echo $sv['id']; ?> </td>
                    <td> <?php echo $sv['sinhvien']; ?> </td>
                    <td> <?php echo $sv['giotinh']; ?> </td>
                    <td> <?php echo $sv['mssv']; ?> </td>
                    <td>
                        <a href="/QLSINHVIEN/public/sinhvien/edit/<?php echo $sv['id']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                    </td>
                    <td>
                        <a href="/QLSINHVIEN/public/sinhvien/delete/<?php echo $sv['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <nav aria-label="Page navigation" style="margin-top: 20px;">
            <ul class="pagination justify-content-center">
                <?php 
                $start = max(1, $currentpage - 2);
                $end = min($totalpage, $currentpage + 2);
                
                for ($i = $start; $i <= $end; $i++) { ?>
                    <li class="page-item <?php echo ($i == $currentpage) ? 'active' : ''; ?>">
                        <a class="page-link" href="/QLSINHVIEN/public/sinhvien/index/<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>