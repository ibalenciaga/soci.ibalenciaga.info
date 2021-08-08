$(document).ready(function(){
    var suma = 0;
    $('.cantidad').on("change paste keyup", function() {
        var total = 0;
        var importe = 0;
        $('.cantidad').each(function(key){
            if($(this).val() == ""){
                var cantidad = 0;
            }else{
                var cantidad = $(this).val();
            }

            var precio = $(this).data("precio");
            var idProducto = $(this).data("producto");
            console.log(idProducto);
            //console.log(cantidad);
            //console.log(precio);
            importe = parseFloat(cantidad) * parseFloat(precio);
            if(importe != 0)
            $("#"+idProducto).val(importe.toFixed(2));

            total += parseFloat(cantidad) * parseFloat(precio);
        });
        //console.log("suma = " + parseFloat(total.toFixed(2)));
        $("#total").text(total.toFixed(2));
        $("#reserva_precio").val(total.toFixed(2));
    });

});