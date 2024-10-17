<!-- step3.php -->
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['payment'] = $_POST['payment'];
    header("Location: summary.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <link rel="stylesheet" href="common.css">
    <style>
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            font-size: 16px;
            color: #333;
            cursor: pointer;
            appearance: none;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMCAyMCI+PHBhdGggZD0iTTEgNkwxMCAxNUwxOSA2IiBzdHJva2U9ImdyYXkiIGZpbGw9ImdyYXkiLz48L3N2Zz4=');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
        }

        /* 当鼠标悬停时 select 的样式 */
        select:hover {
            border-color: #888;
        }

        /* 选中的option元素的样式 */
        option {
            padding: 10px;
            background-color: #fff;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Betaalmethode: </h2>
        <form method="POST" action="">
            <select name="payment" required>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
            </select><br>
            <input type="submit" value="Verzenden">
        </form>
    </div>
</body>
</html>
