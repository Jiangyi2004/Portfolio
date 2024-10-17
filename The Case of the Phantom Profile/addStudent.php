<?php
session_start();
require 'connection.php';

// POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);

  if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt = $connection->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);

    if ($stmt->execute()) {
      $_SESSION['message'] = "Student succesvol toegevoegd.";
      header("Location: index.php");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin: auto;
      max-width: 400px;
    }

    input[type="text"],
    input[type="email"],
    button {
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 90%;
    }

    button {
      width: 100%;
      background-color: #28a745;
      color: white;
      cursor: pointer;
      border: none;
    }

    button:hover {
      background-color: #218838;
    }    
  </style>
  <script>
    function clearSearch() {
      window.location.href = 'index.php';
    }
  </script>
</head>
<body>
  <h1>Student toevoegen</h1>
  <form action="" method="post" autocomplete="off">
    Naam: <input type="text" name="name" placeholder="Naam invullen" required>
    <br>
    Email: <input type="email" name="email" placeholder="Email invullen" required>
    <br>
    <button type="button" onclick="clearSearch()">Terug</button>
    <button type="submit">Toevoegen</button>
  </form>
</body>
</html>