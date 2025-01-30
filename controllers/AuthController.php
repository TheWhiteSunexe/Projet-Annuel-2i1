<?php

namespace Controllers;

use models\User;
use middleware\AuthMiddleware;

class AuthController {

    public function showLogin() {
        include 'Views/login.php'; 
    }

    public function logout() {
        AuthMiddleware::checkLogin();
        
        User::logout();
        header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
        exit();
    }
}
