<?php
// On démarre la session actuelle
session_start();

// On vide toutes les variables de session (id_utilisateur, prenom, etc.)
session_unset();

// On détruit complètement la session
session_destroy();

// On redirige l'utilisateur vers la page de connexion
header("Location: connexion.php");

// On arrête l'exécution du script par sécurité
exit();
