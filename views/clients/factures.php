<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/middlewares/AuthMiddleware.php';
if (!Middleware\AuthMiddleware::checkAccess('clients')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('../includes/head.php'); ?>
<body>
    <?php include('includes/header.php'); ?>
    <main class="container mt-5">
        <h2>Mes Factures</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody id="facturesBody"></tbody>
        </table>
    </main>
    <script>
        fetch('../../api/factures/get_factures.php')
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('facturesBody');
                data.forEach(f => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${f.issued_date}</td>
                            <td>${f.amount} €</td>
                            <td>${f.description}</td>
                            <td>${f.status}</td>
                            <td><a href="/Projet-Annuel-2i1/PA2i1/${f.pdf_path}" download>Télécharger</a></td>
                        </tr>`;
                });
            });
    </script>
</body>
</html>
