<?php
// 1. On démarre (ou récupère) la session actuelle
session_start();

// 2. On vide toutes les variables de session (id_utilisateur, prenom, etc.)
session_unset();

// 3. On détruit complètement la session
session_destroy();

// 4. On redirige l'utilisateur vers la page de connexion
header("Location: connexion.php");

// 5. On arrête l'exécution du script par sécurité
exit();
