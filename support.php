<?php
session_start();
include "database/good_game_db.php";

// Si la page existe, il prend la valeur de "page" sinon support
$page = isset($_GET['page']) ? $_GET['page'] : 'support';

// Si la section existe, il prend la valeur de "section" sinon rien
$section = isset($_GET['section']) ? $_GET['section'] : '';

include "view/support_view.php";

$conn->close();
?>