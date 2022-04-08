function findMesasLibresAjax(fecha, turno){
    var Ruta = Routing.generate('find_mesas_libres_ajax');
    $.ajax({
        type: "POST",
        url: Ruta,
        data: ({fecha: fecha, turno: turno}),
        async: true,
        dataType: "json",
        success: function (data){
            $('.mesa').css("background-color","red");
            if(data['mesas'].length >0){
                $(".checkbox-mesas").html('');
                $(".checkbox-mesas").append('<label>mesas libres</label>');
                for (let i = 0; i<data['mesas'].length;i++){
                    campo = '<input type="checkbox" class="checkbox check-mesa" id="mesa-'+i+'" name="mesas[]" value="'+data['mesas'][i]['numero'] +'" data-mesa="'+data['mesas'][i]['numero'] +'">mesa '+data['mesas'][i]['numero'];
                    $(".checkbox-mesas").append(campo);
                    var mesa = ".mesa.mesa-"+data['mesas'][i]['numero'];
                    console.log(mesa);
                    $(mesa).css("background-color","green");
                    $(mesa).addClass("disp");
                }
                $("#mesas-libres").append(`</div>`);
                $("#reserva_reservar").prop("disabled",false);
            }else{
                $("#mesas-libres").append('<label>no quedan mesas libres</label>');
                $("#reserva_reservar").prop("disabled",true);
            }
            data['mesas']=null;
        }
    })

}