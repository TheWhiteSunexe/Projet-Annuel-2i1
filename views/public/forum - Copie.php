<?php 
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: index.php');
    exit;
}?>
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
    <?php
    if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
        echo '<link rel="stylesheet" type="text/css" href="css/style_nightmode.css">';
        echo '<link rel="stylesheet" type="text/css" href="css/style_forum.css">';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
        echo '<link rel="stylesheet" type="text/css" href="css/style_forum.css">';
    }
    ?>
</head>

<?php
if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
        echo '<body style="background-color :#353535;">';
    } else {
        echo '<body>';
    }?>
    
        
        <?php include('includes/header.php'); ?>

        <main>
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
        <br><br>
            <div class="container">
                <div class="row">
                    <!-- Main content -->
                    <div class="col-lg-9 mb-3">
                    <div class="row text-left mb-5">
                        <div class="col-lg-6 mb-3 mb-sm-0">
                        <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">
                       
                            <form action="forum.php" method="post">
                                    
                                    <select style="margin:0px;padding:10px; width:50%; display: inline "name="catégorie" style="weigth:20px" class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" data-toggle="select" tabindex="-98">
                                    <option value="14" selected> Catégories </option>
                                    <option value="1"> Annonces </option>
                                    <option value="2"> Discussions Générales </option>
                                    <option value="3"> Support Technique </option>
                                    <option value="4"> Technologie </option>
                                    <option value="5"> Programmation </option>
                                    <option value="6"> Divertissement </option>
                                    <option value="7"> Santé et Bien-être </option>
                                    <option value="8"> Voyages </option>
                                    <option value="9"> Cuisine </option>
                                    <option value="10"> Événements </option>
                                    <option value="11"> Art </option>
                                    <option value="12"> Carrière et Emploi </option>
                                    <option value="13"> Cours </option>

                                </select>
                                <button style="width: 125px;height: 65px;"type="submit">Changer</button>
                            </form>
                        </div>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                        <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" style="width: 100%;">
                        <?php
                            include('includes/db.php');

                            $query = '';
                            $query_hashtag = '';
                            
                            if(!empty(isset($_POST['trier'])) && $_POST['trier']!=1 || isset($_POST['catégorie']) && ($_POST['catégorie'] != 14)){

                                if(isset($_POST['catégorie']) && $_POST['catégorie'] == 1){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 1)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 2){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 2)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 3){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 3)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 4){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 4)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 5){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 5)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 6){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 6)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 7){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 7)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 8){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 8)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 9){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 9)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 10){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 10)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 11){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 11)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 12){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 12)";
                                }
                                elseif(isset($_POST['catégorie']) && $_POST['catégorie'] == 13){
                                    $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages WHERE message_id = (SELECT id_message FROM concerne WHERE id_hashtag = 13)";
                                }
                                
                                if(!empty($_POST['trier']) && isset($_POST['trier']) && $_POST['trier']!=1 ){

                                    if($_POST['trier'] == 2){
                                        $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages ORDER BY titre ASC";
                                    }
                                    elseif($_POST['trier'] == 3){
                                        $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages ORDER BY titre DESC";
                                    }
                                    
                                    elseif($_POST['trier'] == 4){
                                        $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages ORDER BY date_creation DESC";
                                    }
                                    elseif($_POST['trier'] == 5){
                                        $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages ORDER BY date_creation ASC";
                                    }
                                }

                            }else {
                                // Par défaut
                                $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages ORDER BY titre DESC";
                            }
                            

                        ?>
                            <form action="forum.php" method="post">
                                <select style="margin:0px;padding:10px; width:50%; display: inline "name="trier" style="weigth:20px" class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" data-toggle="select" tabindex="-98">
                                    <option value="1" selected> Trier par </option>
                                    <option value="2"> titre (croissant) </option>
                                    <option value="3"> titre (decroissant) </option>
                                    <option value="4"> date (croissant)</option>
                                    <option value="5"> date (decroissant)</option>
                                </select>
                                <button style="width: 125px;height: 65px;"type="submit">Changer</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    <?php
                    // Inclure le fichier de configuration de la base de données
                    include('includes/db.php');

                    // Requête pour récupérer les informations de l'événement depuis la base de données
                    
                    $result = $bdd->query($query);

                    // Vérifier s'il y a des résultats
                    if ($result->rowCount() > 0) {
                        // Parcourir les résultats
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            // Récupérer les données de l'événement
                            $titre = $row['titre'];
                            $date_creation = $row['date_creation'];
                            $utilisateur_id = $row['utilisateur_id'];
                            $message_id = $row['message_id'];
                            // Requête pour récupérer le nom de l'utilisateur à partir de son ID
                            $user_query = "SELECT nom, prenom FROM users WHERE id = :utilisateur_id";
                            $user_stmt = $bdd->prepare($user_query);
                            $user_stmt->execute([
                                'utilisateur_id' => $utilisateur_id
                            ]);
                            $user_row = $user_stmt->fetch(PDO::FETCH_ASSOC);
                            $nom_utilisateur = $user_row['nom'];
                            $prenom_utilisateur = $user_row['prenom'];

                            // Formater la date
                            $date_formattee = date('d/m/Y', strtotime($date_creation));
                            if (date('Y-m-d') === date('Y-m-d', strtotime($date_creation))) {
                                $date_formattee = date('H:i', strtotime($date_creation));
                            }
                            
                            // Requête pour le nombre de messages par sujet
                            $query_messages = "SELECT COUNT(*) AS total_messages FROM forum_commentaires where message_id =:id";
                            $result_messages = $bdd->prepare($query_messages);
                            $result_messages->execute([
                                'id' => $message_id
                            ]);

                            $nb_messages = $result_messages->fetch(PDO::FETCH_ASSOC)['total_messages'];

                            $query_topics = "SELECT COUNT(*) AS nb_see FROM visite WHERE id_message={$message_id}";
                            $result_topics = $bdd->query($query_topics);
                            $nb_see = $result_topics->fetch(PDO::FETCH_ASSOC)['nb_see'];

                            
                            include('includes/db.php');
                            $query_hashtag ='SELECT name FROM hashtags WHERE id IN (SELECT id_hashtag FROM concerne WHERE id_message = :id_message )';
                            
                            $req_hashtag = $bdd->prepare($query_hashtag);
                            $req_hashtag->execute(['id_message' => $message_id]);
                            // Affichage des informations de l'événement
                            echo '
                            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-success border-top-0 border-right-0 border-bottom-0 rounded-0">
                                <div class="row align-items-center">
                                    <div class="col-md-8 mb-3 mb-sm-0">
                                        <h5>
                                            <a href="message.php?id=' . $message_id . '" class="text-primary">' . $titre . '</a>
                                        </h5>
                                        <p class="text-sm"><span class="op-6">Posted</span> <a class="text-black" href="#">' . $date_formattee . '</a> <span class="op-6">ago by</span> <a class="text-black" href="#">' . $nom_utilisateur . ' ' . $prenom_utilisateur . '</a></p>';
                                        if ($req_hashtag->rowCount() > 0) {
                                            echo '<div class="text-sm op-5">';
                                            while ($row = $req_hashtag->fetch(PDO::FETCH_ASSOC)) { 
                                                echo '<a class="text-black mr-2" href="#">  #' . htmlspecialchars($row['name']) .'</a>';
                                            }
                                            echo '</div>';
                                        } else {
                                            echo '';
                                        }
                                        echo '
                                    </div>
                                    <div class="col-md-4 op-7">
                                        <div class="row text-center op-7">
                                            <div class="col px-1"> <i class="ion-ios-chatboxes-outline icon-1x"></i> <span class="d-block text-sm">'.$nb_messages.' Replys</span> </div>
                                            <div class="col px-1"> <i class="ion-ios-eye-outline icon-1x"></i> <span class="d-block text-sm">'.$nb_see.' Views</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                        }
                    }
                    ?>              
                    </div>
                    <!-- Sidebar content -->
                    <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                    <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;"></div><div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 85px;"><div class="sticky-inner">
                        <a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="new_question.php">Ask Question</a>
                        <div class="bg-white mb-3">
                        <h4 class="px-3 py-4 op-5 m-0">
                            Sujets actif
                        </h4>
                        
                        <?php
                        // Inclure le fichier de configuration de la base de données
                        include('includes/db.php');


                        // Requête pour récupérer les informations des messages du forum depuis la base de données
                        $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM forum_messages ORDER BY date_creation DESC LIMIT 5";
                        $result = $bdd->query($query);

                        // Vérifier s'il y a des résultats
                        if ($result->rowCount() > 0) {
                            // Parcourir les résultats
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                // Récupérer les données du message
                                $titre = htmlspecialchars($row['titre']);
                                $date_creation = $row['date_creation'];
                                $utilisateur_id = $row['utilisateur_id'];
                                $message_id = $row['message_id'];

                                // Requête pour récupérer le nom de l'utilisateur à partir de son ID
                                $user_query = "SELECT nom, prenom FROM users WHERE id = :utilisateur_id";
                                $user_stmt = $bdd->prepare($user_query);
                                $user_stmt->execute(['utilisateur_id' => $utilisateur_id]);
                                $user_row = $user_stmt->fetch(PDO::FETCH_ASSOC);
                                $nom_utilisateur = htmlspecialchars($user_row['nom']);
                                $prenom_utilisateur = htmlspecialchars($user_row['prenom']);

                                // Formater la date
                                $date_formattee = date('d/m/Y', strtotime($date_creation));
                                if (date('Y-m-d') === date('Y-m-d', strtotime($date_creation))) {
                                    $date_formattee = date('H:i', strtotime($date_creation));
                                }

                                // Affichage des informations du message
                                echo '
                                <hr class="m-0">
                                <div class="pos-relative px-3 py-3">
                                    <h6 class="text-primary text-sm">
                                        <a href="message.php?id=' . $message_id . '" class="text-primary">' . $titre . '</a>
                                    </h6>
                                    <p class="mb-0 text-sm"><span class="op-6">Posté</span> <a class="text-black" href="#">' . $date_formattee . '</a> <span class="op-6">par</span> <a class="text-black" href="user.php?id=' . $utilisateur_id . '">' . $prenom_utilisateur . ' ' . $nom_utilisateur . '</a></p>
                                </div>';
                            }
                        } else {
                            echo '<p>Aucun message trouvé.</p>';
                        }
                        ?>

                        <hr class="m-0">
                        </div>
                        <div class="bg-white text-sm">
                        <h4 class="px-3 py-4 op-5 m-0 roboto-bold">
                            Stats
                        </h4>
                        <hr class="my-0">
                        <?php
                        // Inclure le fichier de configuration de la base de données
                        include('includes/db.php');
                        // Requête pour le nombre de sujets
                        $query_topics = "SELECT COUNT(*) AS total_topics FROM forum_messages";
                        $result_topics = $bdd->query($query_topics);
                        $total_topics = $result_topics->fetch(PDO::FETCH_ASSOC)['total_topics'];

                        // Requête pour le nombre de messages
                        $query_messages = "SELECT COUNT(*) AS total_messages FROM forum_commentaires";
                        $result_messages = $bdd->query($query_messages);
                        $total_messages = $result_messages->fetch(PDO::FETCH_ASSOC)['total_messages'];

                        // Requête pour le nombre d'utilisateurs
                        $query_users = "SELECT COUNT(*) AS total_users FROM users";
                        $result_users = $bdd->query($query_users);
                        $total_users = $result_users->fetch(PDO::FETCH_ASSOC)['total_users'];

                        // Requête pour le nom du dernier utilisateur inscrit
                        $query_last_user = "SELECT nom, prenom FROM users ORDER BY date_insc DESC LIMIT 1";
                        $result_last_user = $bdd->query($query_last_user);
                        $last_user = $result_last_user->fetch(PDO::FETCH_ASSOC);
                        $last_user_name = htmlspecialchars($last_user['prenom'] . ' ' . $last_user['nom']);

                        // Fermeture de la connexion
                        $bdd = null;
                        ?>
                        <div class="row text-center d-flex flex-row op-7 mx-0">
                            <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#"><?php echo $total_topics; ?></a> Sujets </div>
                            <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $total_messages; ?></a> Posts </div>
                        </div>

                        <div class="row d-flex flex-row op-7">
                            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $total_users; ?></a> Membres </div>
                            <div class="col-sm-6 flex-ew text-center py-3 mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $last_user_name; ?></a> Dernier membre </div>
                        </div>

                        </div>
                    </div></div>
                    </div>
                </div>
            </div>
        </main>

        <?php include('includes/footer.php'); ?>
    </body>

</html>