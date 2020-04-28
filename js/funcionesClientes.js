var dt;

function clientes(){
    $("#contenido").on("click","button#actualizar",function(){
         var datos=$("#fclientes").serialize();
         $.ajax({
            type:"get",
            url:"./php/clientes/controladorClientes.php",
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
                $("#titulo").html("Listado de clientes");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#clientes").removeClass("hide");
                $("#clientes").addClass("show")
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
              text: "¿Realmente desea borrar el cliente con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {

                    var request = $.ajax({
                        method: "get",
                        url: "./php/clientes/controladorClientes.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })

                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal(
                                'Borrado!',
                                'El cliente con codigo : ' + codigo + ' fue borrado',
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
        $("#titulo").html("Listado de clientes");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#clientes").removeClass("hide");
        $("#clientes").addClass("show");

    })

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click","button#nuevo",function(){
        $("#titulo").html("Nuevo empleado");
        $("#nuevo-editar" ).load("./php/clientes/nuevo.php"); 
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#clientes").removeClass("show");
        $("#clientes").addClass("hide");
         $.ajax({
             type:"get",
             url:"./php/tipoDocumento/controladordocumento.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {   
              //console.log(resultado.data)           
              $("#Docu_Codi option").remove()       
              $("#Docu_Codi").append("<option selecte value=''>Seleccione un tipo de documento</option>")
              $.each(resultado.data, function (index, value) { 
                $("#Docu_Codi").append("<option value='" + value.Docu_Codi + "'>" + value.Docu_Nomb +"</option>")
              });
           });
    })

    $("#contenido").on("click","button#grabar",function(){
        /*var comu_codi = $("#comu_codi").attr("value");
        var comu_nomb = $("#comu_nomb").attr("value");
        var muni_codi = $("#muni_codi").attr("value");
        var datos = "comu_codi="+comu_codi+"&comu_nomb="+comu_nomb+"&muni_codi="+muni_codi;*/
      
      var datos=$("#fclientes").serialize();

      $.ajax({
            type:"get",
            url:"./php/clientes/controladorClientes.php",
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
                $("#clientes").removeClass("hide");
                $("#clientes").addClass("show")
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
       $("#titulo").html("Editar cliente");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
  
        $("#nuevo-editar").load("./php/clientes/editar.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#cliente").removeClass("show");
        $("#cliente").addClass("hide");
       $.ajax({
           type:"get",
           url:"./php/clientes/controladorClientes.php", 
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
           }).done(function( empleados ) {
                if(empleados.respuesta === "no existe"){
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Municipio no existe!'                         
                    })
                } else {
                    $("#Cliente_Codi").val(empleados.codigo);                   
                    $("#Cliente_Nom").val(empleados.empleados);                   
                    tipo = empleados.tipo;
                }
           });

           $.ajax({
             type:"get",
             url:"./php/tipoDocumento/controladordocumento.php",
             data: {accion:'listar'},
             dataType:"json"
           }).done(function( resultado ) {                     
              $("#Docu_Codi option").remove();
              $.each(resultado.data, function (index, value) { 
                
                if(tipo === value.Docu_Nomb){
                  $("#Docu_Codi").append("<option selected value='" + value.Docu_Codi+ value.Docu_Nomb+"</option>")
                }else {
                  $("#Docu_Codi").append("<option value='" + value.Docu_Codi + value.Docu_Nomb+"</option>")
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
  $("#titulo").html("Listado de clientes"); 
  dt = $("#tabla").DataTable({
        "ajax": "php/clientes/controladorClientes.php?accion=listar",
        "columns": [
            { "data": "Cliente_Codi"} ,
            { "data": "Cliente_Nom" },
            { "data": "Cliente_Apell" },
            { "data": "Docu_Codi" },
            { "data": "Cliente_Codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' 
                }
            },
            { "data": "Cliente_Codi",
                render: function (data) {
                          return '<a href="#" data-codigo="'+ data + 
                                 '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
  });

  clientes();
});