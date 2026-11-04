<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - ลูกค้า</title>
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --accent-color: #8b5cf6;
            --accent-hover: #7c3aed;
            --text-color: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #475569;
        }

        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
        }

        .login-box {
            width: min(100%, 420px);
            padding: 36px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.3);
        }

        .login-box h2 {
            margin: 0 0 8px;
            color: var(--accent-color);
            font-size: 30px;
        }

        .login-subtitle {
            margin: 0 0 28px;
            color: var(--text-muted);
            text-align: center;
        }

        .login-box label {
            display: block;
            margin: 16px 0 8px;
            color: var(--text-color);
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: #111827;
            color: var(--text-color);
            font-size: 16px;
        }

        input:focus {
            outline: 2px solid var(--accent-color);
            outline-offset: 1px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 28px;
        }

        input[type="submit"],
        input[type="reset"] {
            flex: 1;
            padding: 12px 15px;
            border: 0;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        input[type="submit"] {
            background: var(--accent-color);
        }

        input[type="submit"]:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }

        input[type="reset"] {
            background: #475569;
        }

        input[type="reset"]:hover {
            background: #64748b;
            transform: translateY(-1px);
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 28px 22px;
            }
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2 style="text-align: center;">เข้าสู่ระบบ</h2>
        <p class="login-subtitle">เข้าสู่บัญชีลูกค้า Zenith</p>
        <form action="login_check.php" method="POST">
            <label>เบอร์โทรศัพท์ (Username) :</label>
            <input type="text" name="phone_number" required placeholder="08X-XXX-XXXX">
            
            <label>รหัสผ่าน (Password) :</label>
            <input type="password" name="password" required placeholder="กรอกรหัสผ่านของคุณ">
            
            <div class="form-actions">
                <input type="submit" value="Login">
                <input type="reset" value="Reset">
            </div>
        </form>
    </div>

</body>
</html>