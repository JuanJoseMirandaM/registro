/*=============================================
=            CARGAR TABLA DINAMICA            =
=============================================*/

var table = $(".tablaNotasRemision").DataTable({

    "ajax":"ajax/tablaNotasRemision.ajax.php",
    "columnDefs": [
    {
        "targets": -1,
        "data": null,
        "defaultContent": '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR" idNR><i class="fa fa-print"></i></button><button class="btn btn-sm btn-warning btnEditarNR" idNR><i class="fa fa-pencil"></i></button><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></div>'
    }
    ],
        "language" : {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
            },
            "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

});

/*=============================================
               AGREGANDO PRODUCTOS
=============================================*/

$(".btnAgregarProducto").click(function(){

    var datos = new FormData();
    datos.append("traerProductos", "ok");

    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            //console.log("respuesta", respuesta);
            $(".tablaCrearNR tbody").append(
                '<tr>'+
                    '<td>'+
                      '<button type="button" class="btn btn-danger btn-sm quitarDetalle"><i class="fa fa-times"></i></button>'+
                    '</td>'+
                    '<td>'+
                     '<div class="form-group">'+
                        '<div class="input-group">'+
                            '<select name="nuevaDescripcionProducto[]" id="nuevaDescripcionProducto" class="form-control  nuevaDescripcionProducto select2" style="width: 100%;" required>'+
                                '<option value="">Seleccione producto</option>'+
                            '</select>'+
                        '</div>'+
                      '</div>'+
                    '</td>'+
                    '<td>'+
                      '<div class="input-group">'+
                        '<input type="text" class="form-control nuevoDetalleProducto" id="nuevoDetalleProducto" name="nuevoDetalleProducto" size="200" placeholder="Detalle" required readonly>'+
                      '</div>'+
                    '</td>'+
                    '<td>'+
                      '<!-- Cantidad del producto -->'+

                      '<div class="col-lg-12 ingresoCantidad">'+
                
                        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" required>'+

                      '</div>'+
                    '</td>'+
                '</tr>'
            );

            // AGREGAR LOS PRODUCTOS AL SELECT 

             respuesta.forEach(funcionForEach);

             function funcionForEach(item, index){

                $(".nuevaDescripcionProducto").append(

                    '<option idProducto="'+item.cod_producto+'" value="'+item.descripcion_largo+'">'+item.cod_producto+'-'+item.descripcion_largo+'</option>'
                )

             }

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

            $(".nuevoPesoProducto").number(true, 2);
        }


    })

})

/*=======================================
=            QUITAR DETALLE            =
=======================================*/
$(".formularioNR").on("click", "button.quitarDetalle", function (){
    $(this).parent().parent().remove();
})

/*=============================================
SELECCIONAR PLACA
=============================================*/

$(".formularioNR").on("change", "select.nuevaPlaca", function(){

    var idProvee = $(this).val();

    var datos = new FormData();
    datos.append("idProvee", idProvee);


      $.ajax({

        url:"ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            //console.log("respuesta",respuesta);
            $(nuevoDueno).val(respuesta["nombre_com"]);
            $(nuevoChofer).val(respuesta["chofer"]);
            //$(nuevoCodCamion2).val(respuesta["cod_Camion"]);
          // AGRUPAR PRODUCTOS EN FORMATO JSON

            activarSelect();

        }

      })
})
function activarSelect(){
    $('.select2').select2({
      placeholder: 'Select an option'
    });

}

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioNR").on("change", "select.nuevaDescripcionProducto", function(){

    var nombreProducto = $(this).val();

    $(nuevoDetalleProducto).val(nombreProducto);

    /*var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


      $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            
            $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
            $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

          // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarProductos()

        }

      })*/
})

