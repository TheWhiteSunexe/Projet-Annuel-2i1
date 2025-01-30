<?php

namespace Middleware;
use models\User;

class AuthMiddleware {
    public static function checkLogin() {
        if (!User::isLoggedIn()) {
            header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
            exit();
        }
    }

    public static function checkAccess($requiredAccess) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role'])) {
            return false; 
        }

        if ($_SESSION['role'] == $requiredAccess) {
            return true;
        }

        // if ($_SESSION['role'] == 'admin') {
        //     return true;
        // }
        return false;
    }
}



