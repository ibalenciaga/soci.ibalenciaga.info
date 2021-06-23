$(document).ready(function(){
    //inicializar las opciones del datepicker
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        showOn: 'button',
        buttonImageOnly: true,
    });

    //desabilitar el boton de reservar
    $("#reserva_reservar").prop("disabled",true);

    //mostrar las mesas al pulsar el boton de buscar mesa
    $("#reserva_buscar-mesa").click(function(){
        var fecha = $("#reserva_fecha").val();

        var turno = $("#reserva_turno_turno").val();
        findMesasLibresAjax(fecha,turno);
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

});