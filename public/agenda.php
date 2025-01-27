<?php session_start(); 
/*if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: index.php');
    exit;
}*/?>
<!DOCTYPE HTML>
<html>

    <head>
        <title>Guepstar Formation</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device, initial-scale">
        <meta name="description" content="Site permettant de se former sur l'informatique">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="calendar/fonts/icomoon/style.css">
        <link href='calendar/fullcalendar/packages/core/main.css' rel='stylesheet' />
        <link href='calendar/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="calendar/css/bootstrap.min.css">
        <!-- Style -->
        <link rel="stylesheet" href="calendar/css/style.css">
        
        <?php
        if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
            echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
            echo '<link rel="stylesheet" type="text/css" href="css/style_agenda.css">';
        } else {
            echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
            echo '<link rel="stylesheet" type="text/css" href="css/style_agenda.css">';
        }
        ?>
    </head>

    <body>
        
        <?php include('includes/header.php'); ?>
        
        <main>
        <div class="content">
            <style>.button{weight:50px;}</style>
            <div id='calendar'></div>
        </div>
    
    

    <script src="calendar/js/jquery-3.3.1.min.js"></script>
    <script src="calendar/js/popper.min.js"></script>
    <script src="calendar/js/bootstrap.min.js"></script>

    <script src='calendar/fullcalendar/packages/core/main.js'></script>
    <script src='calendar/fullcalendar/packages/interaction/main.js'></script>
    <script src='calendar/fullcalendar/packages/daygrid/main.js'></script>
    <?php
include('includes/db.php');


// Préparer la commande SQL pour récupérer les id_evenement réservés par l'utilisateur
$sql = "SELECT id_evenement FROM reserve WHERE id_user = :id_user";
$req = $bdd->prepare($sql);
$req->execute([
    'id_user' => $_SESSION['id']
]);
$inscris = $req->fetchAll(PDO::FETCH_COLUMN, 0);

// Vérifier s'il y a des événements inscrits
if (!empty($inscris)) {
    // Convertir le tableau d'IDs en une chaîne de caractères séparée par des virgules
    $ids = implode(',', array_map('intval', $inscris));

    // Préparer la commande SQL pour récupérer les détails des événements
    $sql = "SELECT titre AS title, date AS start_date, TIME_FORMAT(heure_debut, '%H:%i') AS heure_debut, TIME_FORMAT(heure_fin, '%H:%i') AS heure_fin FROM evenement WHERE id IN ($ids)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    // Récupérer tous les événements
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Transformer les dates et heures en format correct pour FullCalendar
    foreach ($events as &$event) {
        $event['start'] = $event['start_date'] . 'T' . date("H:i", strtotime($event['heure_debut']));
        $event['end'] = $event['start_date'] . 'T' . date("H:i", strtotime($event['heure_fin']));
        unset($event['start_date'], $event['heure_debut'], $event['heure_fin']);
    }
} else {
    $events = [];
}

// Convertir les événements en JSON
$events_json = json_encode($events);
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                defaultDate: '2024-05-21',
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: <?php echo $events_json; ?> // Injecter les événements ici
            });

            calendar.render();
        });
    </script>

    <script src="calendar/js/main.js"></script>
        </main>
        <?php include('includes/footer.php'); ?>
    </body>
</html>      
  