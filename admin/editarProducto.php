
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
include_once 'db_ecommerce.php';
$sql = "SELECT * FROM productos WHERE id_product = :id";
$query = $db->prepare($sql);
$query->bindValue(':id', $id);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
// print_r($result);
?>

<?php
include_once 'db_ecommerce.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $name = $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $exist = $_REQUEST['exist'];

    if ($name == "" or $price == ""  or $exist == "") {
        $msg = "<div class='alert alert-danger'>  <b> Error! hay campos vacios </b>  </div>";
        echo $msg;
    }


    $sql = "UPDATE productos SET 
                    name = :name,
                    price = :price,
                    exist = :exist
                    WHERE id_product = :userid
                 ";
    $query = $db->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':price', $price);
    $query->bindValue(':exist', $exist);
    $query->bindValue(':userid', $id);
    $result = $query->execute();
    if($result){
        $msg = "<div class='alert alert-success'>  <b> Exito! se ha registrado  </b>  </div>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=producto editado"/>';
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
                    <h1>Editar producto</h1>
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
                            <form method="POST">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" id="name" value="<?php echo $result->name; ?>" placeholder="Nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">precio</label>
                                    <input type="text" name="price" value="<?php echo $result->price; ?>" placeholder="Precio" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Existencia</label>
                                    <input type="text" name="exist" value="<?php echo $result->exist; ?>" placeholder="Existencia" class="form-control">
                                </div>

                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="editar">Editar producto</button>

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