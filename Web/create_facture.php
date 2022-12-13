<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

$json = file_get_contents('php://input');
$decodeJson = json_decode($json);

$passed = true;
$sql = $bdd->prepare("INSERT INTO `Facture`(`date`, `numero_Client`) VALUES (NOW(), :numeroClient)");
$sql->bindParam(':numeroClient', $decodeJson->numeroClient, PDO::PARAM_INT);
if($sql->execute() == false)  {
    $passed = false;
}

$idFacture = $bdd->lastInsertId('Facture');
foreach($decodeJson->produits as $produit) {
    $sql = $bdd->prepare("INSERT INTO `Contenir`(`reference`, `numero`) VALUES (:reference, :numeroFacture)");
    $sql->bindParam(':reference', $produit, PDO::PARAM_STR);
    $sql->bindParam(':numeroFacture', $idFacture, PDO::PARAM_INT);
    
    if($sql->execute() == false) {
        $passed = false;
    }
}


if($passed) {
    echo json_encode(array('message' => 'La facture a été crée avec succès'));
} else {
    echo json_encode(array('message' => 'Une erreur s\'est produit, impossible de crée la facture'));
}
?>