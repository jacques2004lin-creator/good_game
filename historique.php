<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// On récupère uniquement les achats de l'utilisateur connecté
$sql = "SELECT * FROM achats WHERE utilisateur_id = $id_utilisateur ORDER BY id DESC";
$achats = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/historique.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique d'achat - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h1 class="gg-page-title">Historique d'achat</h1>

        <div class="gg-history-card">
            <table class="gg-history-table">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Date</th>
                        <th>Jeux</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($achats && $achats->num_rows > 0): ?>
                        <?php while ($a = $achats->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo sprintf("#GG- %05d", $a['id']); ?></td>

                                <td><?php echo date('d/m/Y'); ?></td>

                                <td>
                                    <?php
                                    $id_achat = $a['id'];
                                    $jeux = $conn->query("SELECT jeux.titre FROM achat_jeux JOIN jeux ON achat_jeux.jeu_id = jeux.id WHERE achat_id = $id_achat");
                                    
                                    echo "<ul>";
                                    while ($j = $jeux->fetch_assoc()) {
                                        echo "<li>" . htmlspecialchars($j['titre']) . "</li>";
                                    }
                                    echo "</ul>";
                                    ?>
                                </td>

                                <td><?php echo number_format($a['sous_total'], 2, ',', ' '); ?> €</td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                Vous n'avez pas encore passé de commande.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>
<?php $conn->close(); ?>