<?php
$host = "localhost";
$dbname = "tour_guide";
$user = "tour_guide";
$password = "Mydreams@98";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
