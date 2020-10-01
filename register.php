<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Principal</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>

<body>

  <?php

  include 'php_login/php_resources/User.php'

  ?>

  <?php
  $user = new User();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $usergi = $user->userRegistration($_POST);
  }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Registro</h5>
            <?php
            if (isset($usergi)) {
              echo $usergi;
            }
            ?>
            <form class="form-signin" method="POST">
              <div class="form-label-group">
                <input type="text" id="name" name="name" class="form-control" placeholder="Usuario">
                <label for="inputUserame">Nombre</label>
              </div>

              <div class="form-label-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Usuario">
                <label for="inputUserame">Usuario</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                <label for="inputEmail">Email</label>
              </div>

              <hr>

              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                <label for="inputPassword">Contraseña</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="conf_password" name="conf_password" class="form-control" placeholder="Contraseña">
                <label for="inputConfirmPassword">Confirmar contraseña</label>
              </div>

              <button type="submit" class="btn btn-lg btn-warning btn-block text-uppercase" name="register">Registrar</button>
              <a class="d-block text-center mt-2 small" href="#">Iniciar session</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>