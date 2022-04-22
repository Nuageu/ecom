<?php
require 'commun_services.php';

if(!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])){
    produceErrorRequest();
    return;
}

$category = new CategoryEntity();
$category->setIdCategory($_REQUEST["id"]);

try {
    $data = $db->deleteCategory($category);

    if($data){
        produceResult('Suppression réussie ;');
    }else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}