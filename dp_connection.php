<?php
$host = "webpagesdb.it.auth.gr"; 
$port=3306;
$username = "User1"; 
$password = "1234567890"; 
$database = "student3274partb";

try {
    $conn = new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);

} catch (PDOException $pe) {
    die('Connection error: ' . $pe->getMessage());
}
    return $conn
?>
