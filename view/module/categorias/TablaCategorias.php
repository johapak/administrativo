<script>
	function AgregarCategoria()
      {
        
        if ($('#nombre').val() == "") 
        	{
        		$("#nombre").focus();
        		$("#mensaje_agregar").html("<div class='alert alert-warning'>Nombre vacio.</div>");
        	}
        else if ($('#descripcion').val() == "") 
        	{
        		$("#descripcion").focus();
        		$("#mensaje_agregar").html("<div class='alert alert-warning'>Descripción vacia.</div>");
        	}
        else
        	{
				$.ajax({
		        url: '../controllers/CategoriasAgregar.php',
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
		          	$('#guardar').attr('disabled', false);
		          	$('#cancelar').attr('disabled', false);
		          	CargarTabla();
		          }
		        })
        	}
  	}

	function ElimninarCategoria()
      	{
	        $.ajax({
			url: '../controllers/CategoriasEliminar.php',
			type: 'POST',
			timeout: 100000,
			data: $("#formulario_eliminar").serialize(),
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#mensaje_confirmar").html("<div class='alert alert-info'>Eliminando registro, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#mensaje_confirmar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				if (resultado == 1) 
					{
						$("#mensaje_confirmar").html("<div class='alert alert-success'>Registro eliminado de manera correcta.</div>");
						CargarTabla();
					}
				else if (resultado == 2) 
					{
						$("#mensaje_confirmar").html("<div class='alert alert-danger'>Error al eliminar.</div>");
					}
				else if (resultado == 3) 
					{
						$("#mensaje_confirmar").html("<div class='alert alert-danger'>Campos vacíos.</div>");
					}
			    }
			})
      	}

    function ActualizarCategoria()
      	{

	        $.ajax({
			url: '../controllers/CategoriasModificar.php',
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

    function CargarCategoria(idcategoria)
      	{
	        $.ajax({
			url: '../controllers/CategoriaCargarModalJSON.php',
			type: 'POST',
			timeout: 10000,
			data: {idcategoria:idcategoria},
			dataType: 'JSON',
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#mensaje_modal_modificar").html("<div class='alert alert-info'>Cargando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#mensaje_modal_modificar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				$("#mensaje_modal_modificar").html(resultado);
			    $("#id_modificar").val(resultado["idcategoria"]);
			    $("#nombre_modificar").val(resultado["nombre"]);
			    $("#descripcion_modificar").val(resultado["descripcion"]);
			    $("#condicion_modificar").val(resultado["condicion"]);
			    }
			})
      	}

     function CargarTabla()
      	{
	        $("#datos").empty();
	        $.ajax({
			url: '../controllers/CategoriasTablaJSON.php',
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
						if (contenido['condicion'] == 1) 
							{
								var condicion = "ACTIVO";
							}
						else
							{
								var condicion = "INACTIVO";
							}
						$("#datos").append('<tr><td align="left">'+contenido['idcategoria']+'</td><td align="left">'+contenido['nombre']+'</td><td align="left">'+contenido['descripcion']+'</td><td align="left">'+condicion+'</td><td width="10%"><button class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#ModalModificar" onclick="CargarCategoria('+contenido['idcategoria']+');"  ><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#ModalEliminar" onclick="ModalEliminar('+contenido['idcategoria']+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
					});
							    
			    }
			})
      	}

    function ModalEliminar(idcategoria)
    	{
           	$("#idcategoria").val(idcategoria);
           	$("#ModalConfirmar").html();
    	}

    window.onload = CargarTabla;
  	
</script>

<div class="row">
	<div class="col-md-12">
		<h4>Tabla de Categorias</h4>
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
	<div class="col-md-10 text-left">
		<button class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar">AGREGAR</button>
	</div>
	<div class="col-md-2 text-right">
		<button class="btn btn-primary btn-md" onclick="CargarTabla();" >RECARGAR</button>
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
					<td><strong>DESCRIPCIÓN</strong></td>
					<td><strong>CONDICIÓN</strong></td>
					<td><strong>ACCIONES</strong></td>
				</tr>
			</thead>
			<tbody id="datos">
			
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->
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
        				<p>¿Desea eliminar la categoria seleccionada? Ésta acción no se puede deshacer.</p>
		          		<form action="javascript:void(0);" id="formulario_eliminar">
		          			<input  class="hidden" type="text" name="idcategoria" id="idcategoria">
		          		</form>
        			</div>      			
        		</div>
        		<div class="row">
        			<div class="col-md-12">
        				<p id="mensaje_confirmar"></p>
        			</div>
        		</div>
          		
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="ElimninarCategoria();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          		<button type="button" class="hidden" data-dismiss="modal"></button>
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
          		<h4 class="modal-title">Agregar Categoria</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_agregar">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_agregar">
								<br>
							</div>

							<div class="col-md-12">
								<label>Descripción:</label>
								<input class="form-control" type="text" name="descripcion" id="descripcion_agregar">
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
							<div class="col-md-12">
								<p id="mensaje_agregar"></p>
							</div>
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="AgregarCategoria();">Guardar</button>
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
          		<h4 class="modal-title">Datos de Categoria</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_modificar">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>#:</label>
								<input class="form-control" type="text" name="idcategoria" id="id_modificar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_modificar">
								<br>
							</div>

							<div class="col-md-12">
								<label>Descripción:</label>
								<input class="form-control" type="text" name="descripcion" id="descripcion_modificar">
								<br>
							</div>
							
							<div class="col-md-12">
								<label>Condición</label>
								<select class="form-control" name="condicion" id="condicion_modificar">
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
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
        		<button type="button" class="btn btn-default" onclick="ActualizarCategoria();">Confirmar</button>
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

