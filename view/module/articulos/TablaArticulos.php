<script>
	function CrearArticulo()
      	{
	        if ($('#codigo_crear').val() == "" ) 
	        	{
	        		$("#codigo_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Codigo vacio.</div>");
	        	}
	        else if ($('#nombre_crear').val() == "" ) 
	        	{
	        		$("#nombre_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Nombre vacio.</div>");
	        	}
	        else if ($('#descripcion_crear').val() == "" ) 
	        	{
	        		$("#descripcion_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Descripción vacia.</div>");
	        	}
	        else if ($('#precio_crear').val() == "" ) 
	        	{
	        		$("#precio_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Precio vacio.</div>");
	        	}
	        else if ($('#impuesto_crear').val() == "" ) 
	        	{
	        		$("#impuesto_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Impuesto vacio.</div>");
	        	}
	        else if ($('#categoria_crear').val() == "" ) 
	        	{
	        		$("#descripcion_crear").focus();
	        		$("#respuesta_modal_crear").html("<div class='alert alert-warning'>Categoria vacia.</div>");
	        	}
	        else
	        	{
					$.ajax({
			        url: '../controllers/ArticuloAgregar.php',
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

  	function CargarArticulo(idarticulo)
      	{
			$.ajax({
			url: '../controllers/ArticuloEliminar.php',
			type: 'POST',
			timeout: 10000,
			data: $("#formulario_eliminar").serialize(),
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#respuesta_modal_eliminar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#respuesta_modal_eliminar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				CargarTabla();
				$("#respuesta_modal_eliminar").html(resultado);
			    }
			})
     	}

     function ModificarArticulo()
      	{

	        $.ajax({
			url: '../controllers/ArticuloModificar.php',
			type: 'POST',
			timeout: 100000,
			data: $("#formulario_modificar").serialize(),
			beforeSend: function(){
				$("#mensaje_modal_modificar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$("#mensaje_modal_modificar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				$("#mensaje_modal_modificar").html(resultado);
				CargarTabla();	
			    }
			})
      	}

	function EliminarArticulo(idarticulo)
      	{
			$.ajax({
			url: '../controllers/ArticuloEliminar.php',
			type: 'POST',
			timeout: 10000,
			data: $("#formulario_eliminar").serialize(),
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#respuesta_modal_eliminar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#respuesta_modal_eliminar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				CargarTabla();
				$("#respuesta_modal_eliminar").html(resultado);
			    }
			})
     	}

    function CargarTabla()
      	{
	        $("#datos").empty();
	        $.ajax({
			url: '../controllers/ArticuloTablaJSON.php',
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
						if (contenido['estado'] == 1) 
							{
								var condicion = "ACTIVO";
							}
						else
							{
								var condicion = "INACTIVO";
							}
						$("#datos").append('<tr><td align="left">'+contenido['idarticulo']+'</td><td align="left">'+contenido['codigo']+'</td><td align="left">'+contenido['nombre']+'</td><td align="left">'+contenido['categoria']+'</td><td align="left">'+contenido['precio']+'</td><td align="left">'+contenido['stock']+'</td><td align="left">'+condicion+'</td><td width="10%"><button class="btn btn-primary" data-toggle="modal" data-target="#ModalModificar" onclick="ModalModificar('+contenido['idarticulo']+');"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#ModalEliminar" onclick="ModalEliminar('+contenido['idarticulo']+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
					});
							    
			    }
			})
      	}

    function ModalModificar(codigo)
    	{
            $.ajax({
			url: '../controllers/ArticuloCargarJSON.php',
			type: 'POST',
			timeout: 10000,
			data: {codigo:codigo},
			beforeSend: function(){
				$('#guardar').attr('disabled', true);
				$('#cancelar').attr('disabled', true);
				$("#respuesta_modal_eliminar").html("<div class='alert alert-info'>Guardando, por favor espere...</div>");
				},
			error: function(){
				$('#guardar').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				$("#respuesta_modal_eliminar").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
				},
			success: function(resultado){
				$("#codigo_modificar").val(resultado["idarticulo"]);
				$("#codigo").val(resultado["codigo"]);
				$('#nombre_modificar').val(resultado["nombre"]);
			    $('#descripcion_modificar').val(resultado["descripcion"]);
			    $('#precio_modificar').val(resultado["precio"]);
			    $('#impuesto_modificar').val(resultado["impuesto"]);
			    $('#categoria_modificar').val(resultado["idcategoria"]);
				
			    }
			})

           $("#respuesta_modal_eliminar").empty();
           $("#formulario_crear").reset();
    	}

    function ModalEliminar(idarticulo)
    	{
           $("#respuesta_modal_eliminar").empty();
           $("#idarticulo_eliminar").val(idarticulo);
    	}

    function ModalCrear()
    	{
           $("#respuesta_modal_eliminar").empty();
           $("#formulario_crear").reset();
    	}

    window.onload = CargarTabla;

  	
</script>

<div class="row">
	<div class="col-md-12">
		<h4>Tabla de Articulos</h4>
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
	<div class="col-md-10 col-xs-6 text-left">
		<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#ModalCrear" onclick="ModalCrear();"> CREAR ARTICULO </button>
	</div>
	<div class="col-md-2 col-xs-6 text-center">
		<button class="btn btn-primary btn-md" onclick="CargarTabla();" >RECARGAR</button>
	</div>	
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-left">
		<table class="table" width="100%">
			<thead>
				<tr>
					<td><strong>#</strong></td>
					<td><strong>CODIGO</strong></td>
					<td><strong>NOMBRE</strong></td>
					<td><strong>CATEGORIA</strong></td>
					<td><strong>PRECIO</strong></td>
					<td><strong>STOCK</strong></td>
					<td><strong>ESTADO</strong></td>
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
						<div id="respuesta_modal_eliminar"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>¿Desea eliminar el usuario seleccionado? Ésta acción no se puede deshacer.</p>
		          		<form action="javascript:void(0);" id="formulario_eliminar">
		          			<input  class="hidden" type="text" name="idarticulo" id="idarticulo_eliminar">
		          		</form>
					</div>
				</div>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="EliminarArticulo();">Confirmar</button>
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
          		<h4 class="modal-title">Crear Articulo</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_crear">
					<div class="row">
						<div class="col-md-12">
							<div id="respuesta_modal_crear"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Codigo de Barras:</label>
								<input class="form-control" type="text" name="codigo" id="codigo_crear">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_crear">
								<br>
							</div>
							<div class="col-md-12">
								<label>Descripcion:</label>
								<input class="form-control" type="text" name="descripcion" id="descripcion_crear">
								<br>
							</div>

							<div class="col-md-12">
								<label>Precio:</label>
								<input class="form-control" type="number" name="precio" id="precio_crear">
								<br>
							</div>

							<div class="col-md-12">
								<label>Impuesto:</label>
								<input class="form-control" type="number" name="impuesto" id="impuesto_crear">
								<br>
							</div>

							<div class="col-md-12">
								<label>Categoria:</label>
								<select class="form-control" name="categoria" id="categoria_crear">
									<option value="0">--</option>
									<?php
									foreach ($categorias->AllCategorias() as $row) 
									{
									?>
									<option value="<?=$row['idcategoria']?>"><?=$row['nombre']?></option>
									<?php
									}
									?>
								</select>
								<br>
							</div>
							<div class="col-md-12">
								<label>Imagen:</label>
								<input class="form-control" type="file" name="imagen" id="imagen_crear">
								<br>
							</div> 
							<div class="col-md-12">
								<label>Condición</label>
								<select class="form-control" name="condicion" id="condicion_crear">
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
								<br>
							</div>
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-success" onclick="CrearArticulo();">Guardar</button>
          		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>

<!-- Modal Crear Articulos -->
<div class="modal fade" id="ModalModificar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Información de Articulo</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_modificar">
					<div class="row">
						<div class="col-md-12">
							<div id="respuesta_modal_modificar"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>#:</label>
								<input class="form-control" type="text" name="codigo" id="codigo_modificar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Codigo de Barras:</label>
								<input class="form-control" type="text" name="codigo_barras" id="codigo_modificar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_modificar">
								<br>
							</div>
							<div class="col-md-12">
								<label>Descripcion:</label>
								<input class="form-control" type="text" name="descripcion" id="descripcion_modificar">
								<br>
							</div>

							<div class="col-md-12">
								<label>Precio:</label>
								<input class="form-control" type="number" name="precio" id="precio_modificar">
								<br>
							</div>

							<div class="col-md-12">
								<label>Impuesto:</label>
								<input class="form-control" type="number" name="impuesto" id="impuesto_modificar">
								<br>
							</div>

							<div class="col-md-12">
								<label>Categoria:</label>
								<select class="form-control" name="categoria" id="categoria_modificar">
									<option value="0">--</option>
									<?php
									foreach ($categorias->AllCategorias() as $row) 
									{
									?>
									<option value="<?=$row['idcategoria']?>"><?=$row['nombre']?></option>
									<?php
									}
									?>
								</select>
								<br>
							</div>
							<div class="col-md-12">
								<label>Imagen:</label>
								<input class="form-control" type="file" name="imagen" id="imagen_modificar">
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
						</div>
					</div>
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-success" onclick="ModificarArticulo();">Guardar</button>
          		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>
