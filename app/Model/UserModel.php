<?php

namespace Krispachi\KrisnaLTE\Model;

use Exception;
use Krispachi\KrisnaLTE\App\Database;

class UserModel {
    private $table = "users";
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllUser() {
        $this->database->query("SELECT * FROM {$this->table}");
        return $this->database->resultSet();
    }

    public function getUserById($id) {
        $this->database->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function getRoleUserById($id) {
        $this->database->query("SELECT role FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function createUser($data) {
        $result = $this->getUserByUsername($data["username"]);
        if(!empty($result)) {
            throw new Exception("Username sudah tersedia");
        }
        
        $query = "INSERT INTO {$this->table} VALUES('', :username, :email, :password, null)";
        $this->database->query($query);

        $this->database->bind("username", $data["username"]);
        $this->database->bind("email", $data["email"]);
        $this->database->bind("password", password_hash($data["password"], PASSWORD_DEFAULT));

        $this->database->execute();
    }

    public function deleteUser($id) {
        // Cek ada atau tidak di database
        if(empty($this->getUserById($id))) {
            throw new Exception("User tidak ditemukan");
        }

        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("id", $id);

        $this->database->execute();
    }

    public function updateUser($data) {
        // Cek ada atau tidak di database
        if(empty($this->getUserById($data["id"]))) {
            throw new Exception("User tidak ditemukan");
        }

        // Cek apakah ada username itu? atau apakah usernamnya sama dengan sebelumnya
        $result = $this->getUserByUsername($data["username"]);
        if(!empty($result)) {
            // Cek apakah username dari database = username dari data
            if($result[0]["id"] != $data["id"]) {
                throw new Exception("Username sudah tersedia");
            }
        }
        
        $query = "UPDATE {$this->table} SET username = :username, email = :email WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("username", $data["username"]);
        $this->database->bind("email", $data["email"]);
        $this->database->bind("id", $data["id"]);

        $this->database->execute();
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM {$this->table} WHERE username = :username";
        $this->database->query($query);

        $this->database->bind("username", "$username");

        return $this->database->resultSet();
    }

    public function authUser($username, $password) {
        $users = $this->getUserByUsername($username);
        foreach($users as $user) {
            if(password_verify($password, $user["password"])) {
                return $user;
                break;
            }
            return [];
        }
    }
}