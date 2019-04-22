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
                return '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR" idNR="'+data[9]+'"><i class="fa fa-print"></i></button><button class="btn btn-sm btn-success btnPostearNR" idNR="'+data[9]+'"><i class="fa fa-check"></i></button><button class="btn btn-sm btn-warning btnEditarNR" idNR="'+data[9]+'"><i class="fa fa-pencil"></i></button><button class="btn btn-sm btn-default btnConfNR" idNR="'+data[9]+'"><i class="fa fa-money"></i></button></div>';
            }else{
                return '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR"  idNR="'+data[9]+'"><i class="fa fa-print"></i></button><button class="btn btn-sm btn-default btnPostearNR" disabled idNR="'+data[9]+'"><i class="fa fa-check"></i></button></div><button  class="btn btn-sm btn-default btnEditarNR" disabled idNR="'+data[9]+'"><i class="fa fa-pencil"></i></button><button class="btn btn-sm btn-default btnConfNR" idNR="'+data[9]+'"><i class="fa fa-money"></i></button></div>';
            }
          
        }
        
        //"defaultContent": '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirNR" idNR><i class="fa fa-print"></i></button><button class="btn btn-sm btnEditarNR" idNR><i class="fa fa-pencil"></i></button></div>'
    }
    ],
    "createdRow": function( row, data, dataIndex ) {
        if ( data[10] == 'D' ) {
            $( row ).css( "background-color", "#F7B3B3");
            $( row ).addClass( "warning" );
        }else if ( data[10] == 'P' ) {
            $( row ).css( "background-color", "#F9DDB5");
            $( row ).addClass( "warning" );
        }
    },
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
$(".formularioNR").on("click",".btnImprimirNR",function(){
    //var data = table.row( $(this).parents('tr') ).data();
    //console.log("respuesta",data);
    //$(this).attr("idNR", data[9]); 
    //var idComprobante = $(this).attr("idComprobante");
    var idNR = $(this).attr("idNR");
    window.open("extensiones/dompdf1.php?idNR="+idNR,"_blank");
})


/*======================================
=        POSTEAR NOTA REMISION         =
======================================*/

$(".formularioNR").on("click",".btnPostearNR",function(){
    var idNR = $(this).attr("idNR");
    swal({
        title: "¿Esta seguro de POSTEAR la nota de remision?",
        text: "Si no lo esta puedes cancelar la accion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, postear!"      
    }).then((result) => {
        if(result.value){
            window.location = "index.php?ruta=notaremision&idPNR="+idNR+"&resultado="+result.value
        }
    })
        
})

$(".tablaNotasRemision").on("click",".btnPostearNR",function(){
    var idNR = $(this).attr("idNR");
    swal({
        title: "¿Esta seguro de POSTEAR la nota de remision?",
        text: "Si no lo esta puedes cancelar la accion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, postear!"  
            
    }).then((result) => {
        if(result.value){
            window.location = "index.php?ruta=notaremision&idPNR="+idNR+"&resultado="+result.value
        }
    })
        
})

/*======================================
=        CONFIRMAR NOTA REMISION       =
======================================*/
$(".tablaNotasRemision").on("click",".btnConfNR",function(){ 
    var idNR = $(this).attr("idNR");  
    window.location = "index.php?ruta=conf-nr&idNR="+idNR
})

$('#confTable').DataTable( {
  "paging":   false,
  "ordering": false,
  "info":     false
} );

/*=============================================
SELECCIONAR MÉTODO DE COBRO
=============================================*/

$("#nuevoMetodoCobro").change(function(){

    var metodo = $(this).val();

    if(metodo == "QQ"){

      $(this).parent().parent().parent().parent().children(".cobro").children(".cajaMetodoCobro").html(

        '<label class="col-xs-6 col-form-label">Monto por QQ</label>'+

        '<div class="col-xs-4" id="cobroQQ" style="padding-left:0px">'+

          '<div class="input-group">'+

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

            '<input type="text" min="0" class="form-control" id="nuevaCxC" placeholder="0.00"  required>'+

          '</div>'+

        '</div>'
      )

      // Agregar formato al precio
      $('#nuevaCxC').number( true, 2);

    }else{

      $(this).parent().parent().parent().parent().children(".cobro").children('.cajaMetodoCobro').html(

        '<label class="col-xs-6 col-form-label">Monto fijo</label>'+

        '<div class="col-xs-4" id="cobroFijo" style="padding-left:0px">'+

          '<div class="input-group">'+

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

            '<input type="text" min="0" class="form-control" id="nuevaCxC" placeholder="0.00"  required>'+

          '</div>'+

        '</div>'
      )

    }

})

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function(){

    var metodo = $(this).val();

    if(metodo == "QQ"){

      $(this).parent().parent().parent().parent().children(".pago").children(".cajaMetodoPago").html(

        '<label class="col-xs-6 col-form-label">Monto por QQ</label>'+

        '<div class="col-xs-4" id="cobroQQ" style="padding-left:0px">'+

          '<div class="input-group">'+

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

            '<input type="text" min="0" class="form-control" id="nuevaCxC" placeholder="0.00"  required>'+

          '</div>'+

        '</div>'
      )

      // Agregar formato al precio
      $('#nuevaCxC').number( true, 2);

    }else{

      $(this).parent().parent().parent().parent().children(".pago").children('.cajaMetodoPago').html(

        '<label class="col-xs-6 col-form-label">Monto fijo</label>'+

        '<div class="col-xs-4" id="cobroFijo" style="padding-left:0px">'+

          '<div class="input-group">'+

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

            '<input type="text" class="form-control" id="nuevaCxP" placeholder="0.00" required>'+

          '</div>'+

        '</div>'
      )

    }

})