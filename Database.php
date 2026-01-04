<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=php-crud-basic', 'root', '');
            echo 'Ok';
        } catch(PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Database;
        }

        return self::$instance;
    }
}