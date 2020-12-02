<?php

if (isset($_REQUEST['actualizar'])) {
    // session_start();
    include_once 'admin/db_ecommerce.php';
    $id = $_SESSION['idClient'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $address = $_REQUEST['address'];
    $cellphone = $_REQUEST['cellphone'];
    $state = $_REQUEST['state'];
    $municipality = $_REQUEST['municipality'];

    //////////////////////////////
    //AQUI VAN VALIDACIONES
    /////////////////////////////

    $sql = "UPDATE clientes SET name = :name, email=:email,address=:address,cellphone=:cellphone,state=:state,municipality=:municipality WHERE id_client=:id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':cellphone',$cellphone,PDO::PARAM_STR);
    $query->bindParam(':state',$state,PDO::PARAM_STR);
    $query->bindParam(':municipality',$municipality,PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {

?>

        <div class="alert alert-success" role="alert">
            <b>Cambio realizado</b> <a href="index.php"></a>
        </div>

    <?php

    }

    ?>



<?php
    
}
?>
<div class="mt-5">
    <?php
            $id = $_SESSION['idClient'];
            $sql2 = "SELECT name,email,address,cellphone,state,municipality FROM clientes WHERE id_client=:id";
            $query2 = $db->prepare($sql2);
            $query2->bindValue(':id', $id);
            $query2->execute();
            $result2 = $query2->fetch(PDO::FETCH_OBJ);
    ?>
    <h2 class="text-center mb-4">Perfil</h2>
    <form action="" method="post">
        <?php

        ?>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nombre completo"  value="<?php echo $result2->name; ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $result2->email; ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="address" placeholder="direccion" value="<?php echo $result2->address; ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="cellphone" placeholder="Telefono" value="<?php echo $result2->cellphone; ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <select class="form-control" name="state" id="estados">
            </select>
        </div>
        <div class="form-group mb-3">
            <select class="form-control" name="municipality" id="municipios">
            </select>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block" name="actualizar">Actualizar</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>