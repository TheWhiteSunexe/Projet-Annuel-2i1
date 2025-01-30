<?php

namespace Models;

class User {

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];

        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['role']);
    }
}
