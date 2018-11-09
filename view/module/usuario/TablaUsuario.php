<script>

    function EliminarUsuario()
    	{
    		$.ajax({
				url: '../controllers/UsuarioEliminar.php',
				type: 'POST',
				timeout: 10000,
				data: $("#formulario_eliminar").serialize(),
				beforeSend: function(){
					$("#respuesta_modal_eliminar").html("<div class='alert alert-info'>Aplicando cambios, por favor espere...</div>");
					},
				error: function(){
					$("#respuesta_modal_eliminar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
					},
				success: function(resultado){
					$("#respuesta_modal_eliminar").html("<div class='alert alert-success'>Usuario eliminado de manera correcta.</div>");
					}
				   	
				})
		}

    function ActualizarUsuario()
      	{
	        
	        $.ajax({
			url: '../controllers/UsuarioActualizar.php',
			type: 'POST',
			timeout: 10000,
			data: $("#formulario_actualizar").serialize(),
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
			    $("#id").val(resultado);
			    }
			})
      	}

    function CrearUsuario()
      {
        if ($('#password_1_agregar').val() == $('#password_2_agregar').val() == "") 
        	{
        		$("#password_1_agregar").focus();
        		$("#respuesta_agregar").html("<div class='alert alert-warning'>Contraseñas no son iguales.</div>");
        	}
        else if ($('#nombre_agregar').val() == "" ) 
        	{
        		$("#nombre_agregar").focus();
        		$("#respuesta_agregar").html("<div class='alert alert-warning'>Nombre vacio.</div>");
        	}
        else if ($('#email_agregar').val() == "" ) 
        	{
        		$("#email_agregar").focus();
        		$("#respuesta_agregar").html("<div class='alert alert-warning'>Email vacia.</div>");
        	}
        else if ($('#password_1_agregar').val() == "" ) 
        	{
        		$("#password_1_agregar").focus();
        		$("#respuesta_agregar").html("<div class='alert alert-warning'>Contraseña vacia.</div>");
        	}
         else if ($('#password_2_agregar').val() == "" ) 
        	{
        		$("#password_2_agregar").focus();
        		$("#respuesta_agregar").html("<div class='alert alert-warning'>Contraseña vacia.</div>");
        	}
        else if ($('#rol_agregar').val() == "" ) 
        	{
        		$("#rol_agregar").focus();
        		$("#respuesta_agregar").html("<div class='alert alert-warning'>Rol vacio.</div>");
        	}
        else
        	{
				$.ajax({
		        url: '../controllers/UsuarioAgregar.php',
		        type: 'POST',
		        timeout: 100000,
		        data: $("#formulario_agregar").serialize(),
		        beforeSend: function(){
			        $('#nombre').attr('disabled', true);
			        $('#email').attr('disabled', true);
			        $('#password_1').attr('disabled', true);
			        $('#password_2').attr('disabled', true);
			        $('#rol').attr('disabled', true);
			        $('#condicion').attr('disabled', true);
			        $('#cancelar').attr('disabled', true);
			        $("#respuesta_agregar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
			        },
		        error: function(){
			        $('#nombre').attr('disabled', false);
			        $('#email').attr('disabled', false);
			        $('#password_1').attr('disabled', false);
			        $('#password_2').attr('disabled', false);
			        $('#rol').attr('disabled', false);
			        $('#condicion').attr('disabled', false);
			        $('#cancelar').attr('disabled', false);
			        $("#respuesta_agregar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
			        },
		        success: function(resultado){
		          	$("#respuesta_agregar").html(resultado);
		          	$('#nombre').attr('disabled', false);
			        $('#email').attr('disabled', false);
			        $('#password_1').attr('disabled', false);
			        $('#password_2').attr('disabled', false);
			        $('#rol').attr('disabled', false);
			        $('#condicion').attr('disabled', false);
			        $('#cancelar').attr('disabled', false);
		          }
		        })
        	}
  	}

  	function ModalAgregar()
  		{
  			$("#reset_agregar").click();
  			$("#respuesta_agregar").empty();

  		}

  	function ModalModificar()
  		{
  			$("#reset_agregar").click();
  			$("#respuesta_agregar").empty();

  		}

  	function ModalEliminar(idusuario)
  		{
  			
           	$("#idusuario_eliminar").val(idusuario);
           	$("#mensaje_eliminar").empty();
  		}

    function CargarUsuario(idusuario)
      	{
	        
      	}

</script>
<div class="row">
	<div class="col-md-12">
		<h4>Tabla de Usuario</h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-left">
		<button class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" onclick="ModalAgregar();">AGREGAR</button>
	</div>
	<div class="col-md-6 text-right">
		<button class="btn btn-primary" >RECARGAR</button>
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
					<td><strong>NOMBRE</strong></td>
					<td><strong>EMAIL</strong></td>
					<td><strong>ROL</strong></td>
					<td><strong>CONDICIÓN</strong></td>
					<td><strong>FECHA REGISTRO</strong></td>
					<td><strong>ACCIONES</strong></td>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($usuario->AllUsuario() as $row) 
			{
			?>
				<tr>
					<td><?=$row['id']?></td>
					<td><?=$row['nombres']?></td>
					<td><?=$row['email']?></td>
					<td><?=$row['rol']?></td>
					<td><?=$row['condicion']?></td>
					<td><?=$row['fecha_creado']?></td>
					<td><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalEliminar" onclick="ModalEliminar(<?=$row['id']?>);">ELIMINAR</button> <button class="btn btn-primary btn-xs"  onclick="CargarUsuario(<?=$row['id']?>)">MODIFICAR</button></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="ModalAgregar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Agregar Usuario</h4>
        	</div>
        	<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form action="javascript:void(0);" id="formulario_agregar">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>Nombres:</label>
										<input class="form-control" type="text" name="nombre" id="nombre_agregar">
										<br>
									</div>

									<div class="col-md-12">
										<label>Email:</label>
										<input class="form-control" type="text" name="email" id="email_agregar">
										<br>
									</div>

									<div class="col-md-6">
										<label>Contraseña:</label>
										<input class="form-control" type="password" name="password_1" id="password_1_agregar">
										<br>
									</div>

									<div class="col-md-6">
										<label>Repetir Contraseña:</label>
										<input class="form-control" type="password" name="password_2" id="password_2_agregar">
										<br>
									</div>

									<div class="col-md-12">
										<label>Rol:</label>
										<input class="form-control" type="text" name="rol" id="rol_agregar">
										<br>
									</div>
									
									<div class="col-md-12">
										<label>Condición</label>
										<select class="form-control" name="condicion" id="condicion_agregar">
											<option value="1">ACTIVO</option>
											<option value="0">INACTIVO</option>
										</select>
										<br>
									</div>
								</div>
							</div>
						</form>
						
					</div>
					<div class="col-md-12 text-center">
						<label id="respuesta_agregar"></label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
        	<button type="button" class="btn btn-default" onclick="CrearUsuario();">Confirmar</button>
          	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          	<button type="reset" class="hidden" id="reset_agregar" form="formulario_agregar">Cancelar</button>
        </div>
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
          		<h4 class="modal-title">Datos de Usuario</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_actualizar">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>#:</label>
								<input class="form-control" type="text" name="idusuario" id="id" readonly="">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombres:</label>
								<input class="form-control" type="text" name="nombre" id="nombre">
								<br>
							</div>

							<div class="col-md-12">
								<label>Email:</label>
								<input class="form-control" type="text" name="email" id="email">
								<br>
							</div>
							<div class="col-md-12">
								<label>Rol:</label>
								<input class="form-control" type="text" name="rol" id="rol">
								<br>
							</div>
							
							<div class="col-md-12">
								<label>Condición</label>
								<select class="form-control" name="condicion" id="condicion">
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
								<br>
							</div>

							<div class="col-md-12">
								<label>Fecha Creado:</label>
								<input class="form-control" type="date" name="fecha_creado" id="fecha_creado" readonly="">
								<br>
							</div>
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="ActualizarUsuario();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

<div class="modal fade" id="ModalEliminar" role="dialog">
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
						<p>¿Desea eliminar el usuario seleccionado? Ésta acción no se puede deshacer.</p>
		          		<form action="javascript:void(0);" id="formulario_eliminar">
		          			<input  class="hidden" type="text" name="idusuario" id="idusuario_eliminar">
		          		</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="respuesta_modal_eliminar"></div>
					</div>
				</div>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="EliminarUsuario();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>





