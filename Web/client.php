<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

if(isset($_GET['id'])) {
    $sql = $bdd->prepare("SELECT `numero`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `numeroTelephone` FROM `Client` WHERE numero = :numero");
    $sql->bindParam(':numero', $_GET['id'], PDO::PARAM_INT);
    $sql->execute();
    $client = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($client);
} else {
    $sql = $bdd->prepare("SELECT * FROM Client");
    $sql->execute();
    $client = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($client);
}
?>