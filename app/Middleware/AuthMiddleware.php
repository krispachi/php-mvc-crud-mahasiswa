<?php

namespace Krispachi\KrisnaLTE\Middleware;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\Controller\AuthController;
use Krispachi\KrisnaLTE\Model\UserModel;

class AuthMiddleware implements Middleware {
    function before() : void {
        if(isset($_COOKIE["X-KRISNALTE-SESSION"])) {
            try {
                $jwt = $_COOKIE["X-KRISNALTE-SESSION"];
                $payload = JWT::decode($jwt, new Key(AuthController::$SECRET_KEY, "HS256"));
                $model = new UserModel();
                if(empty($model->getUserById($payload->user_id))) {
                    throw new Exception("User tidak ditemukan");
                }
            } catch (Exception $exception) {
                FlashMessage::setIfNotFlashMessage("error", $exception->getMessage());
                setcookie("X-KRISNALTE-SESSION", "");
                header('Location: /login');
                exit(0);
            }
        } else {
            FlashMessage::setFlashMessage("error", "User harus login terlebih dahulu");
            header('Location: /login');
            exit(0);
        }
    }
}