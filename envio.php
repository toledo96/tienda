<?php

if (isset($_SESSION['idClient'])) {
    $id = $_SESSION['idClient'];
    if(isset($_REQUEST['guardar'])){
        include_once 'admin/db_ecommerce.php';
        $nombreCli = $_REQUEST['nombreCli']??'';
        $emaiCli = $_REQUEST['emaiCli']??'';
        $direccionCli = $_REQUEST['direccionCli']??'';
        $telefonoCli = $_REQUEST['telefonoCli']??'';
        $estadoCli = $_REQUEST['estadoCli']??'';
        $municipioCli = $_REQUEST['municipioCli']??'';

        $sql = "UPDATE clientes SET name = :name, email=:email,address=:address,cellphone=:cellphone,state=:state,municipality=:municipality WHERE id_client=:id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindParam(':name',$nombreCli,PDO::PARAM_STR);
        $query->bindParam(':email',$emaiCli,PDO::PARAM_STR);
        $query->bindParam(':address',$direccionCli,PDO::PARAM_STR);
        $query->bindParam(':cellphone',$telefonoCli,PDO::PARAM_STR);
        $query->bindParam(':state',$estadoCli,PDO::PARAM_STR);
        $query->bindParam(':municipality',$estadoCli,PDO::PARAM_STR);
        $result = $query->execute();
        if($result){
            echo 'cmeta http-equiv="refresh" content="0; url="index.php?^modulo=pasarela" />';
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
                ERROR
            </div>
            <?php
        }


    }
    $sql2 = "SELECT name,email,address,cellphone,state,municipality FROM clientes WHERE id_client=:id";
    $query2 = $db->prepare($sql2);
    $query2->bindValue(':id', $id);
    $query2->execute();
    $result2 = $query2->fetch(PDO::FETCH_OBJ);

?>

    <form class="mb-3" method="POST">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Datos del cliente</h2>
                    <div class="form-group">
                        <label for="">Nombre (persona que recibira el producto)</label>
                        <input type="text" class="form-control" name="nombreCli" value="<?php echo $result2->name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="emaiCli" value="<?php echo $result2->email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Dirección</label>
                        <textarea name="direccionCli" class="form-control" cols="30" rows="5" required><?php echo $result2->address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" class="form-control" name="telefonoCli" value="<?php echo $result2->cellphone; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Estado</label>
                       
                        <select class="form-control" name="state" id="estados" required></select>
                    </div>
                    <div class="form-group">
                        <label for="">Municipio</label>
                        <select class="form-control" name="municipality" id="municipios" required>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <a href="index.php?modulo=carrito" class="btn btn-warning" role="button">Regresar</a>
        <a href="index.php?modulo=pasarela" class="btn btn-success float-right" type="submit" name="guardar" value="guardar">Ir a pagar</a>
    </form>
<?php
} else {

?>

    <div class="mt-5">
        Debe <a href="login.php">logearse</a> o <a href="registro.php">registrarse</a>
    </div>

<?php
}

?>

