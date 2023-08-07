<?php

require_once __DIR__ . "/../vendor/autoload.php";

session_start();

use Krispachi\KrisnaLTE\App\Router;
use Krispachi\KrisnaLTE\Controller\AuthController;
use Krispachi\KrisnaLTE\Controller\MahasiswaController;
use Krispachi\KrisnaLTE\Middleware\AuthMiddleware;
use Krispachi\KrisnaLTE\Middleware\GuestMiddleware;

Router::add("GET", "/login", AuthController::class, "index", [GuestMiddleware::class]);
Router::add("POST", "/login", AuthController::class, "signin", [GuestMiddleware::class]);
Router::add("GET", "/register", AuthController::class, "register", [GuestMiddleware::class]);
Router::add("POST", "/register", AuthController::class, "signup", [GuestMiddleware::class]);
Router::add("GET", "/forgot-password", AuthController::class, "forgotPassword", [GuestMiddleware::class]);
Router::add("GET", "/logout", AuthController::class, "logout", [AuthMiddleware::class]);

Router::add("GET", "/", MahasiswaController::class, "index", [AuthMiddleware::class]);
Router::add("GET", "/mahasiswas/create", MahasiswaController::class, "create", [AuthMiddleware::class]);
Router::add("POST", "/mahasiswas/create", MahasiswaController::class, "store", [AuthMiddleware::class]);
Router::add("GET", "/mahasiswas/update/([0-9a-zA-Z]*)", MahasiswaController::class, "update", [AuthMiddleware::class]);
Router::add("POST", "/mahasiswas/update/([0-9a-zA-Z]*)", MahasiswaController::class, "edit", [AuthMiddleware::class]);
Router::add("POST", "/mahasiswas/delete/([0-9a-zA-Z]*)", MahasiswaController::class, "delete", [AuthMiddleware::class]);

Router::add("GET", "/users", AuthController::class, "profile", [AuthMiddleware::class]);
Router::add("POST", "/users/update/([0-9a-zA-Z]*)", AuthController::class, "edit", [AuthMiddleware::class]);
Router::add("POST", "/users/delete/([0-9a-zA-Z]*)", AuthController::class, "delete", [AuthMiddleware::class]);

Router::run();