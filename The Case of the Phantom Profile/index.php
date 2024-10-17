<?php
session_start();
require 'connection.php';

if (isset($_SESSION['message'])) {
  $message = htmlspecialchars($_SESSION['message']);
  unset($_SESSION['message']); // 清除消息
} else {
  $message = '';
}

// verwijderen=======================
if (isset($_GET['delete_id'])) {
  $delete_id = intval($_GET['delete_id']);
  
  $delete_sql = "DELETE FROM users WHERE id = ?";
  $stmt = $connection->prepare($delete_sql);
  $stmt->bind_param("i", $delete_id);
  
  if ($stmt->execute()) {
      $_SESSION['message'] = "Student succesvol verwijderd.";
  }
  
  $stmt->close();
  header("Location: index.php");
  exit();
}

// zoeken =======================
$searchName = '';
if (isset($_GET['search'])) {
  $searchName = $_GET['search'];
}
$sql = "SELECT * FROM users WHERE name LIKE '%$searchName%'";
$result = mysqli_query($connection, $sql);
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

    .message {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #c3e6cb;
      border-radius: 5px;
      display: none;
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
      width: 300px;
      text-align: center;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    form {
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    button {
      padding: 10px;
      margin: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #28a745;
      color: white;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }
    
    th {
      background-color: #f2f2f2;
      color: #333;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .message {
      color: green;
      margin-bottom: 10px;
    }

    .delete {
      text-decoration: none;
      background-color: #fc1000;
      border: 1px solid #fc1000;
      color: #000;
      border-radius: 7px;
      padding: 4px;
      margin-right: 20px;
    }

    .update {
      text-decoration: none;
      background-color: #5bd0ff;
      border: 1px solid #5bd0ff;
      color: #000;
      border-radius: 7px;
      padding: 4px;
    }
    </style>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var message = "<?php echo $message; ?>";
      if (message) {
        var messageBox = document.createElement("div");
        messageBox.className = "message";
        messageBox.innerText = message;
        document.body.appendChild(messageBox);
        messageBox.style.display = "block"; // 显示弹框

        setTimeout(function() {
          messageBox.style.display = "none";
        }, 3000);
      }
    });

    function clearSearch() {
      window.location.href = 'index.php';
    }
  </script>
</head>
<body>
  <h1>Student</h1>
  <form action="#" method="GET" autocomplete="off">
    Naam: <input type="text" name="search" value="<?php echo $searchName; ?>">
    <button type="submit">Zoeken</button>
    <button type="button" onclick="clearSearch()">Terug</button>
    <button formaction="addStudent.php">Nieuw student toevoegen</button>
  </form>
  <table border="1">
    <tr>
      <th>id</th>
      <th>Naam</th>
      <th>Email</th>
      <th>Verwerken</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>";
        echo "<a class='delete' href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Weet je zeker dat je deze student wilt verwijderen?');\">verwijderen</a> ";
        echo "<a class='update' href='alterProfile.php?id=" . $row['id'] . "'>bijwerken</a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Geen studenten gevonden</td></tr>";
    }
    ?>
  </table>
  <?php
  mysqli_close($connection);
  ?>
</body>
</html>