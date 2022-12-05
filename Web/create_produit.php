<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

$json = file_get_contents('php://input');
$decodeJson = json_decode($json);
$sql = $bdd->prepare("INSERT INTO `Produit`(`reference`, `libelle`, `prixUnitaire`) VALUES (:reference, :libelle, :prixUnitaire)");
$sql->bindParam(':reference', $decodeJson->{'reference'}, PDO::PARAM_STR);
$sql->bindParam(':libelle', $decodeJson->{'libelle'}, PDO::PARAM_STR);
$sql->bindParam(':prixUnitaire', $decodeJson->{'prixUnitaire'}, PDO::PARAM_STR);

if($sql->execute()) {
    echo json_encode(array('message' => 'Le client a été crée avec succès'));
} else {
    $sql->debugDumpParams();
    echo json_encode(array('message' => 'Une erreur s\'est produit, impossible de crée le produit'));
}
?>