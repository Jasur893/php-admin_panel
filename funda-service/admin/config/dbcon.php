<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpadminpanel";

// Connection
$mysqli = mysqli_connect((string)$host, (string)$username, (string)$password, (string)$database);

// Check Connection
if (!$mysqli) {
  header("Location: ../errors/db.php");
  die(mysqli_connect_error($mysqli));
}
