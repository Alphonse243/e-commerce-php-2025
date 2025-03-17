<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karma_shop";

try {
    $pdo = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8", 
        $username, 
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ]
    );
    return $pdo;
} catch(PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}
