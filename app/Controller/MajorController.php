<?php

namespace Krispachi\KrisnaLTE\Controller;

use Exception;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\App\View;
use Krispachi\KrisnaLTE\Model\MajorModel;
use Krispachi\KrisnaLTE\Model\SubjectModel;

class MajorController {
    public function index() {
        $model = [];
        $result = new MajorModel();        
        $model += [
            "majors" => $result->getAllMajor()
        ];
        $result = new SubjectModel();
        $model += [
            "subjects" => $result->getAllSubject()
        ];
        
        View::render("major/index", $model);
    }

    public function major($id) {
        $result = [];
        $model = new MajorModel();
        $result = $model->getMajorById($id);
        $model = new SubjectModel();
        $result += [
            "mata_kuliahs" => $model->getByMajor($id)
        ];

        if(!empty($result)) {
            echo json_encode($result);
            exit(0);
        } else {
            echo json_encode(["error" => "empty"]);
            exit(0);
        }
    }

    public function store() {
        // Check post value        
        $data = [
            "nama" => $_POST["nama"],
            "mata_kuliahs" => $_POST["mata_kuliahs"] ?? null
        ];

        // Return back with error if empty or null
        if(empty(trim($data["nama"])) || empty($data["mata_kuliahs"])) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /majors");
            exit(0);
        }

        // Insert into jurusans and junction (db transaction)
        try {
            $model = new MajorModel();
            $model->createMajor($data);
            
            FlashMessage::setFlashMessage("success", "Jurusan berhasil ditambah");
            header("Location: /majors");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /majors");
            exit(0);
        }
    }

    // Delete jurusan di tabel jurusans dan jurusans_mata_kuliahs
    public function delete($id) {
        $model = new MajorModel();
        try {
            $model->deleteMajor($id);
            FlashMessage::setFlashMessage("success", "Jurusan berhasil dihapus");
            header("Location: /majors");
            exit(0);
        } catch (Exception $exception) {
            if(preg_match("/23000/", $exception->getMessage())) {
                $message = "Hapus dibatalkan, data terdaftar sebagai Foreign Key di tabel lain";
            } else {
                $message = $exception->getMessage();
            }
            FlashMessage::setFlashMessage("error", $message);
            header("Location: /majors");
            exit(0);
        }
    }

    public function edit($id) {
        $data = [
            "id" => $id,
            "nama" => $_POST["nama"],
            "mata_kuliahs" => $_POST["mata_kuliahs"] ?? null
        ];

        if(empty(trim($data["nama"])) || empty($data["mata_kuliahs"])) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            header("Location: /majors");
            exit(0);
        }

        $model = new MajorModel();
        try {
            $model->updateMajor($data);
            FlashMessage::setFlashMessage("success", "Jurusan berhasil diubah");
            header("Location: /majors");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            header("Location: /majors");
            exit(0);
        }
    }

    public function sendFormInput(array $data) : void {
        $_SESSION["form-input"] = [];
        foreach($data as $key => $input) {
            if(gettype($input) == "array") {
                if(!empty($input)) {
                    $_SESSION["form-input"] += [
                        "$key" => $input
                    ];
                }
            } else if(!empty(trim($input))) {
                $_SESSION["form-input"] += [
                    "$key" => trim($input)
                ];
            }
        }
    }
}