<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/middlewares/AuthMiddleware.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/models/UserModel.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/Controllers/AuthController.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/routes/web.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use Middleware\AuthMiddleware;
use Controllers\AuthController;
if (!AuthMiddleware::checkAccess('employees')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

// $router->dispatch();
?>
<!DOCTYPE HTML>

<html>

<?php include('includes/headForum.php'); ?>
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
                                <button style="width: 125px;height: 55px;"type="submit">Changer</button>
                            </form>
                        </div>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                        <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" style="width: 100%;">
                        <?php
                            include('../../utils/database.php');

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
                                <button style="width: 125px;height: 55px;"type="submit">Changer</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div id="forum-container">
                        <p>Chargement des sujets...</p>
                    </div>              
                    </div>
                    <!-- Sidebar content -->
                    <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                    <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;"></div><div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 85px;"><div class="sticky-inner">
                        <a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="new_question.php">Ask Question</a>
                        <div class="bg-white mb-3">
                            <h4 class="px-3 py-4 op-5 m-0">
                                Sujets actif
                            </h4>
                        
                        <div id="messages-container">
                            <p>Chargement des sujets...</p>
                        </div>


                        <hr class="m-0">
                        </div>
                        <div class="bg-white text-sm">
                        <h4 class="px-3 py-4 op-5 m-0 roboto-bold">
                            Stats
                        </h4>
                        <hr class="my-0">
                        <div id="stats-container">
                            <p>Chargement des statistiques...</p>
                        </div>
                        <!-- <div class="row text-center d-flex flex-row op-7 mx-0">
                            <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#"><?php echo $total_topics; ?></a> Sujets </div>
                            <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $total_messages; ?></a> Posts </div>
                        </div>

                        <div class="row d-flex flex-row op-7">
                            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $total_users; ?></a> Membres </div>
                            <div class="col-sm-6 flex-ew text-center py-3 mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $last_user_name; ?></a> Dernier membre </div>
                        </div> -->

                        </div>
                    </div></div>
                    </div>
                </div>
            </div>
        </main>
    </body>

</html>