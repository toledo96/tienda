<?php

$total = $_REQUEST['total']??'';
include_once "stripe/init.php";
\Stripe\Stripe::setApiKey("sk_test_51HhTvpDqul8wYHRGoePebSbUWMzb7Cxdo3jJlO1A7KVxC3yepgBUYKEsqnseBeXAe3d4SSAOGhhMqOPshs3q4em100hBjp0ZuV");

$toke = $_POST['stripeToken'];
$charge = \Stripe\Charge::create([
    'amount' => $total,
    'currendy' => 'mxn',
    'description' => 'pago de ecommerce',
    'source' => $token
]);

if($charge['captured']){
    $id_cliente = $_SESSION['idClient'];
    $id_pago = $charge['id'];
    $sql_venta = "INSERT INTO ventas (id_client,id_payment,date) VALUES (:id_client,:id_payment,now())";
    $query = $db->prepare($sql_venta);
    $query->bindParam(':id_client', $id_cliente, PDO::PARAM_STR);
    $query->bindParam(':id_payment', $id_pago, PDO::PARAM_STR);
    $result = $query->execute();
    $id = $db->lastInsertId();
    if($result){
        echo "La venta fue exitosa con el id=".$id;
    }
    
    $insertarDetalle = "";
    $cantidadProd = count($_REQUEST['id']);

    for($i=0; $i < $cantidadProd; $i++){
        $subtotal = $_REQUEST['precio'][$i] * $_REQUEST['cantidad'][$i];
        $insertarDetalle = $insertarDetalle."('".$_REQUEST['id'][$i]."' , '$id', '".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio']."','$subtotal' )";
    }

}
