<script>
	
	function ModalAgregarCliente()
    	{
           	$("#resetear_agregar").click();
           	$("#mensaje_agregar").html("");
           	$("#nombre_agregar").focus();
    	}

	function AgregarCliente()
      	{
	        $.ajax({
			url: '../controllers/ClienteAgregar.php',
			type: 'POST',
			timeout: 100000,
			data: $("#formulario_agregar").serialize(),
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#mensaje_agregar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#mensaje_agregar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				$("#mensaje_agregar").html(resultado);
			    }
			})
      	}

     function CargarCliente()
    	{
    		var documento = $("#documento").val();
    		if (documento == "") 
	        	{
	        		
	        	}
	        else
	        	{
	        		$.ajax({
				    url: '../controllers/ClientesCargarDocumentoJSON.php',
				    type: 'POST',
				    timeout: 10000,
				    data: {documento:documento},
				    dataType: 'JSON',
				    beforeSend: function(){
					   	$("#mensaje_cliente").html("<i class='fa fa-circle-o-notch fa-spin'>");
					    },
				    error: function(){
					   	 $("#mensaje").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
					   	 $("#mensaje_cliente").empty();
					    },
				    success: function(resultado){
				    	$("#mensaje_cliente").empty();
				       	$("#idcliente").val(resultado["idcliente"]);
				       	$("#tipo").val(resultado["tipo"]);
				       	$("#cedula").val(resultado["cedula"]);
				       	$("#nombre").val(resultado["nombre"]);
				       	$('#telefono').val(resultado["telefono"]);
			      		$('#email').val(resultado["email"]);
				       	}
				    })
	        	}
    	}

    function BuscarCliente()
		{
			var documento = $("#documento").val();
			$.ajax({
			url: '../controllers/ClienteBuscarJSON.php',
			type: 'POST',
			dataType: 'JSON',
			timeout: 100000,
			data: {documento:documento},
			beforeSend: function(){
				$("#mensaje_cliente").html("<i class='fa fa-circle-o-notch fa-spin'>");
				},
			error: function(){
				$("#mensaje").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				$("#mensaje_cliente").empty();	
				},
			success: function(resultado){
				$("#mensaje_cliente").empty();
				$("#clientes_datalist").empty();
				if (resultado == false ) 
					{
						$("#clientes_datalist").html("<option>No hay información que mostrar.</option>");
					}
				else
					{
						$.each(resultado,function(index,contenido)
							{
								$("#clientes_datalist").append('<option onclick="CargarProveedor();" value='+contenido["cedula"]+'>'+contenido["nombre"]+'</option>');
							});
					}
						
				}
			})
		}

	function pulsar(e) 
		{
		    if (e.keyCode === 13 && !e.shiftKey) 
		    	{
			        e.preventDefault();
			        CargarCliente();
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
							url: '../controllers/VentasCrearDocumentoJSON.php',
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
								    url: '../controllers/VentasRenglones.php',
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

    function GuardarDocumento()
    	{
    		var codigo = $("#iddocumento").val();
	        if (codigo == "") 
	        	{
	        		$("#mensaje_cliente").html("<div class='alert alert-warning aler-sm'>Seleccione un articulo.</div>");
	        	}
	        else
	        	{
	        		$.ajax({
				    url: '../controllers/VentasDocumentoGuardar.php',
					type: 'POST',
					timeout: 10000,
					data: $("#formulario_documento").serialize(),
				    beforeSend: function(){
					    $("#mensaje_cliente").html("<i class='fa fa-circle-o-notch fa-spin'>");
					    },
				    error: function(){
					    
					    $("#mensaje_cliente").html("a");
					    },
				    success: function(resultado){
				    	if (resultado == 1) 
				    		{
				    			$("#mensaje_cliente").html(resultado);
				    			$("#guardar_documento").attr('disabled', true);
				    			$("#agregar_articulo").attr('disabled', true);
				    			$("#imprimir_documento").attr('disabled', false);

				    		}
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
		<h4>Ingresar Venta</h4>
	</div>
	<div class="col-md-1">
		<h4><p id="mensaje_cliente"></p></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-right">
		<hr>
		<p id="mensaje"></p>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>RIF/Cédula:</label>
		<div class="input-group">
			<input class="form-control" type="text" name="documento" id="documento" list="clientes_datalist" required onkeyup="BuscarCliente();" onkeypress="pulsar(event)">
			<datalist id="clientes_datalist">
			</datalist>
			<span class="input-group-btn">
		        <button class="btn btn-success" type="button" onclick="CargarCliente();"> <i class="fa fa-search" aria-hidden="true"></i></button>
		    </span>
		</div>
	</div>
	<div class="col-md-3">
		<label>NOMBRE:</label>
		<input class="form-control" type="text"  name="nombre"  id="nombre" disabled="">
	</div>
	<div class="col-md-3">
		<label>TELEFONO:</label>
		<input class="form-control" type="text"  name="telefono" id="telefono"  disabled="">
	</div>
	<div class="col-md-3">
		<label>EMAIL:</label>
		<input class="form-control" type="text"  name="email" id="email"  disabled="">
	</div>
	
	<div class="hidden">
		<form action="javascript;void();" id="formulario_documento" >
			<label>DOCUMENTO:</label>
			<input class="form-control" type="text"  name="iddocumento" id="iddocumento">
			<label>ID CLIENTE:</label>
			<input class="form-control" type="text"  name="idcliente" id="idcliente">
			<label>TIPO:</label>
			<input class="form-control" type="text"  name="tipo" id="tipo">
			<label>CEDULA:</label>
			<input class="form-control" type="text"  name="cedula" id="cedula">
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-left">
		<button class="btn btn-primary " href="javascript:void(0);" id="agregar_articulo" data-toggle="modal" data-target="#ModalArticulo" onclick="ModalAgregarArticulo()">AGREGAR ARTICULO</button>
	</div>

	<div class="col-md-6 text-right">
		<div class="btn-group">
		  	<button class="btn btn-primary" id="guardar_documento" onclick="GuardarDocumento()">Guardar</button>
		  	<button class="btn btn-primary" href="javascript:void(0);" id="imprimir_documento" disabled="" onclick="ModalAgregarArticulo()">Imprimir</button>
		  	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Opciones <span class="caret"></span></button>
		 
			<ul class="dropdown-menu" role="menu">
				<li><a data-toggle="modal" data-target="#AgregarCliente" onclick="ModalAgregarCliente()">Nuevo Cliente</a></li>
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
					<td><strong>IVA(%)</strong></td>
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
									<input class="form-control input-sm" type="number" name="precio_modal" id="precio_modal" readonly="">
									<br>
								</div>
								<div class="col-md-4">
									<label>IVA(%):</label>
									<input class="form-control input-sm" type="number" name="alicuota_modal" id="alicuota_modal" readonly="" >
									<br>
								</div>
								<div class="col-md-4">
									<label>CANTIDAD:</label>
									<input class="form-control input-sm" type="number" name="cantidad_modal" id="cantidad_modal" onkeypress="ModalCalcularMonto();" >
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

<div class="modal fade" id="AgregarCliente" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Agregar Cliente</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_agregar">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Nombres:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_agregar" placeholder="Anthony Fuentes">
								<br>
							</div>
							<div class="col-md-12">
								<label>RIF/Cédula:</label>
								<div class="row">
									<div class="col-md-2">
										<select class="form-control" name="tipo" id="tipo_agregar">
											<option value="">--</option>
											<option value="V-">V-</option>
											<option value="E-">E-</option>
											<option value="J-">J-</option>
											<option value="G-">G-</option>
										</select>
									</div>
									<div class="col-md-10">
										<input class="form-control" type="text" name="cedula" id="cedula_agregar" placeholder="21000000">
									</div>
								</div>
								<br>
							</div>
						
							<div class="col-md-12">
								<label>Télefono:</label>
								<input class="form-control" type="number" name="telefono" id="telefono_agregar">
								<br>
							</div>
							
							<div class="col-md-12">
								<label>Email</label>
								<input class="form-control" type="email" name="email" id="email_agregar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Dirección</label>
								<textarea class="form-control" name="direccion" id="direccion_agregar"></textarea>
								<br>
							</div>
							<div class="col-md-12">
								<p id="mensaje_agregar"></p>
								<br>
							</div>
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-primary" onclick="AgregarCliente();">Confirmar</button>
          		<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
          		<button type="reset" class="hidden" data-dismiss="modal" id="resetear_agregar">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>