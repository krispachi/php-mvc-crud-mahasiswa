<?php

namespace Krispachi\KrisnaLTE\Middleware;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Krispachi\KrisnaLTE\App\FlashMessage;
use Krispachi\KrisnaLTE\Controller\AuthController;

class GuestMiddleware implements Middleware {
    function before() : void {
        if(isset($_COOKIE["X-KRISNALTE-SESSION"])) {
            try {
                $jwt = $_COOKIE["X-KRISNALTE-SESSION"];
                JWT::decode($jwt, new Key(AuthController::$SECRET_KEY, "HS256"));
                FlashMessage::setFlashMessage("error", "User sudah login");
                header('Location: /');
                exit(0);
            } catch (Exception $exception) {
                // Jika ada exception = user belum login
            }
        }
    }
}