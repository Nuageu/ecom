<?php 


/**
 * CategoryEntity.php
 * 
 */

Class CategoryEntity{

    /**
     * Identifiant de la catégorie
     */

    protected ?int $idCategory;


     /**
     * Le Nom de la catégorie
     */
    protected string $name;

    /**
     * Getter/Setter
     */
	function getIdCategory() {
		return $this->idCategory;
	}

	function setIdCategory($idCategory) {
		$this->idCategory = $idCategory;
	}



	function getName() {
		return $this->name;
	}

	function setName($name) {
		$this->name = $name;
	}



}





?>
