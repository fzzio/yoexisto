
//funciones de filtros

function getAreasPorMunicipio( elemento  ){

    $.ajax({
        url: Routing.generate('yoexisto_buscar_areas', {municipio: $(elemento).val() }),
        success:function(  response  ){
            $("#filtro_areas").html(  response  );
            $('#filtro_areas').trigger('change');
        }
    });
}


function getActividadPorArea( elemento  ){

    $.ajax({
        url: Routing.generate('yoexisto_buscar_actividad_por_area', {area: $(elemento).val() }),
        success:function(  response  ){
            $("#actividadReciente").html(  response  );
        }
    });
}









function cerrarDetalle(){
    $("#mis-reportes").removeClass('col-md-6');
    $("#mis-reportes").addClass('col-md-8');

    $("#reporte-detalle").hide();

    $("#reportes-recientes").removeClass('col-md-3');
    $("#reportes-recientes").addClass('col-md-4');
}

function verReporte(reporte){

    //console.log("Ver detalles de reporte: " + reporte);

    var parametros = {
        idReporte: reporte
    }

    $.ajax({
        url: Routing.generate('yoexisto_reporte_detalle'),
        type: 'POST',
        async: true,
        data: parametros,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.codigo == 1) {

                $("#mis-reportes").removeClass('col-md-8');
                $("#mis-reportes").addClass('col-md-6');


                $("#drp-titulo").text( respuesta.control.titulo );
                $("#drp-autor").text( respuesta.control.autor );
                $("#drp-municipio").text( respuesta.control.municipio );
                $("#drp-area").text( respuesta.control.area );
                $("#drp-direccion").text( respuesta.control.direccion );
                $("#drp-institucion").text( respuesta.control.institucion );
                $("#drp-descripcion").text( respuesta.control.descripcion );
                $("#drp-imagen").attr("src", "/yoexistoapp/web/uploads/" + respuesta.control.imagen); //fzzio verificar
                $("#drp-votos").text( respuesta.control.votos );


                $("#reporte-detalle").show();

                $("#reportes-recientes").removeClass('col-md-4');
                $("#reportes-recientes").addClass('col-md-3');

            }

            //console.log(respuesta);
        },
        error: function (error) {
            console.log("ERROR: " + error);
        }
    });
}


function readURL(input) {
    if (input.files && input.files[0] ) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(input).closest('.custom-input-file').find('.sm-img-foto')
                .attr('src', e.target.result)
                .height(90);
            $(input).closest('.custom-input-file').find('.sm-img-foto').show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}




$(document).ready(function(){
    //google.maps.event.addDomListener(window, 'load', initialize);

    $('#btn-geobuscar').click(function() {
        //initializeZ(15,  $("#form_descripcion").val()   );
        //myLayer.clearLayers();

        geocoder.query($("#form_descripcion").val(), showMap);
        //geocoder.query($("#form_descripcion").val(), showMap);
    });


    $('#btn-geo').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        if (!navigator.geolocation) {
            $('#btn-geo .texto-geo').text("Geolocation is not available");
        } else {
            //myLayer.clearLayers();
            map.locate();
        }
    });


});