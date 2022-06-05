<?php
session_start();
/* Database credentials. */
// define('DB_SERVER', 'ligueseptudonat.mysql.db');
// define('DB_USERNAME', 'ligueseptudonat');
// define('DB_PASSWORD', 'Douchka224');
// define('DB_NAME', 'ligueseptudonat');

/* Local server */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ligueseptudonat');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

$conn = $pdo;
?>