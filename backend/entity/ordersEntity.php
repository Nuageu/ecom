<?php 

Class OrdersEntity{

    protected ?int $idOrder;
    protected int $idUser;
    protected int $idProduct;
    protected int $quantity;
    protected int $price;
    protected string $createdAt;
    

    function getIdOrder() {
		return $this->idOrder;
	}

	function setIdOrder($idOrder) {
		$this->idOrder = $idOrder;
	}



    function getIdUser() {
		return $this->idUser;
	}

	function setIdUser($idUser) {
		$this->idUser = $idUser;
	}

    

	function getIdProduct() {
		return $this->idProduct;
	}

	function setIdProduct($idProduct) {
		$this->idProduct = $idProduct;
	}


    

	function getQuantity() {
		return $this->quantity;
	}

	function setQuantity($quantity) {
		$this->quantity = $quantity;
	}



    

	function getPrice() {
		return $this->price;
	}

	function setPrice($price) {
		$this->price = $price;
	}


    

	function getCreatedAt() {
		return $this->createdAt;
	}

	function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}


}





?>