<?php
    function money_format($value)
    {
        return '$' . number_format($value, 2);
    }
?>
<div class="row mt-2">
            <?php
            include_once "admin/db_ecommerce.php";
            $where = " where 1=1";
            $nombre = $_REQUEST['nombre'] ?? '';
            if (empty($nombre) == false) {
                $where = "AND name like '%" . $nombre . "%' ";
            }
            $queryCuenta = "SELECT COUNT(*) as cuenta FROM productos  $where ;";
            $resCuenta = $db->prepare($queryCuenta);
            $resCuenta->execute();
            $rowCuenta = $resCuenta->fetch(PDO::FETCH_ASSOC);
            $totalRegistros = $rowCuenta['cuenta'];

            $elementosPorPagina = 6;

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
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <div class="card border-primary">
                        <img class="img-thumbnail" src="<?php echo $result->web_path ?>" alt="">
                        <div class="card-body">
                            <h4 class="card-text"><strong><?php echo $result->name ?></strong></h4>
                            <h5 class="card-text"><strong></strong><?php echo money_format($result->price); ?></h5>
                            <h5 class="card-text"><strong></strong><?php echo $result->exist ?> Disponibles</h5>        
                            <a class="btn btn-primary btn-block" href="index.php?modulo=detalleproducto&id=<?php echo $result->id_product; ?>"> Ver producto</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        if ($totalPaginas > 0) {
        ?>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    if ($paginaSel != 1) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                    ?>
                        <li class="page-item <?php echo ($paginaSel == $i) ? " active " : " "; ?>">
                            <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($paginaSel != $totalPaginas) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
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