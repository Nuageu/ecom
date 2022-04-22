<?php 


class DataLayer{

    private $connexion;

    
    function __construct()
    {
        $var = "mysql:host=".HOST.";dbname=".DB_NAME;

        try {
            $this->connexion = new PDO($var,DB_USER,DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
        /**
     * Méthode permettant d'authentifier un utilisateur 
     * @param UserEntity $user Objet métier décrivant un utilisateur 
     * @return UserEntity $user Objet métier décrivant l'utilisateur authentifié
     * @return FALSE En cas d'échec d'authentification
     * @return NULL Exception déclenchée 
    */
    function authentifier(UserEntity $user){
        $sql = "SELECT * FROM `ecommerce`.`customers` WHERE email = :email";

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':email'=>$user->getEmail()
            ));

            $data = $result->fetch(PDO::FETCH_OBJ);

            if($data && ($data->password == sha1($user->getPassword()))){
                // authentification réussie
                $user->setIdUser($data->id);
                $user->setSexe($data->sexe);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPassword(NULL);
                $user->setAdresseFactutation($data->adresse_facturation);
                $user->setAdresseLivraison($data->adresse_livraison);
                $user->setTel($data->tel);
                $user->setDateBirth($data->dateBirth);

                return $user;

            }else{
                // authentification échouée
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }
    // Create
        /**
     * Methode permettant de créer un utilisateur en BD 
     * @param UserEntity $user Objet métier décrivant un un utilisateur
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */

    function createUser(UserEntity $user){
        $sql= "INSERT INTO `ecommerce`.`customers` (sexe,pseudo,email,password,firstname,lastname,dateBirth)
        VALUES (:sexe,:pseudo,:email,:password,:firstname,:lastname,:dateBirth)";
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':sexe' => $user->getSexe(),
                ':pseudo' => $user->getPseudo(),
                ':email' => $user->getEmail(),
                ':password' => sha1($user->getPassword()),
                ':firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                ':dateBirth' => $user->getDateBirth()
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

        /**
     * Methode permettant de créer une categorie en BD 
     * @param CategoryEntity $category Objet métier décrivant une categorie
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function createCategory(CategoryEntity $category){
        $sql = "INSERT INTO `ecommerce`.`category`(`category`) VALUES (:name)";

        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name' => $category->getName()
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de créer un produit en BD 
     * @param ProductEntity $product Objet métier décrivant un product
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function createProduct(ProductEntity $product){
        $sql ='INSERT INTO `ecommerce`.`product`(`name`, `description`, `price`, `stock`, `category`, `image`) 
        VALUES (:name,:description,:price,:stock,:category,:image)';
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name'=> $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':category' => $product->getCategory(),
                ':image'=> $product->getImage()
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }

    /**
     * Methode permettant de créer une commande en BD 
     * @param OrdersEntity $order un objet metier décrivant une commande
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function createOrders(OrdersEntity $orders){
        $sql = 'INSERT INTO `ecommerce`.`orders`(`id_customers`, `id_product`, `quantity`, `price`)
         VALUES (:idCustomer,:idProduct,:quantity,:price)';

        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':idCustomer'=>$orders->getIdUser(),
                ':idProduct'=>$orders->getIdProduct(),
                ':quantity' => $orders->getQuantity(),
                ':price' => $orders->getPrice()
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }


    /**
     * Methode permettant de récupérer les utilisateur dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les données utilisateurs
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getUsers(){
        $sql = 'SELECT * FROM `ecommerce`.`customers`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $users = [];

            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $user = new UserEntity();
                $user->setIdUser($data->id);
                $user->setEmail($data->email);
                $user->setSexe($data->sexe);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $users[] = $user;
            }

            if($users){
                return $users;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de récupérer les catégories dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les catégories
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getCategory(){
        $sql = 'SELECT * FROM `ecommerce`.`category`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $categories = [];

            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $category = new CategoryEntity();
                $category->setIdCategory($data->id);
                $category->setName($data->category);

                $categories[] = $category;
            }

            if($categories){
                return $categories;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

     /**
     * Methode permettant de récupérer les produits dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les produits
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getProduct(){
        $sql = 'SELECT * FROM `ecommerce`.`product`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $products = [];

            while($data = $result->fetch(PDO::FETCH_OBJ)){
               $product = new ProductEntity();
               $product->setIdProduct($data->id);
               $product->setName($data->name);
               $product->setDescription($data->description);
               $product->setPrice($data->price);
               $product->setStock($data->stock);
               $product->setImage($data->image);
               $product->setCategory($data->category);
               $product->setCreatedAt($data->createdat);

               $products[] = $product;
            }

            if($products){
                return $products;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

         /**
     * Methode permettant de récupérer les commandes dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les commande
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getOrders(){
        $sql = 'SELECT * FROM `ecommerce`.`orders`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $orders = [];

            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $order = new OrdersEntity();
                $order->setIdOrder($data->id);
                $order->setIdUser($data->id_customers);
                $order->setIdProduct($data->id_product);
                $order->setPrice($data->price);
                $order->setQuantity($data->quantity);
                $order->setCreatedAt($data->createdat);

                $orders[] = $order;
            }

            if($orders){
                return $orders;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de mettre à jour des données d'un utilisateur dans BD 
     * @param UserEntity $user Objet métier décrivant un utilisateur
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateUsers(UserEntity $user){
        $sql ="UPDATE `ecommerce`.`customers` SET ";
        try {
            $sql .= " Pseudo = '".$user->getPseudo()."',";
            $sql .= " email = '".$user->getEmail()."',";
            $sql .= " sexe = '".$user->getSexe()."',";
            $sql .= " firstname = '".$user->getFirstname()."',";
            $sql .= " lastname = '".$user->getLastname()."',";
            $sql .= " adresse_facturation = '".$user->getAdresseFactutation()."',";
            $sql .= " adresse_livraison = '".$user->getAdresseLivraison()."'";

            $sql .= " WHERE id=".$user->getIdUser(); 

            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de mettre à jour un produit dans BD 
     * @param ProductEntity $product Objet métier décrivant un produit
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateProduct(ProductEntity $product){
        $sql = "UPDATE `ecommerce`.`product` SET `name`=:name,`description`=:description,`price`=:price,
        `stock`=:stock,`category`=:category,`image`=:image WHERE id=:id";
         try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':id' => $product->getIdproduct(),
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':category' => $product->getCategory(),
                ':image'=>$product->getImage()
               
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        } 
    }

    /**
     * Methode permettant de mettre à jour une catégorie dans BD 
     * @param CategoryEntity $category Objet métier décrivant une categorie
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateCategory(CategoryEntity $category){
        $sql = "UPDATE `ecommerce`.`category` SET `category`=:name WHERE id=:id";
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':name' => $category->getName(),
                ':id' => $category->getIdcategory()
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de mettre à jour une commande dans BD 
     * @param OrdersEntity $order Objet métier décrivant une commande
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateOrders(OrdersEntity $order){
        $sql = "UPDATE `ecommerce`.`orders` SET `id_customers`=:id_customers, `id_product`=:id_product, `quantity`=:quantity, `price`=:price
         WHERE id=:id";
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':id_customers' => $order->getIduser(),
                ':id_product' => $order->getIdproduct(),
                ':quantity' => $order->getQuantity(),
                ':price' => $order->getPrice(),
                ':id' => $order->getIdOrder()
            ));
            //var_dump($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

       

    /**
     * Methode permettant de supprimer un utilisateur dans BD 
     * @param UserEntity $user Objet métier décrivant un utilisateur
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteUsers(UserEntity $user){
        $sql = "DELETE FROM `ecommerce`.`customers` WHERE id=".$user->getIdUser();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de supprimer un produit dans BD 
     * @param ProductEntity $product Objet métier décrivant un produit
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteProduct(ProductEntity $product){
        $sql = "DELETE FROM `ecommerce`.`product` WHERE id=".$product->getIdProduct();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de supprimer une categorie dans BD 
     * @param CategoryEntity $user Objet métier décrivant une categorie
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteCategory(CategoryEntity $category){
        $sql = "DELETE FROM `ecommerce`.`category` WHERE id=".$category->getIdCategory();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de supprimer une commande dans BD 
     * @param OrdersEntity $order Objet métier décrivant une commande
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteOrders(OrdersEntity $order){
        $sql = "DELETE FROM `ecommerce`.`orders` WHERE id=".$order->getIdOrder();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }
}










?>
