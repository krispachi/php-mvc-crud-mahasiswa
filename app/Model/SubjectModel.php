<?php

namespace Krispachi\KrisnaLTE\Model;

use Exception;
use Krispachi\KrisnaLTE\App\Database;

class SubjectModel {
    private $table = "mata_kuliahs";
    private $jurusan_mata_kuliah_table = "jurusans_mata_kuliahs";
    private $major_table = "jurusans";
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllSubject() {
        $this->database->query("SELECT * FROM {$this->table}");
        return $this->database->resultSet();
    }

    public function getSubjectById($id) {
        $this->database->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function createSubject($data) {
        $result = $this->getSubjectByKode($data["kode"]);
        if(!empty($result)) {
            throw new Exception("Kode Mata Kuliah sudah tersedia");
        }
        
        $query = "INSERT INTO {$this->table} (id, kode, nama, jumlah_sks) VALUES('', :kode, :nama, :jumlah_sks)";
        $this->database->query($query);

        $this->database->bind("kode", $data["kode"]);
        $this->database->bind("nama", $data["nama"]);
        $this->database->bind("jumlah_sks", $data["jumlah_sks"]);

        $this->database->execute();
    }
    public function deleteSubject($id) {
        // Cek ada atau tidak di database
        if(empty($this->getSubjectById($id))) {
            throw new Exception("Mata Kuliah tidak ditemukan");
        }

        // Hapus di tabel mata_kuliahs dan di junction jurusans_mata_kuliahs (db transaction)
        try {
            $this->database->beginTransaction();

            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $this->database->query($query);
            $this->database->bind("id", $id);
            $this->database->execute();

            $query = "DELETE FROM {$this->jurusan_mata_kuliah_table} WHERE id_mata_kuliah = :id_mata_kuliah";
            $this->database->query($query);
            $this->database->bind("id_mata_kuliah", $id);
            $this->database->execute();

            $this->database->commit();
        } catch (Exception $exception) {
            $this->database->rollback();
            throw $exception;
        }
    }

    public function updateSubject($data) {
        // Cek ada atau tidak di database
        if(empty($this->getSubjectById($data["id"]))) {
            throw new Exception("Mata Kuliah tidak ditemukan");
        }

        // Cek apakah ada kode itu? atau apakah kodenya sama dengan sebelumnya
        $result = $this->getSubjectByKode($data["kode"]);
        if(!empty($result)) {
            // Cek apakah kode dari database = kode dari data
            if($result[0]["id"] != $data["id"]) {
                throw new Exception("Kode Mata Kuliah sudah tersedia");
            }
        }
        
        $query = "UPDATE {$this->table} SET kode = :kode, nama = :nama, jumlah_sks = :jumlah_sks WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("kode", $data["kode"]);
        $this->database->bind("nama", $data["nama"]);
        $this->database->bind("jumlah_sks", $data["jumlah_sks"]);
        $this->database->bind("id", $data["id"]);

        $this->database->execute();
    }

    public function getSubjectByKode($kode) {
        $query = "SELECT * FROM {$this->table} WHERE kode = :kode";
        $this->database->query($query);

        $this->database->bind("kode", "$kode");

        return $this->database->resultSet();
    }

    public function getByMajor($id) {
        $this->database->query("SELECT mata_kuliahs.id FROM {$this->major_table} INNER JOIN {$this->jurusan_mata_kuliah_table} ON jurusans_mata_kuliahs.id_jurusan = jurusans.id INNER JOIN {$this->table} ON mata_kuliahs.id = jurusans_mata_kuliahs.id_mata_kuliah WHERE jurusans.id = '$id'");
        return $this->database->resultSet();
    }
}