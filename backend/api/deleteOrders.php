<?php
require 'commun_services.php';

if(!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])){
    produceErrorRequest();
    return;
}

$order = new OrdersEntity();
$order->setIdOrder($_REQUEST["id"]);

try {
    $data = $db->deleteOrders($order);

    if($data){
        produceResult('Suppression réussie ;');
    }else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}