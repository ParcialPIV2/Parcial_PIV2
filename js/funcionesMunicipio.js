
var dt;

function municipio(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fmunicipio").serialize();
         $.ajax({
            type:"get",
            url:"./php/municipio/controladorMunicipio.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal(
                    'Actualizado!',
                    'Se actaulizaron los datos correctamente',
                    'success'
                )     
                dt.ajax.reload();
                $("#titulo").html("Listado Municipios");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#municipio").removeClass("hide");
                $("#municipio").addClass("show")
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    })

    $("#contenido").on("click","a.borrar",function(){
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");

        swal({
              title: '¿Está seguro?',
              text: "¿Realmente desea borrar el municipio con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {

                    var request = $.ajax({
                        method: "get",
                        url: "./php/municipio/controladorMunicipio.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'El municipio con codigo : ' + codigo + ' fue borrado',
                                'success'
                            )     
                            dt.ajax.reload();                            
                        } else {
                            swal({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Something went wrong!'                         
                            })
                        }
                    });
                     
                    request.fail(function( jqXHR, textStatus ) {
                        swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!' + textStatus                          
                        })
                    });
                }
        })

    });

    $("#contenido").on("click","button.btncerrar2",function(){
        $("#titulo").html("Listado de Muicipios");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#municipio").removeClass("hide");
        $("#municipio").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo Municipio");
        $("#nuevo-editar" ).load("./php/municipio/nuevoMunicipio.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#municipio").removeClass("show");
        $("#municipio").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/municipio/controladorMunicipio.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#depa_codi option").remove()       
              $("#depa_codi").append("<option selecte value=''>Seleccione un departamento</option>")
              $.each(resultado.data, function (index, value) { 
                $("#depa_codi").append("<option value='" + value.depa_codi + "'>" + value.depa_nomb + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var comu_codi = $("#comu_codi").attr("value");
        var comu_nomb = $("#comu_nomb").attr("value");
        var muni_codi = $("#muni_codi").attr("value");
        var datos = "comu_codi="+comu_codi+"&comu_nomb="+comu_nomb+"&muni_codi="+muni_codi;*/
      
      var datos=$("#fmunicipio").serialize();

      $.ajax({
            type:"get",
            url:"./php/municipio/controladorMunicipio.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal(
                    'Grabado!!',
                    'El registro se grabó correctamente',
                    'success'
                )     
                dt.ajax.reload();
                $("#titulo").html("Listado municipios");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#municipio").removeClass("hide");
                $("#municipio").addClass("show")
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    });


    $("#contenido").on("click","a.editar",function(){     
       $("#titulo").html("Editar Municipio");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var departamento;
       
        $("#nuevo-editar").load("./php/municipio/editarMunicipio.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#municipio").removeClass("show");
        $("#municipio").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/municipio/controladorMunicipio.php", 
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( municipio ) {
                if(municipio.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Municipio no existe!'                         
                    })
                } else {
                    $("#muni_codi").val(municipio.codigo);                   
                    $("#muni_nomb").val(municipio.municipio);
                    departamento = municipio.departamento;
                }
           });

           $.ajax({
             type:"get",
             url:"./php/departamento/controladorDepartamento.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#depa_codi option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(departamento === value.depa_codi){
                  $("#depa_codi").append("<option selected value='" + value.depa_codi + "'>" + value.depa_nomb + "</option>")
                }else {
                  $("#depa_codi").append("<option value='" + value.depa_codi + "'>" + value.depa_nomb + "</option>")
                }
              });
           });

       })
}

$(document).ready(() => {
  $("#contenido").off("click", "a.editar"); 
  $("#contenido").off("click", "button#actualizar");
  $("#contenido").off("click","a.borrar");
  $("#contenido").off("click","button#nuevo");
  $("#contenido").off("click","button#grabar");

  
  $("#titulo").html("Listado de Muicipios"); 
  
  dt = $("#tabla").DataTable({
        "ajax": "php/municipio/controladorMunicipio.php?accion=listar",
        "columns": [
            { "data": "muni_codi"} ,
            { "data": "muni_nomb" },
            { "data": "depa_nomb" },
            { "data": "muni_codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "muni_codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });

  municipio();
});