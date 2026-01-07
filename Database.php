<?php

class Database {
    private static $instance = null;
    private $pdo, $query, $error = false, $results, $count;

    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=php-oop', 'root', '');
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

    public function query($sql, $params = []) {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);

        if (count($params)) {
            $i = 1;
            foreach($params as $param) {
                $this->query->bindValue($i, $param);
                $i++;
            }
        }

        if (!$this->query->execute()) {
            $this->error = true;
        } else {
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
        }

        return $this;
    }

    public function action($action, $table, $where=[]) {
        if(count($where) === 3) {
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            $operators = ['=', '>', '<', '>=', '<='];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field}{$operator} ?";
                if(!$this->query($sql, [$value])->error()) {
                    return $this;
                }

            }
        }

        return false;
    }

    public function get($table, $where = []) {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where=[]) {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields) {
        $keys = array_keys($fields);
        $keys = '`' . implode('`, `', $keys) . '`';

        $values = '';
        foreach ($fields as $field) {
            $values .= '?, ';
        }
        $val = rtrim($values, ', ');

        if (isset($fields['password'])) {
            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);
        }
        
        $sql = "INSERT INTO {$table} ($keys) VALUES ($val)";

        if(!$this->query($sql, array_values($fields))->error()) {
            return true;
        }

        return false;
    }

    public function error() {
        return $this->error;
    }

    public function results() {
        return $this->results;
    }

    public function count() {
        return $this->count;
    }
}