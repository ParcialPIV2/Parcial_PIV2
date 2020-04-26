var dt;

function pais(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fpais").serialize();
         $.ajax({
            type:"get",
            url:"./php/pais/controladorPais.php",
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
                $("#titulo").html("Listado Pais");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#pais").removeClass("hide");
                $("#pais").addClass("show")
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
              text: "¿Realmente desea borrar el pais con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {

                    var request = $.ajax({
                        method: "get",
                        url: "./php/pais/controladorPais.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'El pais con codigo : ' + codigo + ' fue borrado',
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
        $("#titulo").html("Listado de paises");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#pais").removeClass("hide");
        $("#pais").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo Pais");
        $("#nuevo-editar" ).load("./php/pais/nuevoPais.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#Pais").removeClass("show");
        $("#Pais").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/municipio/controladorMunicipio.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#municodi option").remove()       
              $("#municodi").append("<option selecte value=''>Seleccione un municipio</option>")
              $.each(resultado.data, function (index, value) { 
                $("#municodi").append("<option value='" + value.pais_codi + "'>" + value.pais_nomb + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var comu_codi = $("#comu_codi").attr("value");
        var comu_nomb = $("#comu_nomb").attr("value");
        var pais_codi = $("#pais_codi").attr("value");
        var datos = "comu_codi="+comu_codi+"&comu_nomb="+comu_nomb+"&pais_codi="+pais_codi;*/
      
      var datos=$("#fpais").serialize();

      $.ajax({
            type:"get",
            url:"./php/pais/controladorPais.php",
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
                $("#titulo").html("Listado de paises");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#pais").removeClass("hide");
                $("#pais").addClass("show")
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
       $("#titulo").html("Editar Pais");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var municipio;
       
        $("#nuevo-editar").load("./php/pais/editarPais.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#Pais").removeClass("show");
        $("#Pais").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/pais/controladorPais.php", 
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( pais ) {
                if(pais.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Pais no existe!'                         
                    })
                } else {
                    $("#pais_codi").val(pais.codigo);                   
                    $("#pais_nomb").val(pais.pais);
                    municipio = pais.municipio;
                }
           });

           $.ajax({
             type:"get",
             url:"./php/municipio/controladormunicipio.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#pais_codi option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(municipio === value.pais_codi){
                  $("#pais_codi").append("<option selected value='" + value.pais_codi + "'>" + value.pais_nomb + "</option>")
                }else {
                  $("#pais_codi").append("<option value='" + value.pais_codi + "'>" + value.pais_nomb + "</option>")
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

  
  $("#titulo").html("Listado de paises"); 
  
  dt = $("#tabla").DataTable({
        "ajax": "php/pais/controladorPais.php?accion=listar",
        "columns": [
            { "data": "pais_codi"} ,
            { "data": "pais_nomb" },
            { "data": "muni_nomb" },
            { "data": "pais_codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "pais_codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });

  pais();
});