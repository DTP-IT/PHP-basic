<?php
class Connect{
    private const dns 		= 'mysql:host=db;dbname=PhongDT';
    private const user 		= 'sampleUser';
    private const password 	= 'password';
    protected $pdo 			= null;

    function __construct(){
        try {
            $this->pdo = new PDO(self::dns,self::user,self::password);
            $this->pdo->query('SET NAMES utf8');
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        
    }
}