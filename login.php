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
      <a href="../../index2.html"><b>Login</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php

        if (isset($_REQUEST['login'])) {
          session_start();
          include_once 'admin/db_ecommerce.php';
          $email = $_REQUEST['email'];
          $password = md5($_REQUEST['password']);
          
          //////////////////////////////
          //AQUI VAN VALIDACIONES
          /////////////////////////////

          $sql = "SELECT id_client,name,email FROM clientes WHERE email = :email AND password = :password";
          $query = $db->prepare($sql);
          $query->bindValue(':email', $email);
          $query->bindValue(':password', $password);
          $query->execute();
          $result = $query->fetch(PDO::FETCH_OBJ);
          print_r($result);
          if ($result) {
            $_SESSION['idClient'] = $result->id_client;
            $_SESSION['nameClient'] = $result->name;
            $_SESSION['emailClient'] = $result->email;
            header("location: index.php?mensaje=Bienvenido");
          } else {
            $msg = "<div class='alert alert-danger'>  <b> Error! fallo el login  </b>  </div>";
            echo $msg;
          }



        }

        ?>



        <form action="" method="post">
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
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="login">Loguearse</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <hr>
        <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
        <p class="mb-0">
          <a href="registro.php" class="text-center">Registrarse</a>
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

</body>

</html>