<?php 


require 'commun_services.php';

if(isset($_FILES) && is_array($_FILES)){
    if($_FILES["image"]["name"]){
        $dirImage = realpath("..")."/images/products".$_FILES["image"]["name"];
        $save = move_uploaded_file($_FILES["image"]["tmp_name"],$dirImage);
        if($save){
            produceResult($_FILES);
        }else{
            produceError("Problème de stockage de l'image");
        }
    }else{
        produceError("Fichier incorrecte !");
    }   
}else{
    produceErrorRequest();
}


?>
