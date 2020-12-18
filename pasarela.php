<div class="container">
<form action="index.php?modulo=factura" method="post" id="payment-form">
    <table class="table table-striped table-inverse" id="tablaPasarela">

        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>

    </table>
    <div class="form-row mb-3">
        <label for="card-element">
            Datos de su tarjeta
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>  

    <div class="mb-3">
        <h4>Terminos y condiciones</h4>
        <p>
        El usuario acepta los terminos y condiciones de uso del sito web AgroInc al realizar su compra, guardaremos sus datos personales de su cuenta para poder realizar el cobro en el portal
        de stripe y asi mismo poder mandar la informacion necesaria para hacer llegar el producto hasta el domicilio que se ha seleccionado. <br>
        1. Las compras relizadas en el e-comerce no pueden ser cambiadas en los usuarios unas vez aceptada la compra. <br>
        2. Los datos de envio seleccionados no pueden ser remplazados por otros datos de envio. <br>
        3. El nombre del usuario tiene que coincidir con la persona que recibe el paquete en el domicilio. <br>
        </p>
        <div class="form-check">
            <label class="form-check-label">
            <input type="checkbox" id="check" class="form-check-input" value="1">
            Acepto los temrinos y condiciones del e-comerce AgroInc
            </label>

        </div>
    </div>


    <a class="btn btn-warning" href="index.php?modulo=envio">Ir a envio</a>
    <button type="submit" class="btn btn-primary float-right " id="boton-pagar">Pagar</button>
</form>
</div>