<?php 
require 'commun_services.php'; 

if(!isset($_POST["sexe"]) || !isset($_POST["pseudo"]) || !isset($_POST["firstname"]) || !isset($_POST["lastname"])
|| !isset($_POST["password"])|| !isset($_POST["email"]) || !isset($_POST["dateBirth"])){
    produceErrorRequest();
    return;
}
if(empty($_POST["sexe"]) || empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["password"])
 || empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["dateBirth"]) ){
    produceErrorRequest();
    return;
}

$user = new UserEntity();
$user->setSexe($_POST["sexe"]);
$user->setPseudo(($_POST["pseudo"]));
$user->setFirstname($_POST["firstname"]);
$user->setLastname($_POST["lastname"]);
$user->setEmail($_POST["email"]);
$user->setPassword($_POST["password"]);
$user->setDateBirth($_POST["dateBirth"]);

try {
    $data = $db->createUser($user);

    if($data){
        produceResult("Compte utilisateur créé avec succès");
    }else{
        produceError("Problème rencontré lors de la création du compte");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}




?>