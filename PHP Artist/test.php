<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['name']))) {
        $error = "姓名不能为空";
    } elseif (empty(trim($_POST['email']))) {
        $error = "电子邮件不能为空";
    }else {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        header("Location: address.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户信息表单</title>
    <link rel="stylesheet" href="common.css">
    <style>
        input[type="text"], input[type="email"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        .error {
            color: red;
            font-size: 12px;
            margin: 0;
        }
    </style>
    <script>
        function clearError(input) {
            const errorElement = document.getElementById(input + '-error');
            if (errorElement) {
                errorElement.innerText = '';
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>用户信息表单</h2>
        <form method="POST" action="">
            姓名: 
            <input type="text" name="name" id="name" oninput="clearError('name')">
            <div class="error" id="name-error"><?php if ($error && strpos($error, '姓名') !== false) echo $error; ?></div>
            
            电子邮件: 
            <input type="email" name="email" id="email" oninput="clearError('email')">
            <div class="error" id="email-error"><?php if ($error && strpos($error, '电子邮件') !== false) echo $error; ?></div>
            <input type="submit" value="下一步">
        </form>
    </div>
</body>
</html>
