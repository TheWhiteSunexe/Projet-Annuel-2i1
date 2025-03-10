<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/ChatDAO.php';

function containsBadWords($text) {
    $badWords = [
        'connard',
        'salope',
        'enculé',
        'merde',
        'putain',
        'niquer',
        'bâtard',
        'conne',
        'trouduc',
        'gros con',
        'sale pute',
        'connasse',
        'feignasse',
        'idiot',
        'crétin',
        'abruti',
        'pédé',
        'pd',
        'salopard',
        'sale racaille',
        'gouine'
    ];
    
    foreach ($badWords as $badWord) {
        if (stripos($text, $badWord) !== false) {
            return true;
        }
    }
    return false;
}

function processMessage( $conversationId, $userId, $content) {
    $visible = containsBadWords($content) ? 0 : 1;
    return addMessage( $conversationId, $userId, $content, $visible);
}
?>
