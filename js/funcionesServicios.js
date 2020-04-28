var dt;

function servicio(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fservicio").serialize();
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
                $("#titulo").html("Listado de servicios");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#servicios").removeClass("hide");
                $("#servicios").addClass("show")
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
              text: "¿Realmente desea borrar el cargo con codigo : " + codigo + " ?",
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
                                'El cargo con codigo : ' + codigo + ' fue borrado',
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
        $("#titulo").html("Listado de servicios");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#servicios").removeClass("hide");
        $("#servicios").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo empleado");
        $("#nuevo-editar" ).load("./php/servicios/nuevoServicios.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#servicios").removeClass("show");
        $("#servicios").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/clientes/controladorClientes.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#Cliente_Codi option").remove()       
              $("#Cliente_Codi").append("<option selecte value=''>Seleccione un empleado</option>")
              $.each(resultado.data, function (index, value) { 
                $("#Cliente_Codi").append("<option value='" + value.Cliente_Codi + "'>" + value.Cliente_Nom +"</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var comu_codi = $("#comu_codi").attr("value");
        var comu_nomb = $("#comu_nomb").attr("value");
        var Cliente_Codi = $("Cliente_Codi").attr("value");
        var datos = "comu_codi="+comu_codi+"&comu_nomb="+comu_nomb+"&Cliente_Codi="+Cliente_Codi;*/
      
      var datos=$("#fservicio").serialize();

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
                $("#titulo").html("Listado clientes");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#servicios").removeClass("hide");
                $("#servicios").addClass("show")
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
      $("#titulo").html("Editar Servicio");
      //Recupera datos del fromulario
      var codigo = $(this).data("codigo");
      var cargos;
       $("#nuevo-editar").load("./php/servicios/editarServicios.php");
       $("#nuevo-editar").removeClass("hide");
       $("#nuevo-editar").addClass("show");
       $("#servicios").removeClass("show");
       $("#servicios").addClass("hide");
      $.ajax({
          type:"get",
          url:"./php/servicios/controladorServicios.php",
          data: {codigo: codigo, accion:'consultar'},
          dataType:"json"
          }).done(function( empleados ) {        
               if(empleados.respuesta === "no existe"){
                   swal({
                     type: 'error',
                     title: 'Oops...',
                     text: 'empleado no existe!!!!!'                         
                   })
               } else {
                   $("#servi_codi").val(servicio.codigo);                   
                   $("#Cliente_Codi").val(servicio.cliente_cli);
                   $("#Emple_Codi").val(servicio.codigo_emp);                   
                   $("#Cargo_Codi").val(servicio.codigo_car);
                   cargos = servicio.cargos;
               }
          });

          $.ajax({
            type:"get",
            url:"./php/clientes/controladorClientes.php",
            data: {accion:'listar'},
            dataType:"json"
          }).done(function( resultado ) {                     
             $("#Cliente_Codi option").remove();
             $.each(resultado.data, function (index, value) { 
               
               if(cargos === value.Cliente_Codi){
                 $("#Cliente_Codi").append("<option selected value='" + value.Cliente_Codi + "'>" + value.Cliente_Nom + "</option>")
               }else {
                 $("#Cliente_Codi").append("<option value='" + value.Cliente_Codi + "'>" + value.Cliente_Nom + "</option>")
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
  $("#titulo").html("Listado de servicios"); 
  dt = $("#tabla").DataTable({
        "ajax": "php/servicios/controladorServicios.php?accion=listar",
        "columns": [
            { "data": "servi_codi"} ,
            { "data": "Cliente_Codi"} ,
            //{ "data": "Cliente_Nom" },
            //{ "data": "Docu_Emple" },
            { "data": "Emple_Codi" },
            //{ "data": "Emple_Nomb" },
            //{ "data": "Docu_Cli" },
            { "data": "Trata_Codi"},
            { "data": "Cargo_Codi"},
            { "data": "servi_codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "servi_codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });

  servicio();
});