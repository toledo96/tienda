<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ecommerce login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Registro</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"></p>
                <?php

                if (isset($_REQUEST['registro'])) {
                    session_start();
                    include_once 'admin/db_ecommerce.php';
                    $name = $_REQUEST['name'];
                    $email = $_REQUEST['email'];
                    $password = md5($_REQUEST['password']);
                    $address = $_REQUEST['address'];
                    $cellphone = $_REQUEST['cellphone'];
                    $state = $_REQUEST['state'];
                    $municipality = $_REQUEST['municipality'];

                    //////////////////////////////
                    //AQUI VAN VALIDACIONES
                    /////////////////////////////

                    // $sql = "SELECT id_client,name,email FROM clientes WHERE email = :email AND password = :password";
                    $sql = "INSERT INTO clientes (name,email,password,address,cellphone,state,municipality) VALUES (:name,:email,:password,:address,:cellphone,:state,:municipality)  ";
                    $query = $db->prepare($sql);
                    $query->bindParam(':name', $name, PDO::PARAM_STR);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->bindParam(':password', $password, PDO::PARAM_STR);
                    $query->bindParam(':address', $address, PDO::PARAM_STR);
                    $query->bindParam(':cellphone', $cellphone, PDO::PARAM_STR);
                    $query->bindParam(':state', $state, PDO::PARAM_STR);
                    $query->bindParam(':municipality', $municipality, PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_OBJ);
                    // print_r($result);
                    if ($result) {

                ?>

                        <div class="alert alert-primary" role="alert">
                            <b>Registro realizado</b> <a href="login.php">Ir al login</a>
                        </div>

                    <?php

                    } else {

                    ?>

                        <div class="alert alert-primary" role="alert">
                            <b>Registro realizado</b> <a href="login.php">Ir al login</a>
                        </div>

                <?php
                    }
                }
                ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Nombre completo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="address" placeholder="direccion">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cellphone" placeholder="Telefono">
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
                            <button type="submit" class="btn btn-primary btn-block" name="registro">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <hr>
                <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
                <p class="mb-0">
                    <a href="login.php" class="text-center">LogIn</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script>
        $(document).ready(function() {
            let dropdown = $('#estados');
            dropdown.empty();
            dropdown.append('<option selected="true" disabled>Estados</option>')

            let municipio = $('#municipios');
            municipio.empty();
            municipio.append('<option selected="true" disabled>Municipios</option>')

            var estado;

            $.ajax({
                type: "GET",
                url: "https://api-sepomex.hckdrk.mx/query/get_estados",
                dataType: "json",
                success: function(data) {
                    var datos = data.response.estado;

                    $.each(datos, function(i, item) {
                        var option = "<option>" + item + "</option";
                        $("#estados").append(option);
                    });

                    $('#estados').on('change', function() {
                        estado = dropdown.val();
                        console.log(estado)
                        $.ajax({
                            type: "GET",
                            url: "https://api-sepomex.hckdrk.mx/query/get_municipio_por_estado/" + estado,
                            dataType: "json",
                            success: function(data) {
                                municipio.empty();
                                var datos = data.response.municipios;
                                $.each(datos, function(i, item) {
                                    var option = "<option>" + item + "</option";
                                    $("#municipios").append(option);
                                });
                            }

                        })
                    });

                },
            });
        });
    </script>

</body>

</html>