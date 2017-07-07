@extends('layouts.menu')
@section('contenido')
<!-- .panel principal-->
<script src="js/clasesgenericas/solicitudboletos.js"></script>
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Solicitud De boletos
	</div>
    <!-- end panel heading-->
    <!-- panel body -->
	<div class="panel-body">
	<!-- contenido de la pagina -->
		<div class="col-md-12"><h1></h1></div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="col-md-2">
	    			<label class="label-estilo" ><b>Folio:</b></label>
				</div>	
				<div class="col-md-4 ">
				    <div class="input-group input-estilo">
				      <input type="text" class="form-control" id="txtFoliosolicitud">
				      <input type="hidden" class="form-control input-sm input-estilo" id="txtidsolicitud">
				      <span class="input-group-btn">
				        <button class="botonestilo btn" type="button" id="btnbuscarfolio">Buscar</button>
				      </span>
				    </div>
				 </div>
			</div>
			<div class="col-md-12 ">
				<div class="col-md-2">
					<label class="label-estilo"><b>Sorteo</b></label>
				</div>
				<div class="col-md-4">
					<select class="form-control input-sm input-estilo" id ="sltsorteosol">
						<option value="#">Selecione una opcion</option>
					<?php
					if (isset($sorteos)) {
						foreach ($sorteos as $sorteo) {
							echo "<option value = '".$sorteo->Id."'>".$sorteo->Nombre."</option>";
						}
					}
					  ?>
					</select>
				</div>

				<div class="col-md-2">
	    			<label class="label-estilo" ><b>Colaborador:</b></label>
				</div>	
				<div class="col-md-4">
					<input type="text" class="form-control input-sm input-estilo" id="txtcolaboradorsol">
					<input type="hidden" class="form-control input-sm input-estilo" id="txtcolaboradorsolid">
				</div>
			</div>

			<div class="col-md-12">
				<div class="col-md-2">
					<label class="label-estilo"><b>Boletos solicitados</b></label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm input-estilo" id="txtboletossol">
				</div>
				<div class="col-md-2">
					<label class="label-estilo"><b>Boletos autorizados</b></label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm input-estilo" id="txtboletosaut" disabled="disabled">
				</div>
			</div>
		</div>
            <div class="col-md-12 text-right" style="">
                  <input type="button" id="CancelarSolicitud" name="" value="Cancelar" class="btn btn-default estilo-boton">
                  <input type="button" id="GuardarSolicitud" name="" value="Guardar" class="btn btn-default estilo-boton">
            </div>  
     <!-- fin del contenido de la pagina-->		
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop