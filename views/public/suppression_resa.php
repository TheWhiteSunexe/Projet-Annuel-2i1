<?php
session_start();
if ($_SESSION['verif_f'] == 2 || $_SESSION['email'] == 'admin@guepstar.com') {
    include('includes/db.php');
    
    // Récupération des réservations liées à l'événement
    $q = 'SELECT id_user FROM reserve WHERE id_evenement = :id_evenement';
    $stmt = $bdd->prepare($q);
    $stmt->execute([':id_evenement' => $_GET['id']]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Remboursement des réservations
    foreach ($reservations as $reservation) {
        $q = 'UPDATE users SET credit = credit + 1 WHERE id = :id';
        $stmt = $bdd->prepare($q);
        $stmt->execute([
            'id' => $reservation['id_user'],
        ]);
    }

    // Suppression des réservations liées à l'événement
    $q = 'DELETE FROM reserve WHERE id_evenement = :id_evenement';
    $stmt = $bdd->prepare($q);
    $stmt->execute([':id_evenement' => $_GET['id']]);

    // Suppression de l'événement
    $q = 'DELETE FROM evenement WHERE id = :id';
    $stmt = $bdd->prepare($q);
    $stmt->execute([':id' => $_GET['id']]);

    header('location: reservation.php?message=La réservation a été annulée et les remboursements ont été effectués avec succès.&type=success');
    exit;
} else {
    header('location: index.php');
    exit;
}
?>
