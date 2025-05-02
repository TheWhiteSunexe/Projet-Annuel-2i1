<?php

namespace Middleware;
use models\User;
use DateTime;
use Exception;


class SubMiddleware {

    public static function checkSubscriptionValidity($subscription, $exp_date_subscription) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (empty($subscription) || empty($exp_date_subscription)) {
            return false;
        }
    
        $now = new DateTime();
        $expDate = DateTime::createFromFormat('Y-m-d', $exp_date_subscription);
    
        if (!$expDate || $expDate < $now) {
            return false;
        }
    
        return true;
    }
    
}



