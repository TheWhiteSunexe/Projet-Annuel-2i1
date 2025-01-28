<?
session_start();

// Vérifier si les variables de session existent
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    echo "Role: " . htmlspecialchars($_SESSION['role']) . "<br>";
    echo "ID: " . htmlspecialchars($_SESSION['id']) . "<br>";
} else {
    echo "Les variables de session 'role' et 'id' ne sont pas définies.";
}
?>
