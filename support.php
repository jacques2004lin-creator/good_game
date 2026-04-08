<?php
session_start();
include "good_game_db.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'support';
$section = isset($_GET['section']) ? $_GET['section'] : '';

include "support_view.php";

$conn->close();
?>