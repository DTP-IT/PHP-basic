<?php
include_once 'myConfig.php';

class User extends Connect
{
    function __construct()
    {
        parent::__construct();
    }

    public function createTableUser()
    {
        $sqlCreateTable = "CREATE TABLE users(
            id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name varchar(200) COLLATE utf8mb4_unicode_ci,
            password varchar(100),
            phone varchar(20),
            mail varchar(255),
            address varchar(255) COLLATE utf8mb4_unicode_ci
        )";
        $prepareCreate = $this->pdo->prepare($sqlCreateTable);

        return $prepareCreate->execute();
    }

    public function register($name, $passwd, $phone, $mail, $address)
    {
        $sqlInsertUser = "INSERT INTO users(name, password, phone, mail, address) VALUES (:name, :passwd, :phone, :mail, :address)";
        $preAdd = $this->pdo->prepare($sqlInsertUser);
        $preAdd->bindParam(':name', $name);
		$preAdd->bindParam(':passwd', $passwd);
		$preAdd->bindParam(':phone', $phone);
        $preAdd->bindParam(':mail', $mail);
        $preAdd->bindParam(':address', $address);
        
        return $preAdd->execute();
    }

    public function listUser()
    {
        $sqlView = "SELECT * FROM users";
        $prepareView = $this->pdo->prepare($sqlView);
        $prepareView->execute();

        return $prepareView->fetchAll(PDO::FETCH_ASSOC);
    }

    public function dropUser()
    {
        $sqlDrop = "DROP TABLE users";
        $prepareDrop = $this->pdo->prepare($sqlDrop);

        return $prepareDrop->execute();
    }

    public function login($mail, $passwd)
    {
        $sqlLogin = "SELECT * FROM users WHERE mail = :mail AND password = :passwd";
        $prepareLogin = $this->pdo->prepare($sqlLogin);
        $prepareLogin->bindParam(':mail', $mail);
        $prepareLogin->bindParam(':passwd', $passwd);
        $prepareLogin->execute();

        return $prepareLogin->fetchAll(PDO::FETCH_ASSOC);
    }
}