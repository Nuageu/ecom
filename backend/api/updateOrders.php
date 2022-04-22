<?php 
require 'commun_services.php';

if(!isset($_REQUEST['idOrder']) || !isset($_REQUEST['idUser']) || !isset($_REQUEST['idProduct']) 
|| !isset($_REQUEST['quantity']) || !isset($_REQUEST['price'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['idOrder']) || empty($_REQUEST['idUser']) || empty($_REQUEST['idProduct']) 
|| empty($_REQUEST['quantity']) || empty($_REQUEST['price'])){
    produceErrorRequest();
    return;
}

$order = new OrdersEntity();
$order->setIdOrder($_REQUEST['idOrder']);
$order->setIdUser($_REQUEST['idUser']);
$order->setIdProduct($_REQUEST['idProduct']);
$order->setQuantity($_REQUEST['quantity']);
$order->setPrice($_REQUEST['price']);


try {
    $data = $db->updateOrders($order);

    if($data){
        produceResult("Mise à jour réussie !");
    }else {
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}




?>