<?php

namespace Middleware;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/api/service.php';

class ProvidersMiddleware {


    public static function checkStatutProviders() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        checkProviders(); 

        
    }
}
