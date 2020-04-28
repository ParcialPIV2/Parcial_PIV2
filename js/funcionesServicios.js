var dt;

function servicios(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fservicios").serialize();
         $.ajax({
            type:"get",
            url:"./php/servicios/controladorServicios.php",
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
                $("#titulo").html("Listado servicios");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#servicio").removeClass("hide");
                $("#servicio").addClass("show")
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
              text: "¿Realmente desea borrar el servicio con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {

                    var request = $.ajax({
                        method: "get",
                        url: "./php/servicios/controladorServicios.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'El sercicio con codigo : ' + codigo + ' fue borrada',
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
        $("#titulo").html("Listado servicios");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#servicio").removeClass("hide");
        $("#servicio").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo servicio");
        $("#nuevo-editar" ).load("./php/servicios/nuevaServicios.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#servicio").removeClass("show");
        $("#servicio").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/servicios/controladorServicios.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#Servi_Codi option").remove()       
              $("#Servi_Codi").append("<option selecte value=''>Seleccione un servicio</option>")
              $.each(resultado.data, function (index, value) { 
                $("#Servi_Codi").append("<option value='" + value.Servi_Codi + "'>" + value.Tipo_Servi + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var Servi_Codi = $("#Servi_Codi").attr("value");
        var Tipo_Servi = $("#Tipo_Servi").attr("value");
        var Servi_Codi = $("#Servi_Codi").attr("value");
        var datos = "Servi_Codi="+Servi_Codi+"&Tipo_Servi="+Tipo_Servi+"&Servi_Codi="+Servi_Codi;*/
      
      var datos=$("#fservicios").serialize();
       $.ajax({
            type:"get",
            url:"./php/servicios/controladorServicios.php",
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
                $("#titulo").html("Listado servicios");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#servicio").removeClass("hide");
                $("#servicio").addClass("show")
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
       $("#titulo").html("Editar Departamento");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var departamento;
        $("#nuevo-editar").load("./php/departamento/editarDepartamento.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#servicio").removeClass("show");
        $("#servicio").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/servicios/controladorServicios.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( departamento ) {        
                if(departamento.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'departamento no existe!!!!!'                         
                    })
                } else {
                    $("#Servi_Codi").val(departamento.codigo);                   
                    $("#Tipo_Servi").val(departamento.departamento);
                    departamento = departamento.departamento;
                }
           });

           $.ajax({
             type:"get",
             url:"./php/servicios/controladorServicios.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#Servi_Codi option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(departamento === value.Servi_Codi){
                  $("#Servi_Codi").append("<option selected value='" + value.Servi_Codi + "'>" + value.Tipo_Servi + "</option>")
                }else {
                  $("#Servi_Codi").append("<option value='" + value.Servi_Codi + "'>" + value.Tipo_Servi + "</option>")
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
  $("#titulo").html("Listado de departamentos");
  dt = $("#tabla").DataTable({
        "ajax": "php/departamento/controladorDepartamento.php?accion=listar",
        "columns": [
            { "data": "Servi_Codi"} ,
            { "data": "Tipo_Servi" },
            { "data": "pais_nomb" },
            { "data": "Servi_Codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "Servi_Codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });
  servicios();
});