var dt;

function empleados(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fempleados").serialize();
         $.ajax({
            type:"get",
            url:"./php/empleados/controladorEmpleados.php",
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
                $("#titulo").html("Listado Empleados");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#empleados").removeClass("hide");
                $("#empleados").addClass("show")
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
              text: "¿Realmente desea borrar la empleados con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {

                    var request = $.ajax({
                        method: "get",
                        url: "./php/empleados/controladorEmpleados.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'La empleados con codigo : ' + codigo + ' fue borrada',
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
        $("#titulo").html("Listado Empleados");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#empleados").removeClass("hide");
        $("#empleados").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nueva empleados");
        $("#nuevo-editar" ).load("./php/empleados/nuevosEmpleados.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#empleados").removeClass("show");
        $("#empleados").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/cargo/controladorCargo.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#Cargo_Codi option").remove()       
              $("#Cargo_Codi").append("<option selecte value=''>Seleccione un cargo</option>")
              $.each(resultado.data, function (index, value) { 
                $("#Cargo_Codi").append("<option value='" + value.Cargo_Codi + "'>" + value.Tipo_Cargo + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var Emple_Codi = $("#Emple_Codi").attr("value");
        var Emple_Nomb = $("#Emple_Nomb").attr("value");
        var Cargo_Codi = $("#Cargo_Codi").attr("value");
        var datos = "Emple_Codi="+Emple_Codi+"&Emple_Nomb="+Emple_Nomb+"&Cargo_Codi="+Cargo_Codi;*/
      
      var datos=$("#fempleados").serialize();
       $.ajax({
            type:"get",
            url:"./php/empleados/controladorEmpleados.php",
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
                $("#titulo").html("Listado Empleados");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#empleados").removeClass("hide");
                $("#empleados").addClass("show")
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
       $("#titulo").html("Editar empleados");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var cargo;
        $("#nuevo-editar").load("./php/empleados/editarEmpleados.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#empleados").removeClass("show");
        $("#empleados").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/empleados/controladorEmpleados.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( empleados ) {        
                if(empleados.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'empleados no existe!!!!!'                         
                    })
                } else {
                    $("#Emple_Codi").val(empleados.codigo);                   
                    $("#Emple_Nomb").val(empleados.empleados);
                    $("#Emple_Nomb2").val(empleados.empleados);
                    cargo = empleados.cargo;
                }
           });

           $.ajax({
             type:"get",
             url:"./php/cargo/controladorCargo.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#Cargo_Codi option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(cargo === value.Cargo_Codi){
                  $("#Cargo_Codi").append("<option selected value='" + value.Cargo_Codi + "'>" + value.Tipo_Cargo + "</option>")
                }else {
                  $("#Cargo_Codi").append("<option value='" + value.Cargo_Codi + "'>" + value.Tipo_Cargo + "</option>")
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
  $("#titulo").html("Listado de Empleados");
  dt = $("#tabla").DataTable({
        "ajax": "php/empleados/controladorEmpleados.php?accion=listar",
        "columns": [
            { "data": "Emple_Codi"} ,
            { "data": "Emple_Nomb" },
            { "data": "Emple_Nomb2" },
            { "data": "Tipo_Cargo" },
            { "data": "Emple_Codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "Emple_Codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });
  empleados();
});