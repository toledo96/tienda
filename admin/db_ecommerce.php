<?php

$user = "root";
$password = "";
$dbase = "ecommerce";
$db;

try {
    $dsn = "mysql:host=localhost;dbname=$dbase";
    $db = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
} catch (PDOException $e){
    echo $e->getMessage();
}

?>