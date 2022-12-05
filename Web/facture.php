<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

if(isset($_GET['id'])) {
    $sql = $bdd->prepare("SELECT `numero`, `date`, `numero_Client` FROM `Facture` WHERE numero = :numero");
    $sql->bindParam(':numero', $_GET['id'], PDO::PARAM_INT);
    $sql->execute();
    $facture = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($facture);
} else {
    $sql = $bdd->prepare("SELECT * FROM Facture");
    $sql->execute();
    $facture = $sql->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($facture);
}
?>