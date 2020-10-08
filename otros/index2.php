<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,200&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="img/leafmini.png" width="125px" alt="">
                </div>
                <div class="nav">
                    <ul id="MenuItems">
                        <li><a href="">Inicio</a></li>
                        <li><a href="">Productos</a></li>
                        <li><a href="">Nosotros</a></li>
                        <li><a href="">Contacto</a></li>
                        <li><a href="">Account</a></li>
                    </ul>
                </div>
                <img src="img/cart.png" width="20px" height="20px" alt="">
                <img src="img/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
        </nav>
    </header>

    <!-- -------------------------- productos -------------------------------------- -->

    <section class="productos">
        <div class="small-container">
            <div class="row row-2">
                <h2>Todos los productos</h2>
                <form action="index2.php">
                    <input type="search" class="buscador" name="nombre" id="nombre" placeholder="buscar" value="<?php echo $_REQUEST['nombre'] ?? '';  ?>">
                    <input type="hidden" name="modulo" value="productos">
                    <button type="submit">buscar</button>
                </form>
            </div>
            <div class="row">
                <?php
                include_once "admin/db_ecommerce.php";
                $where = "WHERE 1=1";
                $nombre = $_REQUEST['nombre'] ?? '';
                if (empty($nombre) == false) {
                    $where = "and name like '%" . $nombre . "%' ";
                }
                $queryCuenta = "SELECT COUNT(*) as cuenta FROM productos  $where ;";
                $resCuenta = $db->prepare($queryCuenta);
                $resCuenta->execute();
                $rowCuenta = $resCuenta->fetch(PDO::FETCH_ASSOC);
                $totalRegistros = $rowCuenta['cuenta'];

                $elementosPorPagina = 8;

                $totalPaginas = ceil($totalRegistros / $elementosPorPagina); //ceil entrega un numero entero 



                $paginaSel = $_REQUEST['pagina'] ?? false;

                if ($paginaSel == false) {
                    $inicioLimite = 0;
                    $paginaSel = 1;
                } else {
                    $inicioLimite = ($paginaSel - 1) * $elementosPorPagina;
                }
                $limite = " limit $inicioLimite,$elementosPorPagina ";


                $sql = "SELECT p.id_product,p.name,p.price,p.exist,f.web_path FROM productos AS p 
            INNER JOIN productos_files AS pf ON pf.product_id=p.id_product
            INNER JOIN files AS f ON f.id=pf.file_id
            $where
            GROUP BY p.id_product $limite";
                $query = $db->prepare($sql);
                $query->execute();
                while ($result = $query->fetch(PDO::FETCH_OBJ)) {
                ?>

                    <div class="col-4">
                        <img src="<?php echo $result->web_path ?>" alt="">
                        <h4><?php echo $result->name ?></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>$<?php echo $result->price ?></p>
                        <p>Stock: <?php echo $result->exist ?></p>
                        <a href="#" type="button" class="btn-compra">Ver</a>
                    </div>
                <?php
                }
                ?>
            </div>

            <?php
            if ($totalPaginas > 0) {
            ?>

                <nav class="page-btn">
                    <ul>
                        <?php
                        if ($paginaSel != 1) {
                        ?>
                            <li>
                                <a href="index2.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>">
                                    <span>
                                        <</span> </a> </li> <?php
                                                        }
                                                            ?> <?php
                                                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                                                ?> <li>
                                            <a href="index2.php?modulo=productos&pagina=<?php echo $i; ?>"><span><?php echo $i; ?></span></a>
                            </li>
                        <?php
                                                                }
                        ?>
                        <?php
                        if ($paginaSel != $totalPaginas) {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="index2.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>">
                                    <span class="sr-only">></span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>

            <?php
            }
            ?>


    </section>
    <!-- <div class="page-btn">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>&#8594;</span>
        </div> -->










    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Descarga la app</h3>
                    <p>Descargala para cualquier sistema operativo</p>
                </div>
                <div class="footer-col-2">
                    <img src="img/leafmini.png" alt="">
                    <p>Nuestro proposito es poder estár contigo el tiempo que sea necesario</p>
                </div>
                <div class="footer-col-3">
                    <h3>Links de ayuda</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog</li>
                        <li>Return policy</li>
                        <li>Join affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Siguenos</h3>
                    <ul>
                        <li>facebook</li>
                        <li>twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- ---------------------- scripts ------------------------- -->
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "400px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>


</body>

</html>