<?php
    if(isset($_REQUEST['crear'])){
        include_once 'db_ecommerce.php';

        $role = $_REQUEST['role'];
        $name = $_REQUEST['name'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST['password']);
        $sql = "INSERT INTO usuarios (role,name, username, email, password) VALUES(:role,:name, :username, :email, :password) ";
        $query = $db->prepare($sql);
        $query->bindParam(':role', $role,PDO::PARAM_STR);
        $query->bindParam(':name', $name,PDO::PARAM_STR);
        $query->bindParam(':username', $username,PDO::PARAM_STR);
        $query->bindParam(':email', $email,PDO::PARAM_STR);
        $query->bindParam(':password', $password,PDO::PARAM_STR);
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
                    <h1>Crear usuario</h1>
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

                            <form action="panel.php?modulo=crearUsuario" method="POST">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" placeholder="Usuario" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" placeholder="Email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
                                </div>

                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="crear">Crear usuario</button>

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