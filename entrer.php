<?php
require('getapikey.php');

// Vérification
if (!isset($_POST['montant'])) {
    die("Erreur : montant manquant");
}

$transaction = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 12); //Identifiant généré aléatoirement
$montant = number_format($_POST['montant'], 2, '.', '');
$vendeur = "MI-4_G"; //Notre nom de groupe normalement

$retour = ""; //Je te laisse mettre le lien pour retourner vers le site

$api_key = getAPIKey($vendeur);

// Vérif API key
if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    die("Erreur API KEY");
}

//Le Hash demander normalement
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>

<!DOCTYPE html>
<html>
<body>

<form id="paymentForm" action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
    <input type="hidden" name="transaction" value="<?= $transaction ?>">
    <input type="hidden" name="montant" value="<?= $montant ?>">
    <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
    <input type="hidden" name="retour" value="<?= $retour ?>">
    <input type="hidden" name="control" value="<?= $control ?>">
    <input type="submit" value="Payer">
</form>

</body>
</html>