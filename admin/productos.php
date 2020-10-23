<div class="content-wrapper">
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
                            <table id="tablaProductos" class="table table-bordered table-hover">
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
                                    $sql = "SELECT name,price,exist,description FROM productos";
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
                                                <a href="panel.php?modulo=editarUsuario&id=<?php echo $result->id_user; ?>" style="margin-right:10px"><i class="fas fa-edit"></i></a>

                                                <a href="panel.php?modulo=usuarios&idBorrar=<?php echo  $result->id_user; ?>" class="text-danger borrar"><i class="fas fa-trash"></i></a>
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