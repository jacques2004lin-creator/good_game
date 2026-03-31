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
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/panier.css">
    <link rel="stylesheet" href="css/historique.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique d'achat - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="gg-history-container">
        <h1 class="gg-page-title">Historique d'achat</h1>

        <div class="gg-history-card">
            <table class="gg-history-table">
                <thead>
                    <tr>
                        <th>ID commande</th>
                        <th>Date</th>
                        <th>jeux</th>
                        <th style="text-align: right;">prix</th>
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

                                    $liste_jeux = [];
                                    while ($j = $jeux->fetch_assoc()) {
                                        $liste_jeux[] = htmlspecialchars($j['titre']);
                                    }
                                    // S'il y a plusieurs jeux, on les sépare par un retour à la ligne
                                    echo implode("<br>", $liste_jeux);
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
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="burger_profile.js"></script>
</body>

</html>
<?php $conn->close(); ?>