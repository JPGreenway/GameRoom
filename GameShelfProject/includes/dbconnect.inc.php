<?php

// Database credentials. 
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'gameshelf';


// Setting dsn here rather than while making new PDO, allowing easier inclusion of variables with concatenation. 
$dsn = 'mysql: host=' . $host . ';dbname=' . $dbname;


// Establishing database connection.
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"'); 
}

catch (Exception $e) {
  header("location: error");
}