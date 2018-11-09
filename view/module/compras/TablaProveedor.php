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

	function CargarTabla()
      	{
	        $("#datos").empty();
	        $.ajax({
			url: '../controllers/ProveedorTablaJSON.php',
			type: 'POST',
			dataType: 'JSON',
			timeout: 100000,
			beforeSend: function(){
				$("#datos").html('<tr><td colspan="7" align="center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i></td></tr>');
				},
			error: function(){
				 
				},
			success: function(resultado){
				$("#datos").empty();
			    $.each(resultado,function(index,contenido)
					{
						$("#datos").append('<tr><td align="left">'+contenido['id']+'</td><td align="left">'+contenido['nombre']+'</td><td align="left">'+contenido['tipo']+contenido['doc']+'</td><td align="left">'+contenido['direccion']+'</td><td align="left">'+contenido['email']+'</td><td align="left">'+contenido['telefono']+'</td><td width="10%"><button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#ModalEliminar" onclick="ModalEliminar('+contenido['id']+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
					});			    
			    }
			})
      	}

    window.onload = CargarTabla;

</script>

<div class="row">
	<div class="col-md-12">
		<h4>Tabla de Proveedores</h4>
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
	<div class="col-md-2 col-xs-6 text-center">
		<button class="btn btn-primary btn-md" onclick="CargarTabla();" >RECARGAR</button>
	</div>
	<div class="col-md-2 col-xs-6 text-center">
		<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#ModalCrear" onclick="ModalCrear();"><i class="fa fa-plus" aria-hidden="true"> </i> CREAR PROVEEDOR</button>
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
					<td><strong>NOMBRE</strong></td>
					<td><strong>RIF</strong></td>
					<td><strong>DIRECCION</strong></td>
					<td><strong>EMAIL</strong></td>
					<td><strong>TELEFONO</strong></td>
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
          		<h4 class="modal-title">Crear Proveedor</h4>
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
				</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-success" onclick="CrearProveedor();">Guardar</button>
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
          		<h4 class="modal-title">Información de Proveedor</h4>
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
								<label>Codigo de Barras:</label>
								<input class="form-control" type="text" name="codigo" id="codigo">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre">
								<br>
							</div>
							<div class="col-md-12">
								<label>Descripcion:</label>
								<input class="form-control" type="text" name="descripcion" id="descripcion">
								<br>
							</div>

							<div class="col-md-12">
								<label>Precio:</label>
								<input class="form-control" type="number" name="precio" id="precio">
								<br>
							</div>

							<div class="col-md-12">
								<label>Impuesto:</label>
								<input class="form-control" type="number" name="impuesto" id="impuesto">
								<br>
							</div>

							<div class="col-md-12">
								<label>Categoria:</label>
								<select class="form-control" name="categoria" id="categoria">
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
								<input class="form-control" type="file" name="imagen" id="imagen">
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
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-success" onclick="CrearArticulo();">Guardar</button>
          		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        	</div>
      	</div>
      
    </div>
</div>
