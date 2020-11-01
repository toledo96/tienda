<div class="content-wrapper">
    <?php

    include_once 'db_ecommerce.php';

    if (isset($_GET['idBorrar'])) {

        $id = $_GET['idBorrar'];
        $sql = "SELECT file_id FROM productos_files WHERE product_id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $result = $query->execute();
        while($result = $query->fetch(PDO::FETCH_OBJ)){
            // array_push($id_files,$result->file_id);
            $sql2 = "DELETE FROM files WHERE id = :archivo_id";
            $query2 = $db->prepare($sql2);
            $query2->bindValue(':archivo_id', $result->file_id);
            $result2 = $query2->execute();
            if($result2){
                //Aqui va lo de borrar imagenes de la carpeta
            }
        }


        $sql2 = "DELETE FROM productos_files WHERE product_id=:id";
        $query2 = $db->prepare($sql2);
        $query2->bindValue(':id', $id);
        $result2 = $query2->execute();
        if($result2){
            $sql = "DELETE FROM productos WHERE id_product=:id";
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $result = $query->execute();
            if($result){
                // echo'<script type="text/javascript">
                // alert("hola");
                // </script>';
            }
        }

        // $root= $_SERVER['DOCUMENT_ROOT'];
        // $host= $_SERVER["HTTP_HOST"];
        // $url= $_SERVER["REQUEST_URI"];    
        // $name = "WhatsApp_Image_2020-10-19_at_15.31.12-removebg-preview.png";
        // $filename = $root."/freddy2/upload/".$name;
        // echo $root."/freddy2/upload/".$name;
        // unlink($filename);



    }

    // echo'<script type="text/javascript">
    // alert( '   .$id. ');
    // </script>';

    
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos</h1>
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
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Existencia</th>
                                        <th>Imagenes</th>
                                        <th>Descripcion</th>
                                        <th>Acciones
                                            <a href="panel.php?modulo=crearProducto"><i class="fa fa-plus"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once "db_ecommerce.php";
                                    $sql = "SELECT id_product,name,price,exist,description FROM productos";
                                    $query = $db->prepare($sql);
                                    $query->execute();
                                    while ($result = $query->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $result->name ?></td>
                                            <td><?php echo $result->price ?></td>
                                            <td><?php echo $result->exist ?></td>
                                            <td></td>
                                            <td><?php echo $result->description ?></td>
                                            <td>
                                                <a href="panel.php?modulo=editarUsuario&id=<?php echo $result->id_product; ?>" style="margin-right:10px"><i class="fas fa-edit"></i></a>

                                                <!-- <a href="panel.php?modulo=usuarios&idBorrar=<?php //echo  $result->id_user;
                                                                                                    ?>" class="text-danger borrar"><i class="fas fa-trash"></i></a> -->
                                                <a href="panel.php?modulo=productos&idBorrar=<?php echo  $result->id_product; ?>" class="text-danger producto"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
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