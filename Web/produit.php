<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

if(isset($_GET['id'])) {
    $sql = $bdd->prepare("SELECT `reference`, `libelle`, `prixUnitaire` FROM `Produit` WHERE reference = :numero");
    $sql->bindParam(':numero', $_GET['id'], PDO::PARAM_STR);
    $sql->execute();
    $produit = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($produit);
} else {
    $sql = $bdd->prepare("SELECT * FROM Produit");
    $sql->execute();
    $produit = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produit);
}
?>