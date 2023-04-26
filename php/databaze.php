<?php

namespace main;

use \PDO;


class Menu
{

    private string $hostname = "localhost";
    private int $port = 3307;
    private string $username = "root";
    private string $password = "";
    private string $dbName = "shop";

    private $connection;

    private string $hash = "sha256";

    // hashovanie hesla
    public function hashing(string $input): string
    {
       return hash($this->hash, $input);
    }

    //konštruktor
    public function __construct(string $host = "", int $port = 3307, string $user = "", string $pass = "", string $dbName = "")
    {
        
        if(!empty($host)) {
            $this->hostname = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($user)) {
            $this->username = $user;
        }

        if(!empty($pass)) {
            $this->password = $pass;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO("mysql:charset=utf8;host=".$this->hostname.";dbname=".$this->dbName.";port=".$this->port, $this->username, $this->password);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    //kontrola duplicity pri registracii
    public function duplicate(string $name, string $email): bool
    {

        try{
            $sql = "SELECT * FROM customers WHERE name = '$name' OR email = '$email'";
            $query = $this->connection->query($sql);
            $menuItem = $query->fetch(PDO::FETCH_ASSOC);
            return $menuItem ? true : false;
        }catch (\Exception $exception) {
            echo "Chyba vo funkcii duplicate";
            die();
        }


    }

    //registracia
    public function registration(string $name, string $email, string $password, string $adresa)
    {
        try{
            $sql = "INSERT INTO customers (name, email, password, adresa) VALUES (:name, :email, :password, :adresa)";
            $password = $this->hashing($password);
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':adresa', $adresa);
            $registration = $statement->execute();

        }catch (\Exception $exception) {
            echo "Chyba vo funkcii registration";
            die();
        }


    }

    //prihlasenie
    public function login(string $nameemail): array  
    {
        try{
            $sql = "SELECT * FROM customers WHERE name = :nameemail OR email = :nameemail";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':nameemail', $nameemail);
            $result = $statement->execute();
            $menuItems = $statement->fetch(PDO::FETCH_ASSOC); 
            return $menuItems ? $menuItems : [];

        }catch (\Exception $exception) {
            echo "Chyba vo funkcii login";
            die();
        }
    }

    //informacie používatela
    public function info(string $id){

        try{ 
            $sql = "SELECT * FROM customers WHERE id = $id";
            $query = $this -> connection -> query($sql);
            $info = $query->fetch(PDO::FETCH_ASSOC); 
            return $info;
        }catch (\Exception $exception) {
            echo "Chyba vo funkcii login";
            die();
        }
    }

    //funkcia na pridanie do košíku
    public function add(int $customerID, int $item_id)
    {
        try{
            $sql = "SELECT * FROM products WHERE item_id = $item_id";
            $query = $this -> connection -> query($sql);
            $product_info = $query->fetch(PDO::FETCH_ASSOC); 
    
            $sql = "SELECT * FROM customers WHERE id = $customerID";
            $query = $this -> connection -> query($sql);
            $customer_info = $query->fetch(PDO::FETCH_ASSOC);
    
            $sql = "SELECT * FROM shopping_card WHERE idCustomers = '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
            $query = $this -> connection -> query($sql);
            $duplicate = $query->fetch(PDO::FETCH_ASSOC);
    
            if($duplicate){
                $sql = "UPDATE `shopping_card` SET quantity = quantity + 1 WHERE '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
                $query = $this -> connection -> query($sql);
            }else{
                $sql = "INSERT INTO `shopping_card` (item_id, IdCustomers, customer_name, prize, quantity) 
                VALUES ('".$product_info['item_id']."', '".$customer_info['id']."', '".$customer_info['name']."', '".$product_info['prize']."', '1')";
                $query = $this -> connection -> query($sql);
            }

        }catch (\Exception $exception) {
            echo "Chyba vo funkcii add";
            die();
        }  
        
    }

    //funkcia, ktora odoberie 1 s celkoveho množstva
    public function remove(int $customerID, int $item_id)
    {
        try {
            $sql = "SELECT * FROM products WHERE item_id = $item_id";
            $query = $this -> connection -> query($sql);
            $product_info = $query->fetch(PDO::FETCH_ASSOC); 

            $sql = "SELECT * FROM customers WHERE id = $customerID";
            $query = $this -> connection -> query($sql);
            $customer_info = $query->fetch(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM shopping_card WHERE idCustomers = '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
            $query = $this -> connection -> query($sql);
            $status = $query->fetch(PDO::FETCH_ASSOC);

            if($status["quantity"] < 2){
                $sql = "DELETE FROM shopping_card WHERE idCustomers = '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
                $query = $this -> connection -> query($sql);
            }else{
                $sql = "UPDATE `shopping_card` SET quantity = quantity - 1 WHERE '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
                $query = $this -> connection -> query($sql);
            }
        }catch (\Exception $exception) {
            echo "Chyba vo funkcii remove";
            die();
        }  

    }

    //funkcia na odstranenie položky s košíka
    public function delete(int $customerID, int $item_id)
    {
        try{
            $sql = "SELECT * FROM products WHERE item_id = $item_id";
            $query = $this -> connection -> query($sql);
            $product_info = $query->fetch(PDO::FETCH_ASSOC); 

            $sql = "SELECT * FROM customers WHERE id = $customerID";
            $query = $this -> connection -> query($sql);
            $customer_info = $query->fetch(PDO::FETCH_ASSOC);

            $sql = "DELETE FROM shopping_card WHERE idCustomers = '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
            $query = $this -> connection -> query($sql);
        }catch (\Exception $exception) {
            echo "Chyba vo funkcii delete";
            die();
        }  


    }

    //Zobrazovanie položiek košíka
    public function show(int $customerID): array
    {

        try{ 
            $sql = "SELECT * FROM shopping_card inner join products on products.item_id = shopping_card.item_id WHERE IdCustomers = $customerID";
            $query = $this -> connection -> query($sql);
            $shopping_card = $query->fetchAll(PDO::FETCH_ASSOC); 

            return $shopping_card;
        }catch (\Exception $exception) {
            echo "Chyba vo funkcii show";
            die();
        }  
    
    }

    //pridanie emailu do newsletter odoberatelov
    public function newsletter(string $email)
    {

    try{
        $sql = "SELECT * FROM newsletter WHERE email = '".$email."'";
        $query = $this->connection->query($sql);
        $email_duplicate = $query->fetchAll(PDO::FETCH_ASSOC); 
    
        if(count($email_duplicate) == 0){
            $sql = "INSERT INTO newsletter (email) VALUES ('".$email."')";
            $query = $this->connection->query($sql);
        }

    }catch(\Exception $exception){
        echo "Chyba vo funkcii newsletter!";
    }

    }

    //Zobrazovanie položiek košíka
    public function order(int $customerID)
    {

        try{ 
            $sql = "SELECT * FROM shopping_card inner join products on products.item_id = shopping_card.item_id WHERE IdCustomers = $customerID";
            $query = $this -> connection -> query($sql);
            $shopping_card = $query->fetchAll(PDO::FETCH_ASSOC); 
           
            $sql = "SELECT * FROM customers WHERE id = '".$shopping_card[0]['IdCustomers']."'";
            $query = $this -> connection -> query($sql);
            $customer = $query->fetch(PDO::FETCH_ASSOC); 

            // vloží údaje do databázy objednávok
            foreach ($shopping_card as $card) {

                $sql = "INSERT INTO orders (item_id, idCustomers, customer_name, prize, quantity, address) VALUES ('".$card['item_id']."', '".$card['IdCustomers']."', '".$card['customer_name']."', '".$card['prize']."', '".$card['quantity']."', '".$customer['adresa']."')";
                $query = $this -> connection -> query($sql);
                $add_order = $query->fetch(PDO::FETCH_ASSOC);
            }

            //odstrani položky s košíka
            $sql = "DELETE FROM shopping_card WHERE IdCustomers = $customerID";
            $query = $this -> connection -> query($sql);
            $clear_shopping_card= $query->fetchAll(PDO::FETCH_ASSOC); 
            
        }catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }  
    
    }

}

