<?php

namespace Krispachi\KrisnaLTE\Model;

use Exception;
use Krispachi\KrisnaLTE\App\Database;

class MajorModel {
    private $table = "jurusans";
    private $jurusan_mata_kuliah_table = "jurusans_mata_kuliahs";
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllMajor() {
        $this->database->query("SELECT * FROM {$this->table}");
        return $this->database->resultSet();
    }

    public function getMajorById($id) {
        $this->database->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function createMajor($data) {
        $result = $this->getMajorByNama($data["nama"]);
        if(!empty($result)) {
            throw new Exception("Nama Jurusan sudah tersedia");
        }
        
        try {
            // db begin transaction
            $this->database->beginTransaction();

            // insert ke database jurusans
            $query = "INSERT INTO {$this->table} (id, nama) VALUES('', :nama)";
            $this->database->query($query);
            $this->database->bind("nama", $data["nama"]);
            $last_insert_major = $this->database->exec();

            // insert ke database jurusans_mata_kuliahs
            foreach($data["mata_kuliahs"] as $subject_id) {
                $query = "INSERT INTO {$this->jurusan_mata_kuliah_table} (id_jurusan, id_mata_kuliah) VALUES (:major_id, :subject_id)";
                $this->database->query($query);
                $this->database->bind("major_id", $last_insert_major);
                $this->database->bind("subject_id", $subject_id);
                $this->database->execute();
            }
            // db commit
            $this->database->commit();
        } catch (Exception $exception) {
            // db rollback
            $this->database->rollback();
            throw $exception;
        }
    }

    public function deleteMajor($id) {
        // Cek ada atau tidak di database
        if(empty($this->getMajorById($id))) {
            throw new Exception("Jurusan tidak ditemukan");
        }

        // Hapus di tabel jurusans dan di junction jurusans_mata_kuliahs (db transaction)
        try {
            $this->database->beginTransaction();

            // Delete di jurusans
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $this->database->query($query);
            $this->database->bind("id", $id);
            $this->database->execute();
            
            // Delete di jurusans_mata_kuliahs
            $query = "DELETE FROM {$this->jurusan_mata_kuliah_table} WHERE id_jurusan = :id_jurusan";
            $this->database->query($query);
            $this->database->bind("id_jurusan", $id);
            $this->database->execute();

            $this->database->commit();
        } catch (Exception $exception) {
            $this->database->rollback();
            throw $exception;
        }
    }

    public function updateMajor($data) {
        // Cek ada atau tidak di database
        if(empty($this->getMajorById($data["id"]))) {
            throw new Exception("Jurusan tidak ditemukan");
        }

        // Cek apakah ada nama itu? atau apakah namanya sama dengan sebelumnya
        $result = $this->getMajorByNama($data["nama"]);
        if(!empty($result)) {
            // Cek apakah nama dari database = nama dari data
            if($result[0]["id"] != $data["id"]) {
                throw new Exception("Nama Jurusan sudah tersedia");
            }
        }
        
        try {
            $this->database->beginTransaction();
            
            // Delete di junction
            $query = "DELETE FROM {$this->jurusan_mata_kuliah_table} WHERE id_jurusan = :id_jurusan";
            $this->database->query($query);
            $this->database->bind("id_jurusan", $data["id"]);
            $this->database->execute();

            // Update di jurusans
            $query = "UPDATE {$this->table} SET nama = :nama WHERE id = :id";
            $this->database->query($query);
            $this->database->bind("nama", $data["nama"]);
            $this->database->bind("id", $data["id"]);
            $this->database->execute();

            // Insert di junction
            foreach($data["mata_kuliahs"] as $subject_id) {
                $query = "INSERT INTO {$this->jurusan_mata_kuliah_table} (id_jurusan, id_mata_kuliah) VALUES (:major_id, :subject_id)";
                $this->database->query($query);
                $this->database->bind("major_id", $data["id"]);
                $this->database->bind("subject_id", $subject_id);
                $this->database->execute();
            }

            $this->database->commit();
        } catch (Exception $exception) {
            $this->database->rollback();
            throw $exception;
        }
    }

    public function getMajorByNama($nama) {
        $query = "SELECT * FROM {$this->table} WHERE nama = :nama";
        $this->database->query($query);

        $this->database->bind("nama", "$nama");

        return $this->database->resultSet();
    }

    public function getNamaById($id) {
        $query = "SELECT nama FROM {$this->table} WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("id", "$id");

        return $this->database->single();
    }
}