CREATE TABLE notaRemision(
	idNR			INTEGER NOT NULL AUTO_INCREMENT,
	Automatico		INTEGER NOT NULL,
	Ajuste			VARCHAR(60),
	Clasificador	VARCHAR(20),
	Cotizacion		DECIMAL(10,2),
	Estado			VARCHAR(1),
	Fecha			DATETIME,
	Usuario			VARCHAR(30),
	Glosa1			VARCHAR(200),
	Glosa2			VARCHAR(200),
	Tipo1			VARCHAR(60),
	Login			VARCHAR(30),
	Moneda			VARCHAR(4),
	Numero			INTEGER,
	Tipo2			VARCHAR(10),
	Planta			VARCHAR(20),
	Sistema			VARCHAR(20),
	Periodo			VARCHAR(10),
	fcha_nro		INTEGER,
	NumeroNR		INTEGER,
	NumeroDC		INTEGER,
	NumeroSAP		INTEGER,
	fcha_registro	DATETIME,
	Origen			VARCHAR(10),
	Destino			VARCHAR(10),
	Placa			VARCHAR(15),
	Cod_Camion		VARCHAR(15),	
	Chofer			VARCHAR(100),
	Tipo_precio		INTEGER,
	Peso_NR			DECIMAL(10,2),
	Dscto_Peso		DECIMAL(10,2),
	Peso_Final		DECIMAL(10,2),
	precioV			DECIMAL(10,2),
	precioF			DECIMAL(10,2),
	ImpDeterminado	DECIMAL(10,2),
	descuento		DECIMAL(10,2),
	ImpCxC			DECIMAL(10,2),
	Estado_cxc		VARCHAR(2),
	Fecha_factura	DATETIME,
	Num_factura		VARCHAR(20),
	Num_Autoriza	VARCHAR(30),
	Tipo_costo		INTEGER,
	CostoVariable	DECIMAL(10,2),
	CostoFijo		DECIMAL(10,2),
	CostoDetermi	DECIMAL(10,2),
	CostoDscto		DECIMAL(10,2),
	ImpCxP			DECIMAL(10,2),
	Estado_cxp		VARCHAR(2),
	Fecha_factura2	DATETIME,
	Num_factura2	VARCHAR(20),
	Num_Autoriza2	VARCHAR(30),
	Cbt_ingreso		VARCHAR(60),
	Cbt_pago		VARCHAR(60),
	PRIMARY KEY (idNR)
);



{
        "targets": -1,
        "data": null,
        "defaultContent": '<div class="btn-group"><button class="btn btn-sm btn-info btnImprimirComprobante" idComprobante><i class="fa fa-print"></i></button><button class="btn btn-sm btn-warning btnEditarComprobante" idComprobante><i class="fa fa-pencil"></i></button><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></div>'
    }




$(".tablaCrearNR tbody").append(
                '<tr>'+
                    '<td>'+
                      '<button type="button" class="btn btn-danger btn-sm quitarDetalle"><i class="fa fa-times"></i></button>'+
                    '</td>'+
                    '<td>'+
                     '<div class="form-group">'+
                        '<div class="input-group">'+
                            '<select name="nuevaCuenta[]" id="nuevaCuenta" class="form-control  nuevaCuenta select2" style="width: 100%;" required>'+
                                '<option value="">Seleccione producto</option>'+
                            '</select>'+
                        '</div>'+
                      '</div>'+
                    '</td>'+
                    '<td>'+
                      '<div class="input-group">'+
                        '<input type="text" class="form-control nuevoDetalle" id="nuevoDetalle" name="nuevoDetalle" size="200" placeholder="Detalle" required>'+
                      '</div>'+
                    '</td>'+
                    '<td>'+
                      '<div class="input-group">'+
                        '<input type="text" class="form-control nuevaCantidad" id="nuevaGlosa" name="nuevaCantidad" size="100" placeholder="Cantidad" required>'+
                      '</div>'+ 
                    '</td>'+
                    '<td>'+
                      '<div class="input-group">'+
                        '<input type="text" class="form-control formatNumber" id="nuevoDebe" name="nuevoDebe[]" min="0" placeholder="00.00" required>'+
                      '</div>'+
                    '</td>'+
                '</tr>'
            );
            
            // PONER FORMATO AL DEBE Y AL HABER
            $(".formatNumber").number(true, 2)

            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index){
                $(".nuevaCuenta").append(
                    '<option value="'+item.idCuenta+'" idCuenta="'+item.idCuenta+'">'+item.codigo+' - '+item.descripcion+'</option>'
                );
            }











/**
 	* REGISTRO DE PRODUCTOS
 	*/
	static public function mdlIngresarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cod_producto,descripcion_largo, peso, bot_x_caja, litro_x_bot) VALUES (:cod_producto, :descripcion, :peso, :bot_x_caja, :litro_x_bot)");
		$stmt -> bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt -> bindParam(":bot_x_caja", $datos["bot_x_caja"], PDO::PARAM_STR);
		$stmt -> bindParam(":litro_x_bot", $datos["litro_x_bot"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}