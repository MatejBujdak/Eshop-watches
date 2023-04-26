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
            echo this->$hostname."  ".this->$port."  ".$this->dbName;
            die();
        }
    }

    //funkcia na kontrolovanie duplicity
    public function duplicate(string $name, string $email): bool
    {

        $sql = "SELECT * FROM customers WHERE name = '$name' OR email = '$email'";
        $query = $this->connection->query($sql);
        $menuItem = $query->fetch(PDO::FETCH_ASSOC);
        return $menuItem;

    }

    //funkcia na pridavanie zaregistrovaneho do databazy
    public function registration(string $name, string $email, string $password)
    {

        $sql = "INSERT INTO customers VALUES('','$name','$email','$password')";
        $query = $this->connection->query($sql);

    }

    //prihlasenie
    public function login(string $nameemail): array
    {

        $sql = "SELECT * FROM customers WHERE name = '$nameemail' OR email = '$nameemail'";
        $query = $this -> connection -> query($sql);
        $menuItems = $query->fetch(PDO::FETCH_ASSOC);  
        return $menuItems;

    }

    //informacie používatela
    public function info(string $id){

        $sql = "SELECT * FROM customers WHERE id = $id";
        $query = $this -> connection -> query($sql);
        $info = $query->fetch(PDO::FETCH_ASSOC); 
        return $info;
    }

    //funkcia na pridanie do košíku
    public function add(int $customerID, int $item_id)
    {
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
    
    }

    //funkcia, ktora odoberie 1 s celkoveho množstva
    public function remove(int $customerID, int $item_id)
    {
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

    }

    //funkcia na odstranenie položky s košíka
    public function delete(int $customerID, int $item_id)
    {
        $sql = "SELECT * FROM products WHERE item_id = $item_id";
        $query = $this -> connection -> query($sql);
        $product_info = $query->fetch(PDO::FETCH_ASSOC); 

        $sql = "SELECT * FROM customers WHERE id = $customerID";
        $query = $this -> connection -> query($sql);
        $customer_info = $query->fetch(PDO::FETCH_ASSOC);

        $sql = "DELETE FROM shopping_card WHERE idCustomers = '" . $customer_info['id'] . "' AND item_id = '" . $product_info['item_id'] . "'";
        $query = $this -> connection -> query($sql);


    }


    //funkcia na zobrazovanie košíku
    public function show(int $customerID): array
    {

        $sql = "SELECT * FROM shopping_card inner join products on products.item_id = shopping_card.item_id WHERE IdCustomers = $customerID";
        $query = $this -> connection -> query($sql);
        $shopping_card = $query->fetchAll(PDO::FETCH_ASSOC); 

        return $shopping_card;
    
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
        echo "chyba vo funkcii newsletter";
    }

    
    }



}

