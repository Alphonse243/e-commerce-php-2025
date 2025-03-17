<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = require __DIR__ . '/../config/db.php';
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}
