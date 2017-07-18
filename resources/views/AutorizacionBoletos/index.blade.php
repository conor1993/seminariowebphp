@extends('layouts.menu')
@section('contenido')
<!-- .panel principal-->
<script src="js/clasesgenericas/autorizacionboletos.js"></script>
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Autorizacion
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
				      <input type="hidden" class="form-control input-sm input-estilo" id="txtidsolicitud" >
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

					<select class="form-control input-sm input-estilo" id ="sltsorteosol" disabled="disabled">
						<option value="#">Selecione una opcion</option>
					<?php
					if (isset($sorteos)) {
						foreach ($sorteos as $sorteo) {
							
							if($idcol[0]->Id == $sorteo->Id){
								echo "<option value = '".$sorteo->Id."' selected>".$sorteo->Nombre."</option>";
							}else{
						     	echo "<option value = '".$sorteo->Id."'>".$sorteo->Nombre."</option>";
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
					<input type="text" class="form-control input-sm input-estilo" id="txtcolaboradorsol" disabled="disabled">
					<input type="hidden" class="form-control input-sm input-estilo" id="txtcolaboradorsolid">
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-2">
					<label class="label-estilo"><b>Boletos solicitados</b></label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm input-estilo" id="txtboletossol" disabled="disabled">
				</div>
				<div class="col-md-2">
					<label class="label-estilo"><b>Boletos autorizados</b></label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control input-sm input-estilo" id="txtboletosaut" >
				</div>
			</div>
			<div class="col-md-12 btn-group " data-toggle="buttons">
				<div class="col-md-2">
					<label class="label-estilo"><p>Estatus</p></label>
				</div>
				<div class="col-md-4">
					<label class="btn btn-default rdtestatus1"  >
						Aprobado
						<input type="radio" name="rdtestatus" id="rdtaprobado" autocomplete="off" value="A" >
						<span class="glyphicon glyphicon-ok"></span>
					</label>
					<label class="btn btn-danger rdtestatus2"  >
						Rechazado
						<input type="radio" name="rdtestatus" id="rdtrechazado" autocomplete="off" value="R" >
						<span class="glyphicon glyphicon-ok"></span>
					</label>
				</div>
			</div>
			<!-- area de asignacion -->
         	<div class="col-md-12"><h1></h1></div>
			<div class="col-md-12 btn-group " style="display:none" data-toggle="buttons" id="asignacionboletosmenu">
	              <fieldset>
	                <legend>Asignacion de Boletos:</legend>
				<div class="col-md-4">
					<label class="btn btn-default rdtmenu1"  >
						Rango
						<input type="radio" name="rdtmenu" id="rdtrango" autocomplete="off" value="R" >
						<span class="glyphicon glyphicon-ok"></span>
					</label>
					<label class="btn btn-default rdtmenu2"  >
						Tecleo
						<input type="radio" name="rdtmenu" id="rdttecleo" autocomplete="off" value="T" >
						<span class="glyphicon glyphicon-ok"></span>
					</label>
				</div>
				<fieldset>
			</div>
			<div class="col-md-12"><h1></h1></div>
			 <div style="display:none" class="col-md-12" id="asignacionboletosdiv">
						<div class="col-md-2">
							<label class="label-estilo"><p>Boleto Inicial</p></label>
						</div>
						<div class="col-md-4">
							<input type="text" id="txtbolinicial" class="form-control input-sm input-estilo">
						</div>
						<div class="col-md-2">
							<label class="label-estilo"><p>Boleto Final</p></label>
						</div>
						<div class="col-md-4">
							<input type="text" id="txtbofinal" class="form-control input-sm input-estilo">
						</div>
	              
              </div>
			 <div style="display:none" class="col-md-12" id="asignacionboletosdivtecleo">
						<div class="col-md-2">
							<label class="label-estilo"><p>Boletos</p></label>
						</div>
						<div class="col-md-4">
						   <textarea class="form-control input-sm input-estilo" id="txtboletosarea"  rows="5" cols="50"></textarea>
						</div>
						<div class="col-md-2">
							
						</div>
						<div class="col-md-4">
							
						</div>
	              
              </div>
            <!-- fin de el area -->
         		<div class="col-md-12"><h1></h1></div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblautorizacion'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_autorizacion" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Folio </th>
                                                        <th>Colaborador</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($solicitudes)) {
                                                        foreach ($solicitudes as $solicitud):
                                                        	echo '<tr  data-codigo = "'.$solicitud->Folio.'">';
                                                            echo '<td  >' .$solicitud->Folio.'</td>';
                                                            echo '<td  >' .$solicitud->Nombre.' '.$solicitud->ApellidoP.' '.$solicitud->ApellidoM.'</td>';
                                                            echo '</tr>';
                                                        endforeach;
                                                    }
                                                    ?>
                                             
                                            </tbody>
                                        </table>          
                                   </div>
                           </div> 
                        </div>
                    </div>
                </div>
		</div>
            <div class="col-md-12 text-right" style="">
                  <input type="button" id="CancelarAutorizacion" name="" value="Cancelar" class="btn btn-default estilo-boton">
                  <input type="button" id="GuardarAutorizacion" name="" value="Guardar" class="btn btn-default estilo-boton">
            </div>  
     <!-- fin del contenido de la pagina-->		
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop