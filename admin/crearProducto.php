<?php

if (isset($_REQUEST['crear'])) {
    include_once 'db_ecommerce.php';

    $name = $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $exist = $_REQUEST['exist'];
    $description = $_REQUEST['description'];
    $sql = "INSERT INTO productos (name,price,exist,description) VALUES (:name, :price, :exist, :description) ";
    $query = $db->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':exist', $exist, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $result = $query->execute();
    $ultimo_insertado = $db->lastInsertId();

    // print_r($ultimo_insertado);

    ////////////////////////////////////////////////////
    $num_archivos = count($_FILES['imagen']['name']);
    $padre = dirname(__DIR__);
    $resultado = str_replace('\\', '/', $padre);
    $carpeta = "/freddy"; //cambiar por el nombre de la carpeta donde esta el proyecto
    $respuesta = 0;

    //tengo que hacer lo de id_producto y id_file




    for ($i = 0; $i < $num_archivos; $i++) {
        if (!empty($_FILES['imagen']['name'][$i])) {
            $system_path = $resultado . "/" . "upload/" . $_FILES['imagen']['name'][$i];
            $web_path = $carpeta . "/" . "upload/" . $_FILES['imagen']['name'][$i];
            $filesize = $_FILES['imagen']['size'][$i];
            $filename = $_FILES['imagen']['name'][$i];

            $sql = "INSERT INTO files (filename,filesize,web_path,system_path) VALUES (:filename, :filesize, :web_path, :system_path) ";
            $query = $db->prepare($sql);
            $query->bindParam(':filename', $filename, PDO::PARAM_STR);
            $query->bindParam(':filesize', $filesize, PDO::PARAM_STR);
            $query->bindParam(':web_path', $web_path, PDO::PARAM_STR);
            $query->bindParam(':system_path', $system_path, PDO::PARAM_STR);
            $result = $query->execute();
            $ultimo_insertado_file = $db->lastInsertId();
            // echo $system_path."<br>";
            // echo $filesize."<br>";
            // echo $web_path."<br>";
            // echo "nombre:".$filename."<br>";
            $sql2 = "INSERT INTO productos_files (product_id,file_id) VALUES (:ultimo_insertado, :ultimo_insertado_file) ";
            $query2 = $db->prepare($sql2);
            $query2->bindParam(':ultimo_insertado', $ultimo_insertado, PDO::PARAM_STR);
            $query2->bindParam(':ultimo_insertado_file', $ultimo_insertado_file, PDO::PARAM_STR);
            $result2 = $query2->execute();
            if ($result2) {
                $respuesta = 1;
            }
        }

        if (file_exists($system_path)) {
            // echo "esta imagen ya existe";
        } else {
            $ruta_temporal = $_FILES['imagen']['tmp_name'][$i];
            move_uploaded_file($ruta_temporal, $system_path);
            // echo "archivo subido de forma";
            echo $ruta_temporal . "<br>";
        }
    }

    if ($respuesta == 1) {
        $msg = "<div class='alert alert-success'>  <b> Exito! se ha registrado  </b>  </div>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=producto creado"/>';
    } else {
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

                            <form action="panel.php?modulo=crearProducto" method="POST" enctype="multipart/form-data">
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

                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea type="text" name="description" placeholder="descripción" rows="3" class="form-control"></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Imagen</label>
                                    <input type="file" class="form-control-file" name="imagen[]" id="exampleFormControlFile1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Imagen</label>
                                    <input type="file" class="form-control-file" name="imagen[]" id="exampleFormControlFile1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Imagen</label>
                                    <input type="file" class="form-control-file" name="imagen[]" id="exampleFormControlFile1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Imagen</label>
                                    <input type="file" class="form-control-file" name="imagen[]" id="exampleFormControlFile1">
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