/*=============================================
=            CARGAR TABLA DINAMICA            =
=============================================*/
//<button class="btn btn-sm btn-success btnPostear"idNR><i class="fa fa-check"></i></button>

var table = $(".tablaNotasRemision").DataTable({

    "ajax":"ajax/tablaNotasRemision.ajax.php",
    "columnDefs": [
    {
        "targets": -1,
        "data": null,
        "render": function ( data, type, row, meta ) {
            if (data[10]=='D') {
                return '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR" idNR="'+data[9]+'"><i class="fa fa-print"></i></button><button class="btn btn-sm btn-warning btnEditarNR" idNR="'+data[9]+'"><i class="fa fa-pencil"></i></button></div>';
            }else{
                return '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR"  idNR="'+data[9]+'"><i class="fa fa-print"></i></button><button class="btn btn-sm btn-default btnEditarNR" disabled idNR="'+data[9]+'"><i class="fa fa-pencil"></i></button></div>';
            }
          
        }
        //"defaultContent": '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR" idNR><i class="fa fa-print"></i></button><button class="btn btn-sm btnEditarNR" idNR><i class="fa fa-pencil"></i></button></div>'
    }
    ],
    "order": [
        [0, 'desc']
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
FUNCIÓN PARA CARGAR BUTTON EDITAR
=============================================

function cargarbtnEditar(){

    var btnEditarNR = $(".btnEditarNR");
    //console.log("respuesta123",btnEditarNR);

    for(var i = 0; i < btnEditarNR.length; i ++){

        var data = table.row( $(btnEditarNR[i]).parents("tr")).data(); 
        
        if(data[10] == 'D'){

            $(btnEditarNR[i]).addClass("btn-warning");


        }else{
            $(btnEditarNR[i]).addClass("btn-default");
            $(btnEditarNR[i]).attr("disabled", "disabled");

        }

    }

}

/*=============================================
CARGAMOS BUTTON EDITAR CUANDO ENTRAMOS A LA PÁGINA POR PRIMERA VEZ
=============================================

setTimeout(function(){

    cargarbtnEditar();

},300)

/*=============================================
CARGAMOS BUTTON EDITAR CUANDO INTERACTUAMOS CON EL PAGINADOR
=============================================

$(".dataTables_paginate").click(function(){

    cargarbtnEditar();
})

/*=============================================
CARGAMOS BUTTON EDITAR CUANDO INTERACTUAMOS CON EL BUSCADOR
=============================================
$("input[aria-controls='DataTables_Table_0']").focus(function(){

    $(document).keyup(function(event){

        event.preventDefault();

        cargarbtnEditar();

    })


})

/*=============================================
CARGAMOS BUTTON EDITAR CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD
=============================================

$("select[name='DataTables_Table_0_length']").change(function(){

    cargarbtnEditar();

})

/*=============================================
CARGAMOS BUTTON EDITAR CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR
=============================================

$(".sorting").click(function(){

    cargarbtnEditar();

})


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
            

            $(".nuevoProducto").append(

            '<div class="row" style="padding:5px 15px">'+

              '<!-- Cantidad del producto -->'+

              '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 ingresoCantidad">'+

                '<div class="input-group">'+
                  
                  '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarDetalle" idProducto><i class="fa fa-times"></i></button></span>'+

                  '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" value="0" stock nuevoStock required>'+

                  '</select>'+  

                '</div>'+
                

              '</div>' +

              '<!-- Codigo del producto -->'+
              
              '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 " style="padding-right:0px">'+
              
                '<div class="input-group">'+

                  '<select class="form-control nuevaDescripcionProducto" name="nuevaDescripcionProducto" required>'+

                  '<option>Seleccione el producto</option>'+

                  '</select>'+  

                '</div>'+

              '</div>'+

            

              '<!-- Descripcion del producto -->'+

              '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10 ingresoDetalle" style="padding-right:0px">'+

                '<div class="input-group col-xs-12">'+
                     
                  '<input type="text" class="form-control nuevoDetalleProducto" name="nuevoDetalleProducto" readonly required>'+
     
                '</div>'+
                 
              '</div>'+

            '</div>');

            // AGREGAR LOS PRODUCTOS AL SELECT 

             respuesta.forEach(funcionForEach);

             function funcionForEach(item, index){

                $(".nuevaDescripcionProducto").append(

                    '<option idProducto="'+item.cod_producto+'" value="'+item.cod_producto+'">'+item.cod_producto+'-'+item.descripcion_largo+'</option>'
                )

             }
            activarSelect();

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

            //$(".nuevoPesoProducto").number(true, 2);
        }


    })

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioNR").on("change", "select.nuevaDescripcionProducto", function(){

    var cod_producto = $(this).val();
    
    var nuevoDetalleProducto = $(this).parent().parent().parent().children(".ingresoDetalle").children().children(".nuevoDetalleProducto");

    //var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    var datos = new FormData();
    datos.append("cod_producto", cod_producto);


    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            //console.log("respuesta",respuesta);
            //$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
            //$(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
            $(nuevoDetalleProducto).val(respuesta["descripcion_largo"]);
            //$(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

            // AGRUPAR PRODUCTOS EN FORMATO JSON 
            listarProductos()         
        }

    })

    
})

/*=======================================
=            QUITAR PRODUCTOS           =
=======================================*/
$(".formularioNR").on("click", "button.quitarDetalle", function (){
    $(this).parent().parent().parent().parent().remove();

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
})

/*=============================================
        SELECCIONAR PLACA CAMION
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
            $(nuevoCodCamion).val(respuesta["cod_provee"]);
            $(nuevaPlacaCamion).val(respuesta["placa_camion"]);
          
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
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioNR").on("change", "input.nuevaCantidadProducto", function(){

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

    var listaProductos = [];

    var codigo = $(".nuevaDescripcionProducto");

    var descripcion = $(".nuevoDetalleProducto");

    var cantidad = $(".nuevaCantidadProducto");

    for(var i = 0; i < descripcion.length; i++){

        listaProductos.push({ "codigo" : $(codigo[i]).val(),
                              "descripcion" : $(descripcion[i]).val(),
                              "cantidad" : $(cantidad[i]).val()
                            })

    }
    //console.log("listaProductos",JSON.stringify(listaProductos));
    $("#listaProductos").val(JSON.stringify(listaProductos)); 

}

/*======================================
=          EDITAR NOTA REMISION          =
======================================*/
$(".tablaNotasRemision").on("click",".btnEditarNR",function(){
    //var data = table.row( $(this).parents('tr') ).data();
    //console.log("respuesta",data);
    //$(this).attr("idNR", data[9]);  

    var idNR = $(this).attr("idNR");  
    //console.log("idNR",idNR);
    window.location = "index.php?ruta=editar-notaremision&idNR="+idNR

})

/*======================================
=         IMPRIMIR NOTA REMISION         =
======================================*/
$(".tablaNotasRemision").on("click",".btnImprimirNR",function(){
    //var data = table.row( $(this).parents('tr') ).data();
    //console.log("respuesta",data);
    //$(this).attr("idNR", data[9]); 
    //var idComprobante = $(this).attr("idComprobante");
    var idNR = $(this).attr("idNR");
    window.open("extensiones/dompdf1.php?idNR="+idNR,"_blank");
})