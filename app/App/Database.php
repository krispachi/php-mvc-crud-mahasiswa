<?php

namespace Krispachi\KrisnaLTE\App;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "db_siskampus";

    private $connection;
    private $statement;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Koneksi ke database gagal: " . $exception->getMessage();
        }
    }

    public function query($query)
    {
        $this->statement = $this->connection->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Execute the previously prepared SQL statement.
     *
     * @return void
     */
    public function execute()
    {
        $this->statement->execute();
    }

    /**
     * Execute the prepared SQL statement and return the last inserted ID.
     * 
     * Commonly used for INSERT queries.
     *
     * @return int The ID of the last inserted record.
     */
    public function exec()
    {
        $this->statement->execute();
        return $this->connection->lastInsertId();
    }

    /**
     * Execute the prepared statement and fetch all results as an associative array.
     * 
     * Commonly used for SELECT queries returning multiple rows.
     *
     * @return array The result set as an associative array.
     */
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute the prepared statement and fetch a single row as an associative array.
     * 
     * Commonly used for SELECT queries that return one record.
     *
     * @return array|false The single result row, or false if no record is found.
     */
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Begin a new database transaction.
     *
     * Transactions allow grouping multiple queries into a single atomic operation.
     *
     * @return bool True on success, false on failure.
     */
    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    /**
     * Commit the current transaction, permanently applying all changes.
     *
     * Should be called after successful operations within a transaction.
     *
     * @return bool True on success, false on failure.
     */
    public function commit()
    {
        return $this->connection->commit();
    }

    /**
     * Roll back the current transaction, reverting all changes since the last beginTransaction().
     *
     * Should be used when an error occurs during a transaction.
     *
     * @return bool True on success, false on failure.
     */
    public function rollback()
    {
        return $this->connection->rollBack();
    }
}
