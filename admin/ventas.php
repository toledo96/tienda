<div class="content-wrapper">
    <?php

    include_once 'db_ecommerce.php';




    
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
                                        <th>Id_detalle</th>
                                        <th>Id_producto</th>
                                        <th>Id_venta</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th>Fecha</th>
  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once "db_ecommerce.php";
                                    $sql = "SELECT detalleventa.id_detail,detalleventa.id_product,detalleventa.id_sell,detalleventa.quantity,detalleventa.price,detalleventa.subtotal,ventas.date FROM detalleventa INNER JOIN ventas ON detalleventa.id_sell = ventas.id_sell";
                                    $query = $db->prepare($sql);
                                    $query->execute();
                                    while ($result = $query->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $result->id_detail ?></td>
                                            <td><?php echo $result->id_product ?></td>
                                            <td><?php echo $result->id_sell ?></td>
                                            <td><?php echo $result->quantity ?></td>
                                            <td><?php echo $result->price ?></td>
                                            <td><?php echo $result->subtotal ?></td>
                                            <td><?php echo $result->date ?></td>
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
