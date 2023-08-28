<?php

require_once __DIR__ . "/../vendor/autoload.php";

session_start();

use Krispachi\KrisnaLTE\App\Router;
use Krispachi\KrisnaLTE\Controller\AuthController;
use Krispachi\KrisnaLTE\Middleware\AuthMiddleware;
use Krispachi\KrisnaLTE\Middleware\GuestMiddleware;
use Krispachi\KrisnaLTE\Controller\SubjectController;
use Krispachi\KrisnaLTE\Controller\MahasiswaController;
use Krispachi\KrisnaLTE\Controller\MajorController;
use Krispachi\KrisnaLTE\Middleware\AdminMiddleware;
use Krispachi\KrisnaLTE\Middleware\PetugasPendaftaranMiddleware;

Router::add("GET", "/login", AuthController::class, "index", [GuestMiddleware::class]);
Router::add("POST", "/login", AuthController::class, "signin", [GuestMiddleware::class]);
Router::add("GET", "/register", AuthController::class, "register", [GuestMiddleware::class]);
Router::add("POST", "/register", AuthController::class, "signup", [GuestMiddleware::class]);
Router::add("GET", "/forgot-password", AuthController::class, "forgotPassword", [GuestMiddleware::class]);
Router::add("GET", "/logout", AuthController::class, "logout", [AuthMiddleware::class]);

Router::add("GET", "/", MahasiswaController::class, "index", [AuthMiddleware::class]);
Router::add("GET", "/mahasiswas/create", MahasiswaController::class, "create", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("POST", "/mahasiswas/create", MahasiswaController::class, "store", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("GET", "/mahasiswas/update/([0-9a-zA-Z]*)", MahasiswaController::class, "update", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("POST", "/mahasiswas/update/([0-9a-zA-Z]*)", MahasiswaController::class, "edit", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);
Router::add("POST", "/mahasiswas/delete/([0-9a-zA-Z]*)", MahasiswaController::class, "delete", [AuthMiddleware::class, PetugasPendaftaranMiddleware::class]);

Router::add("GET", "/users", AuthController::class, "profile", [AuthMiddleware::class]);
Router::add("POST", "/users/update/([0-9a-zA-Z]*)", AuthController::class, "edit", [AuthMiddleware::class]);
Router::add("POST", "/users/delete/([0-9a-zA-Z]*)", AuthController::class, "delete", [AuthMiddleware::class]);

Router::add("GET", "/subjects", SubjectController::class, "index", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/subjects", SubjectController::class, "store", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("GET", "/subjects/([0-9a-zA-Z]*)", SubjectController::class, "subject", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/subjects/([0-9a-zA-Z]*)", SubjectController::class, "edit", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/subjects/delete/([0-9a-zA-Z]*)", SubjectController::class, "delete", [AuthMiddleware::class, AdminMiddleware::class]);

Router::add("GET", "/majors", MajorController::class, "index", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/majors", MajorController::class, "store", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("GET", "/majors/([0-9a-zA-Z]*)", MajorController::class, "major", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/majors/delete/([0-9a-zA-Z]*)", MajorController::class, "delete", [AuthMiddleware::class, AdminMiddleware::class]);
Router::add("POST", "/majors/([0-9a-zA-Z]*)", MajorController::class, "edit", [AuthMiddleware::class, AdminMiddleware::class]);

Router::run();