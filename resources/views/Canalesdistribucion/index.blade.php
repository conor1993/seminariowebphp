@extends('layouts.menu')
@section('contenido')
<!-- .panel principal-->
<script src="js/clasesgenericas/canalesDeDistribucion.js"></script>
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Catálogos de Canales de distribucion
	</div>
    <!-- end panel heading-->
    <!-- panel body -->
	<div class="panel-body">
	<!-- contenido de la pagina -->
		<div class="col-md-12"><h1></h1></div>
    	<div class="col-md-12">
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Nombre:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtnombrecan">
	    			<input  type="hidden" class="form-control" value="" id="txtIdcanal">
	    		</div>
	    		<div class="col-md-2">
	    			
	    		</div>
	    		<div class="col-md-4">
	    			
	    		</div>
			</div>
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Comision:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtacomisioncan">
	    		</div>
	    		<div class="col-md-2">
	    			
	    		</div>
	    		<div class="col-md-4">
	    			
	    		</div>
			</div>
         		<div class="col-md-12"><h1></h1></div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblcanales'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_canales" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th>Comision</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($canales)) {
                                                        foreach ($canales as $canal):
                                                        	echo '<tr  data-codigo = "'.$canal->Id.'">';
                                                            echo '<td  >' .$canal->Nombre.'</td>';
                                                            echo '<td  >' .$canal->Comision.'</td>';
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
	</div>
    <!--fin del pánel body-->               
     <div class="col-md-12 text-right" style="">
          <input type="button" id="CancelarCanalesDistribucion" name="" value="Cancelar" class="btn btn-default estilo-boton">
          <input type="button" id="GuardarCanalesDistribucion" name="" value="Guardar" class="btn btn-default estilo-boton">
    </div>
</div>
<!-- .din del panel principal-->
@stop