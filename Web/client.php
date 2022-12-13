<?php
header('Content-Type: application/json');
$bdd = new PDO('mysql:host=172.19.0.13;dbname=tpjson', 'tpjson', 'tpjson');

$json = file_get_contents('php://input');
$decodeJson = json_decode($json);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
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
        break;
        
    case 'POST':
        $sql = $bdd->prepare("INSERT INTO `Client`(`nom`, `prenom`, `adresse`, `codepostal`, `ville`, `numeroTelephone`) VALUES (:nom, :prenom, :adresse, :codepostal, :ville, :numeroTelephone)");
        $sql->bindParam(':nom', $decodeJson->name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $decodeJson->lastName, PDO::PARAM_STR);
        $sql->bindParam(':adresse', $decodeJson->address, PDO::PARAM_STR);
        $sql->bindParam(':codepostal', $decodeJson->postalCode, PDO::PARAM_STR);
        $sql->bindParam(':ville', $decodeJson->city, PDO::PARAM_STR);
        $sql->bindParam(':numeroTelephone', $decodeJson->numberPhone, PDO::PARAM_STR);

        if($sql->execute()) {
            echo json_encode(array('message' => 'Le client a été crée avec succès'));
        } else {
            echo json_encode(array('message' => 'Une erreur s\'est produit, impossible de crée le client'));
        }
        break;

    case 'PUT':
        $sql = $bdd->prepare("UPDATE `Client` SET `nom`=:nom,`prenom`=:prenom,`adresse`=:adresse,`codepostal`=:codepostal,`ville`=:ville,`numeroTelephone`=:numeroTelephone WHERE numero = :numeroClient");
        $sql->bindParam(':nom', $decodeJson->name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $decodeJson->lastName, PDO::PARAM_STR);
        $sql->bindParam(':adresse', $decodeJson->address, PDO::PARAM_STR);
        $sql->bindParam(':codepostal', $decodeJson->postalCode, PDO::PARAM_STR);
        $sql->bindParam(':ville', $decodeJson->city, PDO::PARAM_STR);
        $sql->bindParam(':numeroTelephone', $decodeJson->numberPhone, PDO::PARAM_STR);
        $sql->bindParam(':numeroClient', $decodeJson->numberClient, PDO::PARAM_INT);
        if($sql->execute()) {
            echo json_encode(array('message' => 'Le client a été modifier avec succès'));
        } else {
            echo json_encode(array('message' => 'Une erreur s\'est produit, impossible de modifier le client'));
        }
    break;

    case 'DELETE':
        $sql = $bdd->prepare("DELETE FROM `Client` WHERE numero = :numeroClient");
        $sql->bindParam('numeroClient', $decodeJson->numberClient, PDO::PARAM_INT);
        if($sql->execute()) {
            echo json_encode(array('message' => 'Le client a été supprimer avec succès'));
        } else {
            echo json_encode(array('message' => 'Une erreur s\'est produit, impossible de supprimer le client'));
        }
        break;

    default:
        $sql = $bdd->prepare("SELECT * FROM Client");
        $sql->execute();
        $client = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($client);
        break;
}

?>