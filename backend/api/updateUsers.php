<?php
require 'commun_services.php';

if(!isset($_REQUEST["id"]) || !isset($_REQUEST["sexe"]) || !isset($_REQUEST["pseudo"]) || !isset($_REQUEST["firstname"]) || !isset($_REQUEST["lastname"])
|| !isset($_REQUEST["description"]) || !isset($_REQUEST["adresse_facturation"]) || !isset($_REQUEST["adresse_livraison"])
|| !isset($_REQUEST["tel"])|| !isset($_REQUEST["email"])){
    produceErrorRequest();
    return;
}
if(empty($_REQUEST["id"]) || empty($_REQUEST["sexe"]) || empty($_REQUEST["pseudo"]) || empty($_REQUEST["firstname"]) || empty($_REQUEST["lastname"])
|| empty($_REQUEST["description"]) || empty($_REQUEST["adresse_facturation"]) || empty($_REQUEST["adresse_livraison"])
|| empty($_REQUEST["tel"])|| empty($_REQUEST["email"])){
    produceErrorRequest();
    return;
}

$user = new UserEntity();
$user->setIdUser($_REQUEST["id"]);
$user->setSexe($_REQUEST["sexe"]);
$user->setPseudo(($_REQUEST["pseudo"]));
$user->setFirstname($_REQUEST["firstname"]);
$user->setLastname($_REQUEST["lastname"]);
$user->setEmail($_REQUEST["email"]);
$user->setPassword($_REQUEST["password"]);
$user->setDateBirth($_REQUEST["dateBirth"]);

try {
    $data = $db->updateUsers($user);

    if($data){
        produceResult('modification réussie ;');
    }else {
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>