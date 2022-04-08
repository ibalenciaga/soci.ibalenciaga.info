$(document).ready(function(){
    //desabilitar el boton de reservar
    $("#reserva_reservar").prop("disabled",true);

    //mostrar las mesas al pulsar el boton de buscar mesa
    $("#reserva_buscar-mesa").click(function(){
        var fecha = $("#reserva_fecha").val();
        var turno = $("#reserva_turno_turno").val();
        findMesasLibresAjax(fecha,turno);

    });

    //colorear las mesas por disponibilidad
    $(".mesa").click(function(){
        let mesa = $(this).data("mesa");
        if($(this).hasClass("elegida")){
            $(this).css("background-color","green");
            $(this).removeClass("elegida");
            $('[data-mesa="'+mesa+'"]').prop('checked',false);
        }else{
            var cont = 0;
            $('.mesa').each(function() {
                if($(this).hasClass("elegida")){
                    cont ++;
                }
            });
            if(cont >= 2 && $(this).hasClass("disp")){
                alert("no puedes coger más de dos mesas");
            }else{
                if($(this).hasClass("disp")){
                    if($(this).hasClass("elegida")){
                        $(this).css("background-color","green");
                        $(this).removeClass("elegida");
                        $('[data-mesa="'+mesa+'"]').prop('checked',false);
                    }else{
                        $(this).css("background-color","blue");
                        $(this).addClass("elegida");
                        $('[data-mesa="'+mesa+'"]').prop('checked',true);
                    }
                }
            }
        }
    });

    //activar el boton de reserva cuando se elije por lo menos una mesa
    $('.checkbox').change(function() {
        $("#reserva_reservar").prop("disabled",true);
        var mesas = new Array();
        $('.checkbox:checked').each(function() {
            $("#reserva_reservar").prop("disabled",false);
            mesas.push($(this).val());
        });
        $("#reserva_mesas").val(mesas);
    });

    //CUENTAS
    //desabilitar los textbox de precio unitario e importe
    $(".nombre").prop("disabled",true);
    $(".importe").prop("disabled",true);
    $(".precio-unitario").prop("disabled",true);
});


