
function findMesasLibresAjax(fecha, turno){
    var Ruta = Routing.generate('find_mesas_libres_ajax');
    $.ajax({
        type: "POST",
        url: Ruta,
        data: ({fecha: fecha, turno: turno}),
        async: true,
        dataType: "json",
        success: function (data){
            $("#mesas-libres").empty();

            if(data['mesas'].length >0){
                $("#mesas-libres").append('<label>mesas libres</label>');
                for (var i in data['mesas']){
                    campo = '<input type="checkbox" class="checkbox" id="mesa-'+i+'" name="mesas[]" value="'+data['mesas'][i]['id'] +'">mesa '+data['mesas'][i]['numero'];
                    $("#mesas-libres").append(campo);
                }
                $("#reserva_reservar").prop("disabled",false);
                //recargar el archivo main.js para que el jquery se pueda usar en ellos
                $.getScript("../js/main.js");
            }else{
                $("#mesas-libres").append('<label>no quedan mesas libres</label>');
                $("#reserva_reservar").prop("disabled",true);
            }
        }
    })

}