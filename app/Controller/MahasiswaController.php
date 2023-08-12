<?php

namespace Krispachi\KrisnaLTE\Controller;

use Exception;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\App\View;
use Krispachi\KrisnaLTE\Model\MahasiswaModel;
use Krispachi\KrisnaLTE\Model\MajorModel;
use Krispachi\KrisnaLTE\Model\SubjectModel;

class MahasiswaController {
    public function index() {
        $model = new MahasiswaModel();
        View::render("dashboard", $model->getAllMahasiswa());
    }

    public function create() {
        $model = new MajorModel();
        View::render("mahasiswa/create", $model->getAllMajor());
    }

    public function store() {
        $data = [
            "nim" => $_POST["nim"],
            "nama" => $_POST["nama"],
            "id_jurusan" => $_POST["id_jurusan"],
            "alamat" => $_POST["alamat"],
            "telepon" => $_POST["telepon"]
        ];

        if(empty(trim($data["nim"])) || empty(trim($data["nama"])) || empty(trim($data["alamat"])) || empty(trim($data["telepon"])) || empty(trim($data["id_jurusan"]))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /mahasiswas/create");
            exit(0);
        }

        $model = new MahasiswaModel();
        try {
            $model->createMahasiswa($data);
            FlashMessage::setFlashMessage("success", "Mahasiswa berhasil ditambah");
            header("Location: /");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /mahasiswas/create");
            exit(0);
        }
    }

    public function update($id) {
        $result = [];
        $model = new MahasiswaModel();
        $result += [
            "mahasiswa" => $model->getMahasiswaById($id)
        ];
        if(empty($result["mahasiswa"])) {
            FlashMessage::setFlashMessage("error", "Mahasiswa tidak ditemukan");
            header("Location: /");
            exit(0);
        }
        $model = new MajorModel();
        $result += [
            "majors" => $model->getAllMajor()
        ];
        View::render("mahasiswa/update", $result);
    }

    public function edit($id) {
        $data = [
            "id" => $id,
            "nim" => $_POST["nim"],
            "nama" => $_POST["nama"],
            "id_jurusan" => $_POST["id_jurusan"],
            "alamat" => $_POST["alamat"],
            "telepon" => $_POST["telepon"]
        ];

        if(empty(trim($data["nim"])) || empty(trim($data["nama"])) || empty(trim($data["alamat"])) || empty(trim($data["telepon"])) || empty(trim($data["id_jurusan"]))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /mahasiswas/update/{$id}");
            exit(0);
        }

        $model = new MahasiswaModel();
        try {
            $model->updateMahasiswa($data);
            FlashMessage::setFlashMessage("success", "Mahasiswa berhasil diubah");
            header("Location: /");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /mahasiswas/update/{$id}");
            exit(0);
        }
    }

    public function delete($id) {
        $model = new MahasiswaModel();
        try {
            $model->deleteMahasiswa($id);
            FlashMessage::setFlashMessage("success", "Mahasiswa berhasil dihapus");
            header("Location: /");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            header("Location: /mahasiswas/create");
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