<nav class="navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" action="index.php">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar bg-gray" type="search" placeholder="Search" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre'] ?? ''; ?>">
            <input type="hidden" name="modulo" value="productos">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" id="iconoCarrito">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                <span class="badge badge-danger navbar-badge" id="badgeProducto"></span>
            </a>
            <!-- aqui -->
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="listaCarrito">
                <!-- <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> -->
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <?php
                if (isset($_SESSION['idClient']) == false) {

                ?>
                    <a href="login.php" class="dropdown-item">
                        <i class="fas fa-door-open mr-2 text-primary"></i>Logearse
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="registro.php" class="dropdown-item">
                        <i class="fas fa-sign-in-alt mr-2 text-primary"></i> Registrarse
                    </a>
                <?php
                } else {
                ?>

                    <a href="index.php?modulo=usuario" class="dropdown-item">
                        <i class="fas fa-user mr-2 text-primary"></i>Hola <?php echo $_SESSION['nameClient']?>
                    </a>
                    <form action="index.php" method="post">
                        <button type="submit" name="accion" class="btn btn-danger dropdown-item" value="cerrar">
                            <i class="fas fa-door-closed mr-2 text-danger"></i>Salir
                        </button>
                    </form>

                <?php
                }
                ?>
            </div>

        </li>
    </ul>
</nav>

<?php
    // $mensaje = $_REQUEST['mensaje']??''; 
    // if($mensaje){
?>

        <!-- <div class="alert-alert-primary alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div> -->
        <?php   //echo $mensaje; ?>

<?php
   // }
?>