<?php
try {
    $pdo = new PDO('mysql:host=pa2i1-mysql;dbname=pa2i1', 'root', 'root');
    echo "✅ Connexion réussie à la base de données Docker !";
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
}
?>
