<?php

namespace Krispachi\KrisnaLTE\Middleware;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\Controller\AuthController;
use Krispachi\KrisnaLTE\Model\UserModel;

class AdminMiddleware implements Middleware {
    function before() : void {
        if(isset($_COOKIE["X-KRISNALTE-SESSION"])) {
            try {
                $jwt = $_COOKIE["X-KRISNALTE-SESSION"];
                $payload = JWT::decode($jwt, new Key(AuthController::$SECRET_KEY, "HS256"));
                $model = new UserModel();
                $role = $model->getRoleUserById($payload->user_id)["role"];
                if($role !== "admin") {
                    throw new Exception("User tidak admin");
                }
            } catch (Exception $exception) {
                http_response_code(404);
                echo "Page not found";
                exit(0);
            }
        } else {
            FlashMessage::setFlashMessage("error", "User harus login terlebih dahulu");
            header('Location: /login');
            exit(0);
        }
    }
}