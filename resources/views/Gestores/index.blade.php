@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/gestores.js"></script>
<!-- .panel principal-->
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Catálogo de Gestores
	</div>
    <!-- end panel heading-->
    <!-- panel body -->
	<div class="panel-body">
	<!-- contenido de la pagina -->
	<div class="col-md-12"><h1></h1></div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="col-md-2">
					<label class="label-estilo"><p>Nombre</p></label>
				</div>
				<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtnombregestor">
	    			<input  type="hidden" class="form-control" value="" id="txtIdgestor">
				</div>
				<div class="col-md-2">
					<label class="label-estilo"><p>Commission</p></label>
				</div>
				<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtcomisiongestor">
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-2">
					<label class="label-estilo"><p>Apellido Paterno</p></label>
				</div>
				<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtappaternogestor">
				</div>
				<div class="col-md-2">
					<label class="label-estilo"><p>Apellido Materno</p></label>
				</div>
				<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtapmaternogestor">
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-2">
					<label class="label-estilo"><p>Canal de distribución</p></label>
				</div>
				<div class="col-md-4">
	    			<select class="form-control input-sm input-estilo" id="stlcanaldistribucion">
	    				<option value="#">Seleccione una opción</option>
                             <?php
                               if(isset($canales)){
                                     foreach ($canales as $canal):
                                        echo "<option value='".$canal->Id."'>".$canal->Nombre."</option>";
                                     endforeach;
                               }
                             ?>
	    			</select>
				</div>
			</div>
			<div class="col-md-12"><h1></h1></div>
		</div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblcanales'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_gestores" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th>Commission</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($gestores)) {
                                                        foreach ($gestores as $gestor):
                                                        	echo '<tr  data-codigo = "'.$gestor->Id.'">';
                                                            echo '<td>' .$gestor->Nombre.'</td>';
                                                            echo '<td>' .$gestor->Commission.'</td>';
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
     <!-- fin del contenido de la pagina-->	
    <div class="col-md-12 text-right" style="">
          <input type="button" id="CancelarGestor" name="" value="Cancelar" class="btn btn-default estilo-boton">
          <input type="button" id="GuardarGestor" name="" value="Guardar" class="btn btn-default estilo-boton">
    </div>	
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop