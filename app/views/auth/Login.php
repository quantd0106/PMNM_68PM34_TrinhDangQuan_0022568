<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f6f9;
        }

        .login-container {
            width: 400px;
            background: #fff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #4a90e2;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #357abd;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h1>Login</h1>

        <form action="/QLSINHVIEN/public/auth/login" method="POST">

            <div class="form-group">
                <label>UserName</label>
                <input type="text" name="username" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password">
            </div>

            <button type="submit" class="login-btn">
                Login
            </button>

        </form>
    </div>

</body>
</html>