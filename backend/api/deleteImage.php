<?php 

require 'commun_services.php';


if(isset($_REQUEST["name"]) && empty($_REQUEST["name"])){
    $urlImage = "../images/products/".$_REQUEST["name"];
    if(file_exists($urlImage)){
        unlink($urlImage);
        produceResult("Suppresssion de l'image réussi !");
    }else{
        produceError("L'image n'existe pas sur le serveur");
    }
}else{
    produceErrorRequest();
}



?>
