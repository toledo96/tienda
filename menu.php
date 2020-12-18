
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?modulo=nosotros">Nosotros</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?modulo=contacto">Contacto</a>
      </li>
    </ul>
    <form class="form-inline" action="index.php">
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
  </div>
</nav>