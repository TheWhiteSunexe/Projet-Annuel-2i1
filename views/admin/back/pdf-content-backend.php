<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        /* Style du tableau */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

/* Style des en-têtes de colonnes */
th {
    background-color: #f2f2f2;
    color: #333;
    font-weight: bold;
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
}

/* Style des cellules de données */
td {
    padding: 8px;
    border: 1px solid #ddd;
}

/* Style des lignes impaires */
tr:nth-child(odd) {
    background-color: #f9f9f9;
}

/* Style du titre */
h1 {
    font-family: Arial, Helvetica, sans-serif;
    color: #333;
}

/* Style du tableau sur les petits écrans */
@media screen and (max-width: 600px) {
    table {
        border: 0;
    }
    table thead {
        display: none;
    }
    table tbody td {
        display: block;
        padding: 8px;
    }
    table tbody td::before {
        content: attr(data-label);
        font-weight: bold;
        display: inline-block;
        width: 50%;
    }
}

    </style>
</head>
<body>
    <h1>Liste des informations</h1>
    <h3>Total d'utilisateurs: <?= count($results) ?></h3>

    <table>
        <thead>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </thead>
        <tbody>
            <?php foreach($results as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['nom'] ?></td>
                    <td><?= $user['prenom'] ?></td>
                    <td><?= $user['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>