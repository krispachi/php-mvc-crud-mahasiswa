<?php

namespace Krispachi\KrisnaLTE\App;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "db_siskampus";

    private $connection;
    private $statement;

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Koneksi ke database gagal: " . $exception->getMessage();
        }
    }

    public function query($query) {
        $this->statement = $this->connection->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        switch(true) {
            case is_int($value) :
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value) :
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value) :
                $type = PDO::PARAM_NULL;
                break;
            default :
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->statement->execute();
    }

    public function exec() {
        $this->statement->execute();
        return $this->connection->lastInsertId();
    }

    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }

    public function commit() {
        return $this->connection->commit();
    }

    public function rollback() {
        return $this->connection->rollBack();
    }
}