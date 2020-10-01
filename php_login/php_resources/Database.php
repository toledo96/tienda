<?php
class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $namedb = "ecommerce";
    public $pdo;

    public function __construct(){
        if(!isset($this->pdo)){
            try{
                $link = new PDO("mysql:host=".$this->host.";dbname=".$this->namedb,$this->user,$this->pass);
                $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $link->exec("SET CHARACTER SET utf8");
                $this->pdo = $link;
            }catch(PDOException $e){
                die("fallo".$e->getMessage());
            }
        }
    }
}