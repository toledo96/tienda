
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
include_once 'db_ecommerce.php';
$sql = "SELECT * FROM usuarios WHERE id_user = :id";
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
    $role = $_POST['role'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    if ($name == "" or $username == "" or $email == "" or $role == "") {
        $msg = "<div class='alert alert-danger'>  <b> Error! hay campos vacios </b>  </div>";
        echo $msg;
    }
    $regex = "/^[a-zA-ZñÑáéíóú\s]+$/";
    if (preg_match($regex, $name)) {
    } else {
        $msg = "<div class='alert alert-danger'>  <b> Error! solo puede contener letras </b>  </div>";
        echo $msg;
    }

    $regex2 = "/^[a-zA-Z\s\d]+$/";
    if (preg_match($regex2, $username)) {
    } else {
        $msg = "<div class='alert alert-danger'>  <b> Error! solo puede contener letras y números </b>  </div>";
        echo $msg;
    }




    $sql = "UPDATE usuarios SET 
                    role = :role,
                    name = :name,
                    username = :username,
                    email = :email
                    WHERE id_user = :userid
                 ";
    $query = $db->prepare($sql);
    $query->bindParam(':role', $role);
    $query->bindValue(':name', $name);
    $query->bindValue(':username', $username);
    $query->bindValue(':email', $email);
    $query->bindValue(':userid', $id);
    $result = $query->execute();
    if($result){
        $msg = "<div class='alert alert-success'>  <b> Exito! se ha registrado  </b>  </div>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario creado"/>';
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
                    <h1>Editar usuario</h1>
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
                                    <label for="">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="<?php echo $result->role; ?>"> <?php echo $result->role; ?> </option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" id="name" value="<?php echo $result->name; ?>" placeholder="Nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" value="<?php echo $result->username; ?>" placeholder="Usuario" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="<?php echo $result->email; ?>" placeholder="Email" class="form-control">
                                </div>

                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="editar">Editar usuario</button>

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