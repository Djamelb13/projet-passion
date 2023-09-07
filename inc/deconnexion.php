<?php
// Démarrez la session
session_start();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers une page après la déconnexion (par exemple, la page d'accueil)
header("Location: .."); // Remplacez "index.php" par l'URL de votre choix
exit();
?>
