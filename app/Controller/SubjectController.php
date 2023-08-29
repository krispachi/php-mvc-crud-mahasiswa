<?php

namespace Krispachi\KrisnaLTE\Controller;

use Exception;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\App\View;
use Krispachi\KrisnaLTE\Model\SubjectModel;

class SubjectController {
    public function index() {
        $model = new SubjectModel();
        View::render("subject/index", $model->getAllSubject());
    }

    public function subject($id) {
        $model = new SubjectModel();
        $result = $model->getSubjectById($id);
        if(!empty($result)) {
            echo json_encode($result);
            exit(0);
        } else {
            echo json_encode(["error" => "empty"]);
            exit(0);
        }
    }

    public function store() {
        $data = [
            "kode" => $_POST["kode"],
            "nama" => $_POST["nama"],
            "jumlah_sks" => $_POST["jumlah_sks"]
        ];

        if(empty(trim($data["kode"])) || empty(trim($data["nama"])) || empty(trim($data["jumlah_sks"]))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /subjects");
            exit(0);
        }

        $model = new SubjectModel();
        try {
            $model->createSubject($data);
            FlashMessage::setFlashMessage("success", "Mata Kuliah berhasil ditambah");
            header("Location: /subjects");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /subjects");
            exit(0);
        }
    }

    public function edit($id) {
        $data = [
            "id" => $id,
            "kode" => $_POST["kode"],
            "nama" => $_POST["nama"],
            "jumlah_sks" => $_POST["jumlah_sks"]
        ];

        if(empty(trim($data["kode"])) || empty(trim($data["nama"])) || empty(trim($data["jumlah_sks"]))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            // Sengaja tidak isi return with input supaya tidak KACHAW
            header("Location: /subjects");
            exit(0);
        }

        $model = new SubjectModel();
        try {
            $model->updateSubject($data);
            FlashMessage::setFlashMessage("success", "Mata Kuliah berhasil diubah");
            header("Location: /subjects");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            header("Location: /subjects");
            exit(0);
        }
    }

    public function delete($id) {
        $model = new SubjectModel();
        try {
            $model->deleteSubject($id);
            FlashMessage::setFlashMessage("success", "Mata Kuliah berhasil dihapus");
            header("Location: /subjects");
            exit(0);
        } catch (Exception $exception) {
            if(preg_match("/23000/", $exception->getMessage())) {
                $message = "Hapus dibatalkan, data terdaftar sebagai Foreign Key di tabel lain";
            } else {
                $message = $exception->getMessage();
            }
            FlashMessage::setFlashMessage("error", $message);
            header("Location: /subjects");
            exit(0);
        }
    }

    public function sendFormInput(array $data) : void {
        $_SESSION["form-input"] = [];
        foreach($data as $key => $input) {
            if(!empty(trim($input))) {
                $_SESSION["form-input"] += [
                    "$key" => trim($input)
                ];
            }
        }
    }
}