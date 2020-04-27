var dt;

function clientes() {
    $("#contenido").on("click", "button#actualizar", function() {
        var datos = $("#fclientes").serialize();
        $.ajax({
            type: "get",
            url: "./php/clientes/controladorClientes.php",
            data: datos,
            dataType: "json"
        }).done(function(resultado) {
            if (resultado.respuesta) {
                swal(
                    'Actualizado!',
                    'Se actaulizaron los datos correctamente',
                    'success'
                )
                dt.ajax.reload();
                $("#titulo").html("Listado Clientes");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#cliente").removeClass("hide");
                $("#cliente").addClass("show")
            } else {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                })
            }
        });
    })

    $("#contenido").on("click", "a.borrar", function() {
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");

        swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar el o la cliente con codigo : " + codigo + " ?",
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
                    data: { codigo: codigo, accion: 'borrar' },
                    dataType: "json"
                })

                request.done(function(resultado) {
                    if (resultado.respuesta == 'correcto') {
                        swal(
                            'Borrado!',
                            'El o la cliente con codigo : ' + codigo + ' fue borrad@',
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

                request.fail(function(jqXHR, textStatus) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!' + textStatus
                    })
                });
            }
        })

    });

    $("#contenido").on("click", "button.btncerrar2", function() {
        $("#titulo").html("Listado Clientes");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#cliente").removeClass("hide");
        $("#cliente").addClass("show");

    })

    $("#contenido").on("click", "button.btncerrar", function() {
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $("#contenido").html('')
    })

    $("#contenido").on("click", "button#nuevo", function() {
        $("#titulo").html("Nueva Cliente");
        $("#nuevo-editar").load("./php/clientes/nuevoCliente.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#cliente").removeClass("show");
        $("#cliente").addClass("hide");
        $.ajax({
            type: "get",
            url: "./php/tipodedocumento/controladorTipodedocumento.php",
            data: { accion: 'listar' },
            dataType: "json"
        }).done(function(resultado) {
            //console.log(resultado.data)           
            $("#Docu_Codi option").remove()
            $("#Docu_Codi").append("<option selecte value=''>Seleccione un tipo de documento</option>")
            $.each(resultado.data, function(index, value) {
                $("#Docu_Codi").append("<option value='" + value.Docu_Codi + "'>" + value.muni_nomb + "</option>")
            });
        });
    })

    $("#contenido").on("click", "button#grabar", function() {
        /*var Cliente_Codi = $("#Cliente_Codi").attr("value");
        var Cliente_Nom = $("#Cliente_Nom").attr("value");
        var Docu_Codi = $("#Docu_Codi").attr("value");
        var datos = "Cliente_Codi="+Cliente_Codi+"&Cliente_Nom="+Cliente_Nom+"&Docu_Codi="+Docu_Codi;*/

        var datos = $("#fcliente").serialize();
        $.ajax({
            type: "get",
            url: "./php/cliente/controladorCliente.php",
            data: datos,
            dataType: "json"
        }).done(function(resultado) {
            if (resultado.respuesta) {
                swal(
                    'Grabado!!',
                    'El registro se grabó correctamente',
                    'success'
                )
                dt.ajax.reload();
                $("#titulo").html("Listado Clientes");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#cliente").removeClass("hide");
                $("#cliente").addClass("show")
            } else {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                })
            }
        });
    });


    $("#contenido").on("click", "a.editar", function() {
        $("#titulo").html("Editar Cliente");
        //Recupera datos del fromulario
        var codigo = $(this).data("codigo");
        var tipodedocumento;
        $("#nuevo-editar").load("./php/clientes/editarCliente.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#clientes").removeClass("show");
        $("#clientes").addClass("hide");
        $.ajax({
            type: "get",
            url: "./php/clientes/controladorClientes.php",
            data: { codigo: codigo, accion: 'consultar' },
            dataType: "json"
        }).done(function(cliente) {
            if (cliente.respuesta === "no existe") {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cliente no existe!!!!!'
                })
            } else {
                $("#Cliente_Codi").val(cliente.codigo);
                $("#Cliente_Nom").val(cliente.cliente);
                tipodedocumento = cliente.tipodedocumento;
            }
        });

        $.ajax({
            type: "get",
            url: "./php/tipodedocumento/controladorTipodedocumento.php",
            data: { accion: 'listar' },
            dataType: "json"
        }).done(function(resultado) {
            $("#Docu_Codi option").remove();
            $.each(resultado.data, function(index, value) {

                if (tipodedocumento === value.Docu_Codi) {
                    $("#Docu_Codi").append("<option selected value='" + value.Docu_Codi + "'>" + value.muni_nomb + "</option>")
                } else {
                    $("#Docu_Codi").append("<option value='" + value.Docu_Codi + "'>" + value.muni_nomb + "</option>")
                }
            });
        });

    })
}

$(document).ready(() => {
    $("#contenido").off("click", "a.editar");
    $("#contenido").off("click", "button#actualizar");
    $("#contenido").off("click", "a.borrar");
    $("#contenido").off("click", "button#nuevo");
    $("#contenido").off("click", "button#grabar");
    $("#titulo").html("Listado de Clientes");
    dt = $("#tabla").DataTable({
        "ajax": "php/clientes/controladorClientes.php?accion=listar",
        "columns": [
            { "data": "Cliente_Codi" },
            { "data": "Cliente_Nom" },
            { "data": "muni_nomb" },
            {
                "data": "Cliente_Codi",
                render: function(data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                }
            },
            {
                "data": "Cliente_Codi",
                render: function(data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
    });
    cliente();
});