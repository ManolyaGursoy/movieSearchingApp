<?php
$servername = "localhost";
$user = "root";
$pass = "root";

try {
  $conn = new PDO('mysql:host=localhost;port=8889;dbname=moviesDb', $user, $pass);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
