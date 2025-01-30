<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email'] != 'administrateur@guepstar.com') {
    header('location: index.php');
    exit;
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    
    include_once 'includes/db.php';

    function deleteRelatedData($bdd, $tableName, $userIdColumn, $userId) {
        $q = "DELETE FROM $tableName WHERE $userIdColumn = ?";
        $stmt = $bdd->prepare($q);
        $stmt->execute([$userId]);
    }

    $tables = [
        'blocnote' => 'id_user',
        'card' => 'id_user',
        'reserve' => 'id_user',
        'review' => 'id_user',
        'transaction' => 'id_user'
    ];

    $userId = $_GET['id'];

    foreach ($tables as $tableName => $userIdColumn) {
        deleteRelatedData($bdd, $tableName, $userIdColumn, $userId);
    }

    $q = "DELETE FROM users WHERE id = ?";
    $stmt = $bdd->prepare($q);
    if($stmt->execute([$userId])) {
        header("location: Utilisateurs.php?message=L'utilisateur a été supprimé !");
        exit();
    } else {
        header("location: Utilisateurs.php?message=Oops! Une erreur s'est produite. Veuillez réessayer plus tard. !");
        exit();
    
    unset($stmt);
}

unset($bdd);

}
?>
