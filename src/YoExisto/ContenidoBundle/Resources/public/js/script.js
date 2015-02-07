
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
        url: Routing.generate('yoexisto_buscar_actividad_por_area', {area: $(elemento).val()  , estado: $("#filtro_estado").val() }),
        success:function(  response  ){
            $("#actividadReciente").html(  response  );
        }
    });
}



function getActividadPorEstado( elemento  ){

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



function votar( elemento, id_reporte ){


    $.ajax({
        url: Routing.generate('yoexisto_votar_control' , { id_control : id_reporte  }),
        type: 'POST',
        async: true,
        dataType: "json",
        success: function (respuesta) {

            if(  respuesta.codigo == 1 ){
                $(elemento).parents(".c-reporte-reciente").find(".reporte-footer .drp-votos").html( respuesta.votos );
                $(elemento).parents(".c-reporte-reciente").find(".reporte-footer .btn-voto").hide();
            }


        },
        error: function (error) {
            console.log("ERROR: " + error);
        }
    });

}


function mostrarReporte(elemento){
    $(elemento).parents(".c-reporte-reciente").find(".reporte-footer").slideToggle();
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


    $('#filtros-collapsible').click(function() {
        $("#cont-filtros").slideToggle();
        $("#filtros-collapsible .f-icono").toggleClass( 'open' );
        
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