<?php
session_start();

$error_name = "";
$error_email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['name']))) {
        $error_name = "Naam invullen";
    }

    if (empty(trim($_POST['email']))) {
        $error_email = "Email invullen";
    }

    if (empty($error_name) && empty($error_email)) {
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
    <title>index</title>
    <link rel="stylesheet" href="common.css">
    <style>
        .error {
            color: red;
            font-size: 14px;
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
        <h2>Gegevens</h2>
        <form method="POST" action="" autocomplete="off">
            Naam: 
            <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" oninput="clearError('name')">
            <div class="error" id="name-error"><?php echo $error_name; ?></div>
            
            Email: 
            <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" oninput="clearError('email')">
            <div class="error" id="email-error"><?php echo $error_email; ?></div>
            
            <input type="submit" value="Volgende">
        </form>
    </div>
</body>
</html>
