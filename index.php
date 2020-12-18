<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,200&display=swap" rel="stylesheet">
        <!-- jQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
    <title>Inicio</title>
    <?php
    session_start();
    $accion = $_REQUEST['accion'] ?? '';
    if ($accion == 'cerrar') {
        session_destroy();
        header("Refresh:0");
    }
    ?>
</head>

<body>
    <?php
    include_once "admin/db_ecommerce.php";
    ?>

    <?php
    require_once "menu.php";
    ?>

    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12">
            <?php
            require_once "menu.php";
            ?>
            </div>
        </div> -->

        <?php
        $modulo = $_REQUEST['modulo'] ?? '';
        if ($modulo == "productos" || $modulo == "") {
            include_once "productos.php";
        }
        if ($modulo == "detalleproducto") {
            include_once "detalleProducto.php";
        }
        if ($modulo == "carrito") {
            include_once "carrito.php";
        }
        if ($modulo == "envio") {
            include_once "envio.php";
        }
        if ($modulo == "pasarela") {
            include_once "pasarela.php";
        }
        if ($modulo == "factura") {
            include_once "factura.php";
        }

        if ($modulo == "usuario") {
            include_once "usuario.php";
        }    
        if ($modulo == "contacto") {
            include_once "contacto.php";
        }
        if ($modulo == "nosotros") {
            include_once "nosotros.php";
        }

        ?>




    </div>



    <!-- jQuery UI 1.11.4 -->
    <script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- daterangepicker -->
    <script src="admin/plugins/moment/moment.min.js"></script>
    <script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="admin/dist/js/pages/dashboard.js"></script>
    <script src="js/index.js"></script>
    <script src="js/index2.js"></script>
    <script src="js/boton.js"></script>
    <script src="js/stripe.js"></script>
    <script>
        var imagenGrande = document.getElementById("grande");

        function cambiarImagen(imagen) {
            imagenGrande.src = imagen.src;
        }
    </script>
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