<?php
session_start();

// Connexion à la base de données
$conn = new mysqli("db", "root", "root", "good_game");
$conn->set_charset("utf8mb4");

// Requete pour récupérer les catégories
$sql_categories = "SELECT * FROM categories"; 
$res_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
    <link href="css/categories.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
    <script defer src="/_vercel/insights/script.js"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h2 class="section-titre">Catégories</h2>
        <div class="categories-container">
            <?php
            if($res_categories->num_rows > 0) {
                while($cat = $res_categories->fetch_assoc()) {
                    $titre = str_replace('_', ' ', $cat['nom']);
                    echo '<a href="genre.php?cat='. htmlspecialchars($cat['nom']) .'" class="genre-carte" style="background-color: ' . htmlspecialchars($cat['couleur']) . ';">';
                        echo '<div class="genre-titre">' . strtoupper(htmlspecialchars($titre)) . '</div>';
                    echo '</a>';
                }
            } else {
                echo "<p class='vide'>Il n'y a pas de catégorie pour le moment.</p>";
            }
            ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>

<?php
$conn->close();
?>