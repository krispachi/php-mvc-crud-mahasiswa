<?php

namespace Krispachi\KrisnaLTE\Controller;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\App\View;
use Krispachi\KrisnaLTE\Model\UserModel;

class AuthController {
    public static string $SECRET_KEY = "IniAdalahWebsiteYangDibuatOlehKrispachiYangLebihDikenalDenganNamaKrisna#NamaWebsiteIniKrisnaLTE#YangNamanyaDiambilDariAdminLTE:v";
    
    public function index() {
        View::render("auth/login");
    }

    public function signin() {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Validasi
        if(empty(trim($username)) || empty(trim($password))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            header("Location: /login");
            exit(0);
        }
        
        $model = new UserModel();
        $result = $model->authUser($username, $password);
        if(!empty($result)) {
            $payload = [
                "user_id" => $result["id"]
            ];
            // jwt token
            $jwt = JWT::encode($payload, self::$SECRET_KEY, "HS256");
            setcookie("X-KRISNALTE-SESSION", $jwt);
            
            FlashMessage::setFlashMessage("success", "Log In berhasil, Halo {$result['username']}");
            header("Location: /");
            exit(0);
        } else {
            FlashMessage::setFlashMessage("error", "Username / Password salah");
            header("Location: /login");
            exit(0);
        }
    }

    public function register() {
        View::render("auth/register");
    }

    public function signup() {
        $data = [
            "username" => $_POST["username"],
            "email" => $_POST["email"],
            "password" => $_POST["password"],
            "confirm_password" => $_POST["confirm_password"]
        ];

        if(empty(trim($data["username"])) || empty(trim($data["email"])) || empty(trim($data["password"])) || empty(trim($data["confirm_password"]))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /register");
            exit(0);
        }

        if($data["password"] != $data["confirm_password"]) {
            FlashMessage::setFlashMessage("error", "Konfirmasi password salah");
            $this->sendFormInput($data);
            header("Location: /register");
            exit(0);
        }

        $model = new UserModel();
        try {
            $model->createUser($data);
            FlashMessage::setFlashMessage("success", "Registrasi berhasil, Login untuk lanjut");
            header("Location: /login");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /register");
            exit(0);
        }
    }

    public function logout() {
        // cookie unset & ubah session_id (nanti)
        setcookie("X-KRISNALTE-SESSION", "");
        FlashMessage::setIfNotFlashMessage("success", "Log Out berhasil, Sampai jumpa");
        header("Location: /login");
        exit(0);
    }

    public function forgotPassword() {
        View::render("auth/forgot-password");
    }

    public function profile() {
        View::render("profile/index");
    }

    public function delete(int $id) {       
        $model = new UserModel();
        try {
            // Supaya tidak bisa ubah user lain
            $jwt = $_COOKIE["X-KRISNALTE-SESSION"];
            $payload = JWT::decode($jwt, new Key(AuthController::$SECRET_KEY, "HS256"));
            if($payload->user_id != $id) {
                throw new Exception("Tidak bisa mengganggu akun lain");
            }

            $model->deleteUser($id);
            FlashMessage::setIfNotFlashMessage("success", "Akun berhasil dihapus");
            header("Location: /logout");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            header("Location: /users");
            exit(0);
        }
    }

    public function edit(int $id) {
        $data = [
            "id" => $id,
            "username" => $_POST["username"],
            "email" => $_POST["email"]
        ];

        if(empty(trim($data["username"])) || empty(trim($data["email"]))) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /users");
            exit;
        }

        $model = new UserModel();
        try {
            // Supaya tidak bisa ubah user lain
            $jwt = $_COOKIE["X-KRISNALTE-SESSION"];
            $payload = JWT::decode($jwt, new Key(AuthController::$SECRET_KEY, "HS256"));
            if($payload->user_id != $id) {
                throw new Exception("Tidak bisa mengganggu akun lain");
            }
            
            $model->updateUser($data);
            FlashMessage::setFlashMessage("success", "User berhasil diubah");
            header("Location: /users");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /users");
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