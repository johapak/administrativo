<script>
	
	function CrearProveedor()
      	{
	        if ($('#nombre_crear').val() == "" ) 
	        	{
	        		$("#nombre_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Nombre vacio.</div>");
	        	}
	        else if ($('#tipo_crear').val() == "" ) 
	        	{
	        		$("#tipo_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Tipo de documento vacio.</div>");
	        	}
	        else if ($('#documento_crear').val() == "" ) 
	        	{
	        		$("#documento_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Documento vacio.</div>");
	        	}
	        else if ($('#email_crear').val() == "" ) 
	        	{
	        		$("#email_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Email vacio.</div>");
	        	}
	        else if ($('#telefono_crear').val() == "" ) 
	        	{
	        		$("#telefono_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Teléfono vacio.</div>");
	        	}
	        else
	        	{
					$.ajax({
			        url: '../controllers/ProveedorAgregar.php',
			        type: 'POST',
			        timeout: 10000,
			        data: $("#formulario_crear").serialize(),
			        beforeSend: function(){
				        $('#guardar').attr('disabled', true);
				        $('#cancelar').attr('disabled', true);
				        $("#respuesta_modal_crear").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				        },
			        error: function(){
				        $('#guardar').attr('disabled', false);
				        $('#cancelar').attr('disabled', false);
				        $("#respuesta_modal_crear").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				        },
			        success: function(resultado){
			          	$("#respuesta_modal_crear").html(resultado);
			          	$('#guardar').attr('disabled', false);
			          	$('#cancelar').attr('disabled', false);
			          	CargarTabla();
			          }
			        })
	        	}
  		}

    function BuscarProveedor()
		{
			var documento = $("#documento").val();
			$.ajax({
			url: '../controllers/ProveedorBuscarJSON.php',
			type: 'POST',
			dataType: 'JSON',
			timeout: 100000,
			data: {documento:documento},
			beforeSend: function(){
				$('#consultar').attr('disabled', true);
				$("#mensaje_proveedor").append("<i class='fa fa-circle-o-notch fa-spin'></i>");
				},
			error: function(){
					alert("error");
				},
			success: function(resultado){
				$("#mensaje_proveedor").empty();
				$("#proveedor_datalist").empty();
				if (resultado == false ) 
					{
						$("#proveedor_datalist").html("<option>No hay información que mostrar.</option>");
					}
				else
					{
						$.each(resultado,function(index,contenido)
							{
								$("#proveedor_datalist").append('<option onclick="CargarProveedor();" value='+contenido["num_documento"]+'>'+contenido["nombre"]+'</option>');
							});
					}
						
				}
			})
		}

	 function CargarProveedor()
    	{
    		var documento = $("#documento").val();
    		if (documento == "") 
	        	{
	        		
	        	}
	        else
	        	{
	        		$.ajax({
				    url: '../controllers/ProveedorCargarDocumentoJSON.php',
				    type: 'POST',
				    timeout: 10000,
				    data: {documento:documento},
				    dataType: 'JSON',
				    beforeSend: function(){
					   	$("#mensaje_proveedor").html("<i class='fa fa-circle-o-notch fa-spin'>");
					    },
				    error: function(){
					   	 $("#mensaje").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
					   	 $("#mensaje_proveedor").empty();
					    },
				    success: function(resultado){
				    	$("#mensaje_proveedor").empty();
				       	$("#idproveedor").val(resultado["idproveedor"]);
				       	$("#nombre").val(resultado["nombre"]);
				       	$('#telefono').val(resultado["telefono"]);
			      		$('#email').val(resultado["email"]);
				       	}
				    })
	        	}
    	}

    function GuardarDocumento()
    	{
    		var codigo = $("#iddocumento").val();
	        if (codigo == "") 
	        	{
	        		$("#mensaje_proveedor").html("<div class='alert alert-warning aler-sm'>Seleccione un articulo.</div>");
	        	}
	        else
	        	{
	        		$.ajax({
				    url: '../controllers/ComprasDocumentoGuardar.php',
					type: 'POST',
					timeout: 10000,
					data: $("#formulario_documento").serialize(),
				    beforeSend: function(){
					    $("#mensaje_proveedor").html("<i class='fa fa-circle-o-notch fa-spin'>");
					    },
				    error: function(){
					    
					    $("#mensaje_proveedor").html("a");
					    },
				    success: function(resultado){
				    	if (resultado == 1) 
				    		{
				    			$("#mensaje_proveedor").html(resultado);
				    			$("#guardar_documento").attr('disabled', true);
				    			$("#agregar_articulo").attr('disabled', true);
				    			$("#imprimir_documento").attr('disabled', false);

				    		}
				       	}
				    })
	        	}
    	}

   	function ModalAgregarProveedor()
    	{
           	$("#resetear_agregar").click();
           	$("#mensaje_agregar").html("");
           	$("#nombre_agregar").focus();
    	}

     function ModalAgregarArticulo()
    	{
           	$("#ModalArticulo").html();
           	$("#reset_modal").click();
           	$("#mensaje").html("");
           	$("#codigo").focus();
           	DeshabilitarInputs();
    	}

	

   


	function pulsar(e) 
		{
		    if (e.keyCode === 13 && !e.shiftKey) 
		    	{
			        e.preventDefault();
			        CargarProveedor();
	    		}
		}

	function pulsar_articulo(e) 
		{
		    if (e.keyCode === 13 && !e.shiftKey) 
		    	{
			        e.preventDefault();
			        CargarArticulos();
	    		}
		}

	function AgregarRenglon()
      	{
	        
	        var articulo = $("#codigo_articulo_modal").val();
	        var nombre = $("#nombre_articulo_modal").val();
	        var precio = $("#precio_modal").val();
	        var alicuota = $("#alicuota_modal").val();
	        var cantidad = $("#cantidad_modal").val();
	        var sub_total = $("#sub_total_modal").val();
	        var total_iva = $("#iva_modal").val();
	        var total = $("#total_modal").val();

	        if (articulo == "") 
	        	{
	        		$("#mensaje_modal_productos").html("<div class='alert alert-warning'>Seleccione un articulo valido.</div>");
	        	}
	        else if (cantidad == 0) 
	        	{
	        		$("#mensaje_modal_productos").html("<div class='alert alert-warning'>Cantidad no puede ser igual a 0.</div>");
	        	}
	        else
	        	{
	        		$("#id_documento").val( $("#iddocumento").val() );

			        if ($("#iddocumento").val() == "") 
			        	{
			        		$.ajax({
							url: '../controllers/ComprarCrearDocumentoJSON.php',
							type: 'POST',
							timeout: 100000,
							beforeSend: function(){
								$("#mensaje_modal_productos").html("<i class='fa fa-circle-o-notch fa-spin'>");
								},
							error: function(){
								$("#mensaje_modal_productos").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
								},
							success: function(resultado){
								if (resultado == 0) 
									{
										$("#mensaje_modal_productos").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
									}
								else
									{
										$("#iddocumento").val(resultado);
										AgregarRenglon();
									}
								
								}
							})
			        	}
			        else
			        	{
			        		if ($("#busqueda").val() == "") 
					        	{
					        		$("#mensaje_modal_productos").html("<div class='alert alert-warning'>Seleccione un articulo.</div>");
					        	}
					        else
					        	{
					        		$.ajax({
								    url: '../controllers/ComprasRenglones.php',
								    type: 'POST',
								    timeout: 10000,
								    data: $("#formulario_articulo").serialize(),
								    beforeSend: function(){
									   
									    $("#mensaje_modal_productos").html("<i class='fa fa-circle-o-notch fa-spin'>");
									    },
								    error: function(){
									   
									    $("#mensaje_modal_productos").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
									    },
								    success: function(resultado){
								       	$("#mensaje_modal_productos").html(resultado);
								       	if (true) 
								       		{

								       		}
								       	else if (true) 
								       		{

								       		}
								       	
								       	$('#totales').show();
					        			$("#datos").append("<tr><td>"+articulo+"</td><td>"+nombre+"</td><td>"+precio+"</td><td>"+cantidad+"</td><td>"+alicuota+"</td><td>"+sub_total+"</td><td>"+total_iva+"</td><td>"+total+"</td><td> <button class='btn btn-primary btn-sm'><i class='fa fa-pencil' aria-hidden='true'></i></button> <button class='btn btn-danger btn-sm' href='javascript:void(0);' data-toggle='modal' data-target='#ModalEliminar'><i class='fa fa-trash' aria-hidden='true'></i></button> </td></tr>");
									    
								       	}
								    })
					        	}
			        	}
	        	}
      	}

    function EliminarRenglon()
      	{
	        $('#totales').show();
	        var articulo = $('#articulo_modal').val();
	        $("#datos").append("<tr><td><input class='form-control' value="+articulo+"></td><td>'+contenido[1]+'</td><td>'+contenido[2]+'</td></tr>");
      	}

    function CargarArticulos()
      	{
	        var codigo = $("#busqueda").val();
	        if (codigo == "") 
	        	{
	        		$("#mensaje_modal_productos").html("<div class='alert alert-warning aler-sm'>Seleccione un articulo.</div>");
	        		$("#busqueda").focus();
	        	}
	        else
	        	{
	        		$.ajax({
				    url: '../controllers/ArticuloCargarJSON.php',
				    type: 'POST',
				    timeout: 10000,
				    data: {codigo:codigo},
				    dataType: 'JSON',
				    beforeSend: function(){

					    $("#mensaje_modal_productos").html("<i class='fa fa-circle-o-notch fa-spin'>");
					    },
				    error: function(){
					    
					    $("#mensaje_modal_productos").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
					    },
				    success: function(resultado){
				    	
				       	$("#mensaje_modal_productos").html(resultado);
				       	$('#codigo_articulo_modal').val(resultado["idarticulo"]);
				       	$("#nombre_articulo_modal").val(resultado["nombre"]);
				       	$('#precio_modal').val(resultado["precio"]);
				       	$('#alicuota_modal').val(resultado["impuesto"]);
					    
				       	}
				    })
	        	}
      	}

    function ModalAgregarArticulo()
    	{
           	$("#ModalArticulo").html();
           	$("#reset_modal").click();
           	$("#mensaje").html("");
           	$("#codigo").focus();
           	DeshabilitarInputs();
    	}

   	

    function ModalCalcularMonto()
      	{
      		var precio = $('#precio_modal').val();
      		var impuesto = $('#alicuota_modal').val();
      		var cantidad = $('#cantidad_modal').val();
      		var sub_total = precio * cantidad;
      		var iva = sub_total * impuesto/100;
      		var total = sub_total + iva;

      		$('#sub_total_modal').val(sub_total);
      		$('#iva_modal').val(iva);
      		$('#total_modal').val(total);
      	}
   
</script>

<div class="row">
	<div class="col-md-11">
		<h4>Ingresar Compra</h4>

	</div>
	<div class="col-md-1">
		<h4><p id="mensaje_proveedor"></p></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>RIF:</label>
		<div class="input-group">
			<input class="form-control" type="text" name="documento" id="documento" list="proveedor_datalist" autocomplete="off" required onkeyup="BuscarProveedor();" onkeypress="pulsar(event)">
			<datalist id="proveedor_datalist">
			</datalist>
			<span class="input-group-btn">
		        <button class="btn btn-success" type="button" onclick="CargarProveedor();"> <i class="fa fa-search" aria-hidden="true"></i></button>
		    </span>
		</div>
	</div>
	<div class="col-md-3">
		<label>NOMBRE:</label>
		<input class="form-control" type="text"  name="" id="nombre" disabled="">
	</div>
	<div class="col-md-3">
		<label>TELEFONO:</label>
		<input class="form-control" type="text"  name="" id="telefono" disabled="">
	</div>
	<div class="col-md-3">
		<label>EMAIL:</label>
		<input class="form-control" type="text"  name="" id="email" disabled="">
	</div>

</div>
<div class="row">
	<form action="javascript;void();" id="formulario_documento">
		<div class="col-md-6">
		<label>FACTURA:</label>
		<input class="form-control" type="text" name="nro_factura">
	</div>
	<div class="col-md-6">
		<label>N CONTROl</label>
		<input class="form-control" type="text" name="nro_control">
	</div>

	<input class="hidden" type="text"  name="iddocumento" id="iddocumento">

	<input class="hidden" type="text"  name="idproveedor" id="idproveedor">
	</form>
	</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>	
</div>
<div class="row">
	<div class="col-md-6 text-left">
		<button class="btn btn-primary " href="javascript:void(0);" id="agregar_articulo" data-toggle="modal" data-target="#ModalArticulo" onclick="ModalAgregarArticulo()">Agregar Articulo</button>
	</div>

	<div class="col-md-6 text-right">
		<div class="btn-group">
		  	<button class="btn btn-primary" id="guardar_documento" onclick="GuardarDocumento()">Guardar</button>
		  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Opciones <span class="caret"></span></button>
		 
			<ul class="dropdown-menu" role="menu">
				<li><a data-toggle="modal" data-target="#ModalCrear" onclick="ModalProveedor()">Nuevo Proveedor</a></li>
			    <li class="divider"></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<div>
	<div class="col-md-12 text-center">
		<table class="table" width="100%">
			<thead>
				<tr>
					<td><strong>#</strong></td>
					<td><strong>ARTICULO</strong></td>
					<td><strong>PRECIO</strong></td>
					<td><strong>CANTIDAD</strong></td>
					<td><strong>IVA()</strong></td>
					<td><strong>SUB-TOTAL</strong></td>
					<td><strong>IVA</strong></td>
					<td><strong>TOTAL</strong></td>
					<td><strong>ACCIONES</strong></td>
				</tr>
			</thead>
			<tbody id="datos">
			
			</tbody>
			<tfoot hidden="" id="totales">
				<tr>
					<td colspan="9"></td>
				</tr>
				<tr>
					<td colspan="2">CANTIDAD DE ARTICULOS</td>
					<td colspan="2">SUB-TOTAL</td>
					<td colspan="3">IVA</td>
					<td colspan="3">TOTAL</td>
				</tr>
				<tr>
					<td colspan="2"><input class="form-control" type="text" name="cantidad_tabla" id="cantidad_tabla"></td>
					<td colspan="2"><input class="form-control" type="text" name="sub_total_tabla" id="sub_total_tabla"></td>
					<td colspan="3"><input class="form-control" type="text" name="iva__tabla" id="iva__tabla"></td>
					<td colspan="3"><input class="form-control" type="text" name="total_tabla" id="total_tabla"></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<input class="hidden" type="text" name="contador">

<!-- Modal -->
<div class="modal fade" id="ModalConfirmar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Confirmación de Acción</h4>
        	</div>
        	<div class="modal-body">
          		<p>¿Desea eliminar el usuario seleccionado? Ésta acción no se puede deshacer.</p>
          		
          		<form action="javascript:void(0);" id="formulario">
          			<input  class="hidden" type="text" name="idusuario" id="idusuario">
          		</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="EliminarUsuario();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

<div class="modal fade" id="ModalArticulo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">

          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Agregar Articulo </h4>

        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_articulo">
					<div class="row">
						<div class="form-group">
							
								<div class="col-md-12">
									<label>ARTICULO:</label>
									<div class="input-group">
										<input class="form-control input-sm" type="text" name="busqueda" id="busqueda" list="articulo_datalist" required autocomplete="off" onkeypress="pulsar_articulo(event)">
										<datalist id="articulo_datalist">
											<?php
											foreach ($articulo->AllArticulo() as $row) 
											{
											?>
											<option value="<?=$row['idarticulo']?>"><?=$row['nombre']?></option>
											<?php
											}
											?>
										</datalist>
										<span class="input-group-btn">
									        <button class="btn btn-success btn-sm" type="button" onclick="CargarArticulos();"> <i class="fa fa-search" aria-hidden="true"></i></button>
									    </span>
									   
									</div>
									
									<br>
									<p id="mensaje_modal_productos"></p>
								</div>
								<div class="col-md-12 hidden">
									<label>ID TRANSACCION:</label>
									<input type="text" name="id_documento" id="id_documento">
									<label>CODIGO:</label>
									<input type="text" name="codigo_articulo_modal" id="codigo_articulo_modal">
									<label>TIPO:</label>
									<input type="text" name="type" id="type" value="1">
									<br>
								</div>

								<div class="col-md-12">
									<label>NOMBRE:</label>
									<input class="form-control input-sm" type="text" name="nombre_articulo_modal" id="nombre_articulo_modal">
									<br>
								</div>
								
								<div class="col-md-4">
									<label>PRECIO:</label>
									<input class="form-control input-sm" type="number" name="precio_modal" id="precio_modal">
									<br>
								</div>
								<div class="col-md-4">
									<label>IVA(%):</label>
									<input class="form-control input-sm" type="number" name="alicuota_modal" id="alicuota_modal">
									<br>
								</div>
								<div class="col-md-4">
									<label>CANTIDAD:</label>
									<input class="form-control input-sm" type="number" name="cantidad_modal" id="cantidad_modal" onkeyup="ModalCalcularMonto();" >
									<br>
								</div>
								
								<div class="col-md-6">
									<label>SUB-TOTAL:</label>
									<input class="form-control input-sm" type="text" name="sub_total_modal" id="sub_total_modal" readonly="" >
									<br>
								</div>
								<div class="col-md-6">
									<label>IVA:</label>
									<input class="form-control input-sm" type="text" name="iva_modal" id="iva_modal" readonly="" >
									<br>
								</div>
								<div class="col-md-12">
									<label>TOTAL:</label>
									<input class="form-control input-sm" type="text" name="total_modal" id="total_modal" readonly="" >
									<br>
								</div>
							
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="reset" class="hidden" id="reset_modal" form="formulario_actualizar">resetear</button>
        		<button type="button" class="btn btn-default" id="guardar_articulo" onclick="AgregarRenglon();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

<!-- Modal Crear Articulos -->
<div class="modal fade" id="ModalCrear" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Crear Proveedor</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_crear">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_crear">
								<br>
							</div>
							<div class="col-md-2 col-xs-2">
								<label><br></label>
								<select class="form-control"  name="tipo" id="tipo_crear">
									<option>--</option> 
									<option>V-</option>
									<option>E-</option>
									<option>J-</option>
									<option>G-</option>
								</select>
								<br>
							</div>
							<div class="col-md-10 col-xs-10">
								<label>RIF:</label>
								<input class="form-control" type="text" name="documento" id="documento_crear">
								<br>
							</div>

							<div class="col-md-12">
								<label>Dirección:</label>
								<textarea class="form-control" name="direccion" id="direccion_crear"></textarea>
								<br>
							</div>

							<div class="col-md-12">
								<label>Email:</label>
								<input class="form-control" type="email" name="email" id="email_crear">
								<br>
							</div>

							<div class="col-md-12">
								<label>Teléfono:</label>
								<input class="form-control" type="tel" name="telefono" id="telefono_crear">
								<br>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="respuesta_modal_crear"></div>
						</div>
					</div>
				</form>

        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-success" onclick="CrearProveedor();">Guardar</button>
          		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>