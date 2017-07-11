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
  <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Busqueda</h4>
                </div>
                <div class="modal-body">
                <label class="" ><b>Colaborador:</b></label>
                <input type="text" class="form-control" id="txtNomcol" placeholder="Ingrese la clave o Nombre" autofocus>
                <br>
                  <div id="scrolltable">      
                    <table id="tabla_lista_col" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                            <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                  <tr>
                                      <th>Id</th>
                                      <th>Nombre</th>
                                      <th>Direccion</th>
                                      </tr>
                              </thead>
                              <tfoot>

                              </tfoot>
                              <tbody id="tbodycol">

                              </tbody>
                    </table>          
                  </div>     
                </div>
                <div class="modal-footer">
                  <button type="button" id="botonclose" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
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
							if($idcol[0]->Id == $sorteo->Id){
								echo "<option value = '".$sorteo->Id."' selected>".$sorteo->Nombre."</option>";
							}else{
						     	echo "<option value = '".$sorteo->Id."' >".$sorteo->Nombre."</option>";
							}
						} 

					}
					  ?>
					</select>
				</div>

				<div class="col-md-2">
	    			<label class="label-estilo" ><b>Colaborador:</b></label>
				</div>	
				<div class="col-md-4">
                    <div class="input-group input-estilo">
                        <input type="text" class="form-control" id="txtcolaboradorsol" placeholder="Ingrese la clave o Nombre" autofocus>
                          <input type="hidden" class="form-control input-sm input-estilo" id="txtcolaboradorsolid">
                         <span class="input-group-btn">
                             <button class="botonestilo btn" type="button" id="btnbuscarCol">Buscar</button>
                        </span>
                    </div>
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