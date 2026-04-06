<?php
include "good_game_db.php";
$q = $_GET['q'] ?? '';

$sql = "SELECT id, titre FROM jeux WHERE titre LIKE '%$q%' LIMIT 10";
$result = $conn->query($sql);

$json = [];
while($row = $result->fetch_assoc()){
    $json[] = $row;
}

echo json_encode($json);