<script>
	function ElimninarCliente()
      	{
	        $.ajax({
			url: '../controllers/ClienteEliminar.php',
			type: 'POST',
			timeout: 100000,
			data: $("#formulario_eliminar").serialize(),
			beforeSend: function(){
				
				$("#mensaje_modal_eliminar").html("<div class='alert alert-info'>Eliminando, por favor espere...</div>");
				},
			error: function(){
				
				$("#mensaje_modal_eliminar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				CargarTabla();
				$("#mensaje_modal_eliminar").html(resultado);
			    }
			})
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
				CargarTabla();
				$("#mensaje_agregar").html(resultado);
			    }
			})
      	}

    function ModificarCliente()
      	{
	        $.ajax({
			url: '../controllers/ClienteModificar.php',
			type: 'POST',
			timeout: 100000,
			data: $("#formulario_modificar").serialize(),
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#mensaje_modal_modificar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#mensaje_modal_modificar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				$("#mensaje_modal_modificar").html(resultado);
				CargarTabla();
			    }
			})
      	}

    function ModalCargar(idcliente)
      	{
	        $("#mensaje_modal_modificar").empty();
	        $.ajax({
			url: '../controllers/ClienteCargarModalJSON.php',
			type: 'POST',
			timeout: 10000,
			data: {idcliente:idcliente},
			dataType: 'JSON',
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#respuesta").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#respuesta").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){

				$("#idcliente_m").val(resultado["idcliente"]);
				$("#idcliente_modificar").val(resultado["idcliente"]);
				$("#nombre_modificar").val(resultado["nombre"]);

				$("#tipo_modificar").val(resultado["tipo"]);
				$("#cedula_modificar").val(resultado["cedula"]);

				$("#telefono_modificar").val(resultado["telefono"]);
				$("#email_modificar").val(resultado["email"]);
				$("#direccion_modificar").val(resultado["direccion"]);
			    }
			})
      	}

     function CargarTabla()
      	{
	        $("#datos").empty();
	        $.ajax({
			url: '../controllers/ClientesTablaJSON.php',
			type: 'POST',
			dataType: 'JSON',
			timeout: 100000,
			beforeSend: function(){
				$("#datos").html("<tr><td colspan=''></td></tr>");
				},
			error: function(){
				 
				},
			success: function(resultado){
				$("#datos").empty();
			    $.each(resultado,function(index,contenido)
					{
						$("#datos").append('<tr><td align="center">'+contenido['idcliente']+'</td><td align="center">'+contenido['nombre']+'</td><td align="center">'+contenido['tipo']+contenido['cedula']+'</td><td align="center">'+contenido['telefono']+'</td><td align="center">'+contenido['email']+'</td><td align="center">'+contenido['direccion']+'</td><td width="10%"><button class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#ModalModificar" onclick="ModalCargar('+contenido['idcliente']+');"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#ModalConfirmar" onclick="ModalConfirmar('+contenido['idcliente']+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
					});
							    
			    }
			})
      	}

    function ModalConfirmar(idcliente)
    	{
           	$("#mensaje_modal_eliminar").empty();
           	$("#idcliente_eliminar").val(idcliente);
           	$("#ModalConfirmar").html();

    	}

  	window.onload = CargarTabla;
</script>

<div class="row">
	<div class="col-md-12">
		<h4>Tabla de Clientes</h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="input-group">
	      	<input type="text" class="form-control">
	      	<span class="input-group-btn">
	        	<button class="btn btn-default" type="button"> <i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
	      	</span>
	    </div>
	</div>
	<div class="col-md-12">
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#ModalAgregar">AGREGAR</button>
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
					<td><strong>NOMBRES</strong></td>
					<td><strong>RIF/CÉDULA</strong></td>
					<td><strong>TELÉFONO</strong></td>
					<td><strong>EMAIL</strong></td>
					<td><strong>DIRECCIÓN</strong></td>
					<td><strong>ACCIONES</strong></td>
				</tr>
			</thead>
			<tbody id="datos">
			
			</tbody>
		</table>
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
          		<div class="row">
          			<div class="col-md-12">
	          			<p>¿Desea eliminar el seleccionada? Ésta acción no se puede deshacer.</p>
	          		
		          		<form action="javascript:void(0);" id="formulario_eliminar">
		          			<input  class="hidden" type="text" name="idcliente" id="idcliente_eliminar">
		          		</form>
	          		</div>
	      
	          		<div class="col-md-12">
						<p id="mensaje_modal_eliminar"></p>
					</div>
          		</div>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="ElimninarCliente();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

<div class="modal fade" id="ModalAgregar" role="dialog">
    <div class="modal-dialog">
    
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
        		<button type="button" class="btn btn-default" onclick="AgregarCliente();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

<div class="modal fade" id="ModalModificar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Datos del Cliente</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_modificar">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>#:</label>
								<input class="form-control" type="text" id="idcliente_m"  readonly="">
								<input class="hidden" type="text" name="idcliente" id="idcliente_modificar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombres:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_modificar" placeholder="Anthony Fuentes">
								<br>
							</div>
							<div class="col-md-12">
								<label>RIF/Cédula:</label>
								<div class="row">
									<div class="col-md-2">
										<select class="form-control" name="tipo" id="tipo_modificar">
											<option>--</option>
											<option>V-</option>
											<option>E-</option>
											<option>J-</option>
											<option>G-</option>
										</select>
									</div>
									<div class="col-md-10">
										<input class="form-control" type="text" name="cedula" id="cedula_modificar" placeholder="21000000">
									</div>
								</div>
								<br>
							</div>
						
							<div class="col-md-12">
								<label>Télefono:</label>
								<input class="form-control" type="number" name="telefono" id="telefono_modificar">
								<br>
							</div>
							
							<div class="col-md-12">
								<label>Email</label>
								<input class="form-control" type="email" name="email" id="email_modificar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Dirección</label>
								<textarea class="form-control" name="direccion" id="direccion_modificar"></textarea>
								<br>
							</div>
							<div class="col-md-12">
								<p id="mensaje_modal_modificar"></p>
								<br>
							</div>
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="ModificarCliente();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

