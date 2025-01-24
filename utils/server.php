<?php

function returnError ($code, $message) {
    echo json_encode(["error" => $message]);
    http_response_code($code);
    die();
}

function getBody() {
    return json_decode(
        file_get_contents("php://input"), true
    );
}

function verifyMandatoryParams($array, $mandatoryParams): bool {
    foreach ($mandatoryParams as $param) {
        if (empty($array[$param])) {
            return false;
        }
    }
    return true;
}

function verifyPositiveInteger($value): bool {
    return intval($value) > 0;
}

function returnSuccess($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data);
}

function methodIsAllowed($action): bool {
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($action) {
        case 'update';
            return $method == 'PATCH';
        case 'create':
            return $method == 'PUT';
        case 'read':
            return $method == 'GET';
        case 'delete':
            return $method == 'DELETE';
        case 'login':
            return $method == 'POST';
        default:
            return false;
    }
}