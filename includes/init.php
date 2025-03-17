<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Please run "composer install" first.');
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../classes/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                echo "Tentative de connexion à : $dsn<br>";
                
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
                
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
