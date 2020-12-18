$(document).ready(function () {
    $.ajax({
        type:"post",
        url:"ajax/leerCarrito.php",
        dataType:"json",
        success: function(response){
            llenarTablaPasarela(response);
        }
    });

    function llenarTablaPasarela(response){
        $("#tablaPasarela tbody").text("");
        var TOTAL = 0;
        response.forEach(element => {
            var precio = parseFloat(element['precio']);
            var totalProd = element['cantidad'] * precio;
            TOTAL = TOTAL + totalProd;
            $("#tablaPasarela tbody").append(
                `
                <tr>
                    <td> <img src="${element['web_path']}" class="img-size-50"> </td>
                    <td> ${element['nombre']} </td>
                    <td> 
                        ${element['cantidad']} 
                        <input type="hidden" name="id[]" value="${element['id']}">
                        <input type="hidden" name="cantidad[]" value="${element['cantidad']}">
                        <input type="hidden" name="precio[]" value="${totalProd.toFixed(2)}">
                    </td>
                    <td> $${precio.toFixed(2)} </td>
                    <td>$${totalProd.toFixed(2)}</td>
                <tr>
                `
            );
        });
        $("#tablaPasarela tbody").append(
            `
                <tr>
                    <td colspan="4" class="text-right"><b>Total:</b></td>
                    <td>
                        $${TOTAL.toFixed(2)}
                        <input type="hidden" name="total" value="${TOTAL.toFixed(2)*100}">
                    </td>

                <tr>
            `
        );
    }

    $(document).on("click",".mas,.menos",function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var tipo = $(this).data('tipo');
        $.ajax({
            type:"post",
            url:"ajax/cambiarCantidadProductos.php",
            data:{"id":id,"tipo":tipo},
            dataType:"json",
            success: function(response){
                llenarTablaPasarela(response);
                llenarCarrito(response);
            }
        });       
    }); 


});


