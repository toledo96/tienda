<?php

include_once 'admin/db_ecommerce.php';

$total = $_REQUEST['total'] ?? '';
include_once "stripe/init.php";
\Stripe\Stripe::setApiKey("sk_test_51HhTvpDqul8wYHRGoePebSbUWMzb7Cxdo3jJlO1A7KVxC3yepgBUYKEsqnseBeXAe3d4SSAOGhhMqOPshs3q4em100hBjp0ZuV");

$toke = $_POST['stripeToken'];
$charge = \Stripe\Charge::create([
    'amount' => $total,
    'currency' => 'mxn',
    'description' => 'pago de ecommerce',
    'source' => $toke
]);

if ($charge['captured']) {

    $id_cliente = $_SESSION['idClient'];
    $id_pago = $charge['id'];
    $sql_venta = "INSERT INTO ventas (id_client,id_payment,date) VALUES (:id_client,:id_payment,now())";
    $query = $db->prepare($sql_venta);
    $query->bindParam(':id_client', $id_cliente, PDO::PARAM_STR);
    $query->bindParam(':id_payment', $id_pago, PDO::PARAM_STR);
    $result = $query->execute();
    $id = $db->lastInsertId();
    // if($result){
    //     echo "La venta fue exitosa con el id=".$id;
    // }

    $insertarDetalle = "";
    $cantidadProd = count($_REQUEST['id']);

    for ($i = 0; $i < $cantidadProd; $i++) {
        $subtotal = $_REQUEST['precio'][$i] * $_REQUEST['cantidad'][$i];
        $insertarDetalle = $insertarDetalle . "('" . $_REQUEST['id'][$i] . "' , '$id', '" . $_REQUEST['cantidad'][$i] . "','" . $_REQUEST['precio'][$i] . "','$subtotal' )";
    }

    $insertarDetalle = rtrim($insertarDetalle, ",");
    $queryDetalle = "INSERT INTO detalleventa (id_product,id_sell,quantity,price,subtotal) VALUES $insertarDetalle;";
    $query2 = $db->prepare($queryDetalle);
    $result2 = $query2->execute();
    if ($result && $result2) {
?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <?php echo muestraRecibe($id); ?>
                </div>
            </div>
        </div>
    <?php
        borrarCarrito();
    }
}

function borrarCarrito()
{
    ?>

    <script>
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function(response) {
                $("#badgeProducto").text("");
                $("#listaCarrito").text("");
            }
        });
    </script>

<?php
}
function muestraRecibe($id_venta)
{
?>


    <div class="text-center">
        <h2 class=" text-center mb-2">Detalle de venta</h2>
        <table class="table">

            <thead>
                <tr>
                    <th>Articulo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php
                global $db;
                $queryRecibe = "SELECT p.name,dv.quantity,dv.price,dv.subtotal FROM ventas AS v 
INNER JOIN detalleventa AS dv ON dv.id_sell = v.id_sell 
INNER JOIN productos AS p ON p.id_product = dv.id_product
WHERE v.id_sell = :id
";
                $query3 = $db->prepare($queryRecibe);
                $query3->bindParam(':id', $id_venta);
                $query3->execute();
                $total = 0;
                // $result3 = $query3->fetch(PDO::FETCH_OBJ)
                while ($result3 = $query3->fetch(PDO::FETCH_OBJ)) {
                    $total = $total + $result3->subtotal;
                ?>
                    <tr>
                        <td> <?php echo $result3->name;  ?> </td>
                        <td> <?php echo $result3->quantity;  ?> </td>
                        <td> $<?php echo $result3->price;  ?> </td>
                        <td> $<?php echo $result3->subtotal;  ?> </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Total</td>
                        <td><?php echo  "$" . $total; ?></td>
                    </tr>
            </tbody>

        </table>
        <h2>Tu compra se ha realizado existosamente, nos comunicaremos contigo</h2>
        <a href="index.php">Volver al inicio</a>

    </div>

<?php
                }
            }
?>