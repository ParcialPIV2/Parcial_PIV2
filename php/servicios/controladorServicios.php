
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
                $("#titulo").html("Listado empleadoses");
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
              text: "¿Realmente desea borrar el empleados con codigo : " + codigo + " ?",
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
                                'El empleados con codigo : ' + codigo + ' fue borrado',
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
        $("#empleados").removeClass("hide");
        $("#empleados").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo empleados");
        $("#nuevo-editar" ).load("./php/empleados/nuevoempleados.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#empleados").removeClass("show");
        $("#empleados").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/empleados/controladorEmpleados.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#Emple_Codi option").remove()       
              $("#Emple_Codi").append("<option selecte value=''>Seleccione un departamento</option>")
              $.each(resultado.data, function (index, value) { 
                $("#Emple_Codi").append("<option value='" + value.Emple_Codi + "'>" + value.Emple_Codi + "</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var comu_codi = $("#comu_codi").attr("value");
        var comu_nomb = $("#comu_nomb").attr("value");
        var muni_codi = $("#muni_codi").attr("value");
        var datos = "comu_codi="+comu_codi+"&comu_nomb="+comu_nomb+"&muni_codi="+muni_codi;*/
      
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
                $("#titulo").html("Listado empleados");
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
       var departamento;
       
        $("#nuevo-editar").load("./php/empleados/editar.php");
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
                      text: 'empleados no existe!'                         
                    })
                } else {
                    $("#Emple_Codi").val(empleados.codigo);                   
                    $("#Emple_Nomb").val(empleados.empleados);
                    $("#Cargo_Codi").val(empleados.capital);
                }
           });

       })
}

$(document).ready(() => {
  $("#contenido").off("click", "a.editar"); 
  $("#contenido").off("click", "button#actualizar");
  $("#contenido").off("click","a.borrar");
  $("#contenido").off("click","button#nuevo");
  $("#contenido").off("click","button#grabar");

  
  $("#titulo").html("Listado de empleados"); 
  
  dt = $("#tabla").DataTable({
        "ajax": "php/empleados/controladorEmpleados.php?accion=listar",
        "columns": [
            { "data": "Emple_Codi"} ,
            { "data": "Emple_Nomb" },
            { "data": "Cargo_Codi" },
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