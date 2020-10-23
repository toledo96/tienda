<?php

if (isset($_SESSION['idClient'])) {
?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Datos del cliente</h2>
                <div class="form-group">
                    <label for="">Nombre (persona que recibira el producto)</label>
                    <input type="text" class="form-control" name="nombreCli">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="emaiCli">
                </div>
                <div class="form-group">
                    <label for="">Dirección</label>
                    <textarea name="direccionCli" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" name="estadoCli">
                </div>
                <div class="form-group">
                    <label for="">Municipio</label>
                    <input type="text" class="form-control" name="municipioCli">
                </div>
            </div>
        </div>
    </div>

<?php
} else {

?>

    <div class="mt-5">
        Debe <a href="login.php">logearse</a> o <a href="registro.php">registrarse</a>
    </div>

<?php
}

?>