<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

$json = file_get_contents('php://input');
$decodeJson = json_decode($json);
$sql = $bdd->prepare("INSERT INTO `Client`(`nom`, `prenom`, `adresse`, `codepostal`, `ville`, `numeroTelephone`) VALUES (:nom, :prenom, :adresse, :codepostal, :ville, :numeroTelephone)");
$sql->bindParam(':nom', $decodeJson->{'name'}, PDO::PARAM_STR);
$sql->bindParam(':prenom', $decodeJson->{'lastName'}, PDO::PARAM_STR);
$sql->bindParam(':adresse', $decodeJson->{'address'}, PDO::PARAM_STR);
$sql->bindParam(':codepostal', $decodeJson->{'postalCode'}, PDO::PARAM_STR);
$sql->bindParam(':ville', $decodeJson->{'city'}, PDO::PARAM_STR);
$sql->bindParam(':numeroTelephone', $decodeJson->{'numberPhone'}, PDO::PARAM_STR);
//crée un json de retour : "message":"Le client a été crée avec succès !"
if($sql->execute()) {
    echo json_encode(array('message' => 'Le client a été crée avec succès'));
} else {
    echo json_encode(array('message' => 'Une erreur s\'est produit, impossible de crée le client'));
}
?>