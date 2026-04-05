<?php
require('getapikey.php');

// Vérification des paramètres
if (!isset($_GET['transaction'], $_GET['montant'], $_GET['vendeur'], $_GET['control'])) {
    die("Erreur : paramètres manquants");
}

$transaction = $_GET['transaction'];
$montant = $_GET['montant'];
$vendeur = $_GET['vendeur'];
$statut = $_GET['status'] ?? $_GET['statut'] ?? '';
$control_recu = $_GET['control'];

$api_key = getAPIKey($vendeur);

// Vérif Api
if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    die("Erreur API KEY");
}

// normalement ça recalcule le hash
$control_calcule = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

// Vérif
if ($control_calcule !== $control_recu) {
    die("⚠️ Erreur : données corrompues !");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Résultat paiement</title>
</head>
<body>

<h2>Résultat du paiement</h2>

<p>Transaction : <?= htmlspecialchars($transaction) ?></p>
<p>Montant : <?= htmlspecialchars($montant) ?> €</p>

<?php if ($statut === "accepted"): ?>
    <h3 style="color:green;">Paiement accepté ✅</h3>
<?php else: ?>
    <h3 style="color:red;">Paiement refusé ❌</h3>
<?php endif; ?>

<a href="">Retour à la boutique</a>

</body>
</html>