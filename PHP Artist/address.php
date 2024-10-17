<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$error_address = "";
$error_number = "";
$error_zip = "";
$error_place= "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['address']))) {
        $error_address = "Adres invullen";
    }

    if (empty(trim($_POST['number']))) {
        $error_number = "Huisnummer invullen";
    }

    if (empty(trim($_POST['zip']))) {
        $error_zip = "Postcode invullen";
    }

    if (empty(trim($_POST['place']))) {
        $error_place = "Plaats invullen";
    }

    if (empty($error_address) && empty($error_number) && empty($error_zip) && empty($error_place)) {
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['number'] = $_POST['number'];
        $_SESSION['zip'] = $_POST['zip'];
        $_SESSION['place'] = $_POST['place'];
        header("Location: payment.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adres</title>
    <link rel="stylesheet" href="common.css">
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
            <label for="">
                Adres: 
                <input type="text" name="address" id="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" oninput="clearError('address')"><br>
                <div class="error" id="address-error"><?php echo $error_address; ?></div>

                Huisnummer: 
                <input type="number" name="number" id="number" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>" oninput="clearError('number')"><br>
                <div class="error" id="number-error"><?php echo $error_number; ?></div>

                Postcode: 
                <input type="text" name="zip" id="zip" value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : ''; ?>" oninput="clearError('zip')"><br>
                <div class="error" id="zip-error"><?php echo $error_zip; ?></div>
                
                Plaats: 
                <input type="text" name="place" id="place" value="<?php echo isset($_POST['place']) ? htmlspecialchars($_POST['place']) : ''; ?>" oninput="clearError('place')"><br>
                <div class="error" id="place-error"><?php echo $error_place; ?></div>
            </label>
            <input type="submit" value="Volgende">
        </form>
    </div>
    <form method="POST" action="">
        
</form>
</body>
</html>