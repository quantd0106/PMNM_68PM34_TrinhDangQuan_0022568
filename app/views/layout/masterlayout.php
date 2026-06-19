<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Quản lý sinh viên'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f7f6; 
            color: #333;
        }

        .header {
            width: 100%;
            height: 70px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
            display: flex;
            align-items: center;
            justify-content: space-between; 
            padding: 0 5%;
            z-index: 10;
        }
        .header-logo {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        .header-logo span {
            color: #3498db;
        }
        .header-nav {
            display: flex;
            gap: 10px; 
        }
        .header-nav a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .header-nav a:hover, .header-nav a.active {
            background-color: #f0f4f8; 
            color: #3498db;
        }

        .content {
            flex: 1; 
            padding: 40px 5%;
        }

        .footer {
            width: 100%;
            height: 60px;
            background-color: #ffffff;
            border-top: 1px solid #eaeaea;
            color: #454545;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php require_once "../app/views/layout/partial/header.php"; ?>
    
    <div class='content'>
        <?php require_once '../app/views/' . $viewname . '.php'; ?>
    </div>
    
    <?php require_once "../app/views/layout/partial/footer.php"; ?>
</body>
</html>