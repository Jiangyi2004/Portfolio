

<!-- summary.php -->
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if (!isset($_SESSION['name']) || !isset($_SESSION['email']) || !isset($_SESSION['address']) || !isset($_SESSION['payment'])) {
    header("Location: index.php");
    exit();
}

$address = $_SESSION['address'] . ' ' . $_SESSION['number'] . ', ' . $_SESSION['zip']. ' ' . $_SESSION['place'];
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; 
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px; 
            margin: 50px auto; 
            padding: 20px; 
            background: white; 
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
          display: inline;
          font-size: 22px;
          line-height: 1.6;
          color: #000;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bedankt voor je gegevens, <?php echo $_SESSION['name']; ?>!</h1>
        <div>
          <p>Naam:</p> <?php echo $_SESSION['name']; ?>
        </div>
        <div>
          <p>Email:</p> <?php echo $_SESSION['email']; ?>
        </div>
        <div>
          <p>Adres:</p> <?php echo $address; ?>
        </div>
        <div>
          <p>Betaalmethode:</p> <?php echo $_SESSION['payment']; ?>
        </div>
        <div class="footer">
            <p><a href="index.php">Home</a></p>
        </div>
    </div>
</body>
</html>
