<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Thêm mới sinh viên </h2>
    <form action="/QLSINHVIEN/public/sinhvien/store" method="post">
        <label for="hoten">Họ tên</label>
        <input type="text" name="hoten" id="hoten">
        <br>
        <label for="gioitinh">Giới tính</label>
        <input type="text" name="gioitinh" id="gioitinh">
        <br>
        <label for="mssv">MSSV</label>
        <input type="text" name="mssv" id="mssv">
        <br>
        <button type="submit">Thêm mới</button>
    </form>

</body>
</html>