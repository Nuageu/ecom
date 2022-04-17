<?php 

class ProductEntity{

    protected ?int $idProduct;

    protected string $name;

    protected string  $description;

    protected float  $price;

    protected int  $stock;

    protected string  $Category;

    protected string $image;
    
    protected string $createdAt;

    function getIdProduct() { 
        return $this->idProduct; 
   } 

   function setIdProduct($idProduct) {  
       $this->idProduct = $idProduct; 
   } 

   function getName() { 
        return $this->name; 
   } 

   function setName($name) {  
       $this->name = $name; 
   } 

   function getDescription() { 
        return $this->description; 
   } 

   function setDescription($description) {  
       $this->description = $description; 
   } 

   function getPrice() { 
        return $this->price; 
   } 

   function setPrice($price) {  
       $this->price = $price; 
   } 

   function getStock() { 
        return $this->stock; 
   } 

   function setStock($stock) {  
       $this->stock = $stock; 
   } 

   function getCategory() { 
        return $this->Category; 
   } 

   function setCategory($Category) {  
       $this->Category = $Category; 
   } 

   function getImage() { 
        return $this->image; 
   } 

   function setImage($image) {  
       $this->image = $image; 
   } 

   function getCreatedAt() { 
        return $this->createdAt; 
   } 

   function setCreatedAt($createdAt) {  
       $this->createdAt = $createdAt; 
   } 

}





?>