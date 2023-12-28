<?php

namespace Krispachi\KrisnaLTE\Model;

use Exception;
use Krispachi\KrisnaLTE\App\Database;

class MahasiswaModel {
    private $table = "mahasiswas";
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllMahasiswa() {
        $this->database->query("SELECT * FROM {$this->table}");
        return $this->database->resultSet();
    }

    public function getMahasiswaById($id) {
        $this->database->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function createMahasiswa($data) {
        $result = $this->getMahasiswaByNim($data["nim"]);
        if(!empty($result)) {
            throw new Exception("NIM sudah tersedia");
        }
        
        $query = "INSERT INTO {$this->table} (nim, nama, alamat, telepon, id_jurusan) VALUES(:nim, :nama, :alamat, :telepon, :id_jurusan)";
        $this->database->query($query);

        $this->database->bind("nim", $data["nim"]);
        $this->database->bind("nama", $data["nama"]);
        $this->database->bind("alamat", $data["alamat"]);
        $this->database->bind("telepon", $data["telepon"]);
        $this->database->bind("id_jurusan", $data["id_jurusan"]);

        $this->database->execute();
    }

    public function deleteMahasiswa($id) {
        // Cek ada atau tidak di database
        if(empty($this->getMahasiswaById($id))) {
            throw new Exception("Mahasiswa tidak ditemukan");
        }
        
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("id", $id);

        $this->database->execute();
    }

    public function updateMahasiswa($data) {
        // Cek ada atau tidak di database
        if(empty($this->getMahasiswaById($data["id"]))) {
            throw new Exception("Mahasiswa tidak ditemukan");
        }

        // Cek apakah ada nim itu? atau apakah nimnya sama dengan sebelumnya
        $result = $this->getMahasiswaByNim($data["nim"]);
        if(!empty($result)) {
            // Cek apakah nim dari database = nim dari data
            if($result[0]["id"] != $data["id"]) {
                throw new Exception("NIM sudah tersedia");
            }
        }
        
        $query = "UPDATE {$this->table} SET nim = :nim, nama = :nama, alamat = :alamat, telepon = :telepon, id_jurusan = :id_jurusan WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("nim", $data["nim"]);
        $this->database->bind("nama", $data["nama"]);
        $this->database->bind("alamat", $data["alamat"]);
        $this->database->bind("telepon", $data["telepon"]);
        $this->database->bind("id_jurusan", $data["id_jurusan"]);
        $this->database->bind("id", $data["id"]);

        $this->database->execute();
    }

    public function getMahasiswaByNim($nim) {
        $query = "SELECT * FROM {$this->table} WHERE nim = :nim";
        $this->database->query($query);

        $this->database->bind("nim", "$nim");

        return $this->database->resultSet();
    }
}