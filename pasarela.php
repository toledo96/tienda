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
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi nulla accusamus obcaecati sed? Ut corrupti laboriosam omnis quos odit unde dolore dicta, dolores, voluptatem beatae quasi doloribus reiciendis? Recusandae, minus.</p>
        <div class="form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="">
            Acepto los terminos y condiciones
            </label>

        </div>
    </div>


    <a class="btn btn-warning" href="index.php?modulo=envio">Ir a envio</a>
    <button type="submit" class="btn btn-primary float-right">Pagar</button>
</form>
</div>