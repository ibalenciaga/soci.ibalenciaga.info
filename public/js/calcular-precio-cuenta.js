$(document).ready(function(){
    var suma = 0;
    $('.cantidad').on("change paste keyup", function() {
        var suma = 0;
        $('.cantidad').each(function(key){
            if($(this).val() == ""){
                var cantidad = 0;
            }else{
                var cantidad = $(this).val();
            }

            var precio = $(this).data("precio");
            console.log(cantidad);
            console.log(precio);
            suma += parseFloat(cantidad) * parseFloat(precio);

        });
        console.log("suma = " + parseFloat(suma.toFixed(2)));
        $("#total").text(suma.toFixed(2));
        $("#reserva_precio").val(suma.toFixed(2));
    });

});