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
if (!AuthMiddleware::checkAccess('clients')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

// $router->dispatch();
?>
<!DOCTYPE html>
<html lang="fr">

<?php include('../includes/head.php'); ?>

<body>
  <?php include('includes/header.php'); ?>

  <main>
        
        <div>
                       
            <div id="result">
            <table class="table table-striped mt-4">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                
                <?php
                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td>' . $user['nom'] . '</td>';
                    echo '<td>' . $user['prenom'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '<td>
                        <a class="btn btn-primary btn-sm" href="../edit.php?id=' . $user['id'] . '">Modifier</a>
                        <a class="btn btn-danger btn-sm" href="../delete.php?id=' . $user['id'] . '">Supprimer</a>
                        </td>';                    
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>

        </div>
  </main>

</body>

</html>