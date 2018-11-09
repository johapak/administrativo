<script>
	function guardar_categoria()
      {
        if ($('#password_1').val() == $('#password_2').val() == "") 
        	{
        		$("#password_1").focus();
        		$("#respuesta").html("<div class='alert alert-warning'>Contraseñas no son iguales.</div>");
        	}
        else if ($('#nombre').val() == "" ) 
        	{
        		$("#nombre").focus();
        		$("#respuesta").html("<div class='alert alert-warning'>Nombre vacio.</div>");
        	}
        else if ($('#email').val() == "" ) 
        	{
        		$("#email").focus();
        		$("#respuesta").html("<div class='alert alert-warning'>Email vacia.</div>");
        	}
        else if ($('#password_1').val() == "" ) 
        	{
        		$("#password_1").focus();
        		$("#respuesta").html("<div class='alert alert-warning'>Contraseña vacia.</div>");
        	}
         else if ($('#password_2').val() == "" ) 
        	{
        		$("#password_2").focus();
        		$("#respuesta").html("<div class='alert alert-warning'>Contraseña vacia.</div>");
        	}
        else if ($('#rol').val() == "" ) 
        	{
        		$("#rol").focus();
        		$("#respuesta").html("<div class='alert alert-warning'>Rol vacio.</div>");
        	}
        else
        	{
				$.ajax({
		        url: '../controllers/UsuarioAgregar.php',
		        type: 'POST',
		        timeout: 100000,
		        data: $("#formulario").serialize(),
		        beforeSend: function(){
			        $('#nombre').attr('disabled', true);
			        $('#email').attr('disabled', true);
			        $('#password_1').attr('disabled', true);
			        $('#password_2').attr('disabled', true);
			        $('#rol').attr('disabled', true);
			        $('#condicion').attr('disabled', true);
			        $('#cancelar').attr('disabled', true);
			        $("#respuesta").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
			        },
		        error: function(){
			        $('#nombre').attr('disabled', false);
			        $('#email').attr('disabled', false);
			        $('#password_1').attr('disabled', false);
			        $('#password_2').attr('disabled', false);
			        $('#rol').attr('disabled', false);
			        $('#condicion').attr('disabled', false);
			        $('#cancelar').attr('disabled', false);
			        $("#respuesta").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
			        },
		        success: function(resultado){
		          	$("#respuesta").html(resultado);
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
  	$(document).ready(function(){
        $("#guardar").click(function(){
        guardar_categoria();
        });
    });
</script>

<div class="row">
	<div class="col-md-12">
		<h4>Crear Usuario</h4>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<form action="javascript:void(0);" id="formulario">
	<div class="row">
		<div class="form-group">
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

			<div class="col-md-6">
				<label>Contraseña:</label>
				<input class="form-control" type="password" name="password_1" id="password_1">
				<br>
			</div>

			<div class="col-md-6">
				<label>Repetir Contraseña:</label>
				<input class="form-control" type="password" name="password_2" id="password_2">
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
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>	
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<label id="respuesta"></label>
	</div>
	<div class="col-md-12 text-right">
		<div class="btn-group">
			<button class="btn btn-primary" onclick="location.href='./Home.php?module=usuario&funcion=tabla_usuario'">CANCELAR</button>
			<button class="btn btn-primary" id="guardar">GUARDAR</button>
		</div>
	</div>
</div>