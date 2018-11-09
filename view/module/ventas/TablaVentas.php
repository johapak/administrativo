<script>

    function ModalConfirmar(idcategoria)
    	{
           	$("#idcategoria").val(idcategoria);
           	$("#ModalConfirmar").html();
    	}

    function CargarTabla()
      	{
	        $("#datos").empty();
	        $.ajax({
			url: '../controllers/VentasTablaJSON.php',
			type: 'POST',
			dataType: 'JSON',
			timeout: 100000,
			beforeSend: function(){
				$("#datos").html('<tr><td colspan="8" align="center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i></td></tr>');
				},
			error: function(){
				 
				},
			success: function(resultado){
				$("#datos").empty();
			    $.each(resultado,function(index,contenido)
					{
						$("#datos").append('<tr><td align="center">'+contenido['idconfirmacion']+'</td><td align="center">'+contenido['nombre']+'</td><td align="center">'+contenido['cantidad']+'</td><td align="center">'+contenido['total_iva']+'</td><td align="center">'+contenido['sub_total']+'</td><td align="center">'+contenido['total']+'</td><td align="center">'+contenido['fecha']+'</td><td width="10%"><button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#ModalEliminar" onclick="ModalEliminar('+contenido['id']+');"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
					});			    
			    }
			})
      	}

    window.onload = CargarTabla;

  	
</script>

<div class="row">
	<div class="col-md-12">
		<h4>Tabla de Ventas</h4>
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
	<div class="col-md-12 text-center">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-xs-6 text-left">
		
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
<div>
	<div class="col-md-12 text-center">
		<table class="table" width="100%">
			<thead>
				<tr>
					<td><strong>#</strong></td>
					<td><strong>CLIENTE</strong></td>
					<td><strong>CANT. ART.</strong></td>
					<td><strong>TOTAL IVA</strong></td>
					<td><strong>SUB-TOTAL</strong></td>
					<td><strong>TOTAL</strong></td>
					<td><strong>FECHA</strong></td>

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
          		<p>¿Desea eliminar la categoria seleccionada? Ésta acción no se puede deshacer.</p>
          		
          		<form action="javascript:void(0);" id="formulario">
          			<input  class="hidden" type="text" name="idcategoria" id="idcategoria">
          		</form>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-default" onclick="ElimninarCategoria();">Confirmar</button>
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
          		<h4 class="modal-title">Datos de Usuario</h4>
        	</div>
        	<div class="modal-body">
          		<form action="javascript:void(0);" id="formulario_modal">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>#:</label>
								<input class="form-control" type="text" name="idcategoria" id="id_modal">
								<br>
							</div>
							<div class="col-md-12">
								<label>Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre_modal">
								<br>
							</div>

							<div class="col-md-12">
								<label>Descripción:</label>
								<input class="form-control" type="text" name="descripcion" id="descripcion_modal">
								<br>
							</div>
							
							<div class="col-md-12">
								<label>Condición</label>
								<select class="form-control" name="condicion" id="condicion_modal">
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
								<br>
							</div>
							<div class="col-md-12">
								<p id="mensaje"></p>
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

