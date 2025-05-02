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
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('../includes/head.php'); ?>
<body>
  <?php include('includes/header.php'); ?>
  <main>
        <h2>Gestion des employés</h2>
        <div id="message"></div>

        <form id="addEmployeeForm">
            <label>Nom :</label>
            <input type="text" id="name" required>

            <label>Prénom :</label>
            <input type="text" id="firstname" required>

            <label>Email :</label>
            <input type="email" id="email" required>

            <button type="submit">Ajouter un employé</button>
        </form>

        <div id="result">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="employeesTableBody"></tbody>
            </table>
        </div>
  </main>
</body>
<script src="script/employees.js"></script>
</html>
