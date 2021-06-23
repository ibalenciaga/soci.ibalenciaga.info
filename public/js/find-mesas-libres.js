
function findMesasLibresAjax(fecha, turno){
    var Ruta = Routing.generate('find_mesas_libres_ajax');
    console.log(fecha);
    console.log(turno);
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
                console.log(data['mesas'].length);
                for (let i = 0; i<data['mesas'].length;i++){
                    campo = '<input type="checkbox" class="checkbox" id="mesa-'+i+'" name="mesas[]" value="'+data['mesas'][i]['id'] +'">mesa '+data['mesas'][i]['numero'];
                    $("#mesas-libres").append(campo);
                }
                $("#reserva_reservar").prop("disabled",false);
            }else{
                $("#mesas-libres").append('<label>no quedan mesas libres</label>');
                $("#reserva_reservar").prop("disabled",true);
            }
            data['mesas']=null;
        }
    })

}