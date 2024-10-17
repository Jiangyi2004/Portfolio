<?php
require 'connection.php';

// id halen =======================
$id = isset($_GET['id']) ? $_GET['id'] : null;

// SQL =======================
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($connection, $sql);
$student = mysqli_fetch_assoc($result);
$name = $student['name'];
$email = $student['email'];
?>
<!DOCTYPE html>
<html lang="en">
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
  <h1><?php echo htmlspecialchars($name); ?> gegevens</h1>
  <form action="updateProfile.php" method="post">
    Naam:
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>
    Email:
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

    <button type="button" onclick="clearSearch()">Annuleren</button>
    <button type="submit">Bevestigen</button>
  </form>
</body>
</html>