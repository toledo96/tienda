<?php
    if(isset($_REQUEST['crear'])){
        include_once 'db_ecommerce.php';

        $name = $_REQUEST['name'];
        $price = $_REQUEST['price'];
        $exist = $_REQUEST['exist'];
        $sql = "INSERT INTO productos (name,price,exist) VALUES (:name, :price, :exist) ";
        $query = $db->prepare($sql);
        $query->bindParam(':name', $name,PDO::PARAM_STR);
        $query->bindParam(':price', $price,PDO::PARAM_STR);
        $query->bindParam(':exist', $exist,PDO::PARAM_STR);
        $result = $query->execute();
        if($result){
            $msg = "<div class='alert alert-success'>  <b> Exito! se ha registrado  </b>  </div>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Usuario creado"/>';
        }else{
            $msg = "<div class='alert alert-danger'>  <b> Error! no se ha podido registrar  </b>  </div>";
            echo $msg;
        }
    }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Producto</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="panel.php?modulo=crearProducto" method="POST">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Precio</label>
                                    <input type="text" name="price" placeholder="Precio" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Existencia</label>
                                    <input type="text" name="exist" placeholder="Existencia" class="form-control">
                                </div>

                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="crear">Crear producto</button>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>