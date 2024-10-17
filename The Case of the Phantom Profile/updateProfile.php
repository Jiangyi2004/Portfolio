<?php
session_start();
require 'connection.php';

// POST =======================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];

  if ($id && !empty($name) && !empty($email)) {
    $stmt = $connection->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
      $_SESSION['message'] = "Student informatie succesvol bijgewerkt.";
    }
  }

  mysqli_close($connection);

  header("Location: index.php");
  exit;
}
?>