<?php
namespace Krispachi\KrisnaLTE\App;

class FlashMessage {
    public static function setFlashMessage($status, $message) {
        unset($_SESSION["flashMessage"]);
        $_SESSION["flashMessage"] = [
            "status" => $status,
            "message" => $message
        ];
    }

    public static function flashMessage() {
        if(isset($_SESSION["flashMessage"])) {
            echo "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: '" . $_SESSION["flashMessage"]["status"] . "',
                    title: '" . $_SESSION["flashMessage"]["message"] . "'
                });
            </script>";
            unset($_SESSION["flashMessage"]);
        }
    }

    public static function setIfNotFlashMessage($status, $message) {
        if(!isset($_SESSION["flashMessage"])) {
            $_SESSION["flashMessage"] = [
                "status" => $status,
                "message" => $message
            ];
        }
    }
}