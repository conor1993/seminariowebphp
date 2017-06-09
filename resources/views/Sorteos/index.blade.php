@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/sorteos.js"></script>
<!-- .panel principal-->
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Catálogo de Sorteos
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
	    			<input type="text" class="form-control input-sm input-estilo" id="txtnombresorteo">
	    			<input  type="hidden" class="form-control" value="" id="txtIdsorteo">
	    		</div>
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Folio inicial:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtFoliosorteo">
	    		</div>
			</div>
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Precio:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtpreciosorteo">
	    		</div>
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Numero por boleto:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="number" value="0" class="form-control input-sm input-estilo" id="txtnumeroboletosorteo">
	    		</div>
			</div>
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Fecha inicial:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtfechainicial">
	    		</div>
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Fecha limite:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtfechalimite">
	    		</div>
			</div>
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Cantidad de boletos:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtcantidadboletos">
	    		</div>
			</div>
         		<div class="col-md-12"><h1></h1></div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblcanales'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_sorteos" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th>Precio</th>
                                                        <th>Fecha</th>
                                                        <th>Fecha limite</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($sorteos)) {
                                                        foreach ($sorteos as $sorteo):
                                                        	echo '<tr  data-codigo = "'.$sorteo->Id.'">';
                                                            echo '<td>' .$sorteo->Nombre.'</td>';
                                                            echo '<td>' .$sorteo->Precio.'</td>';
                                                            echo '<td>' .$sorteo->Fecha.'</td>';
                                                            echo '<td>' .$sorteo->FechaLimite.'</td>';
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
     <!-- fin del contenido de la pagina-->	
    <div class="col-md-12 text-right" style="">
          <input type="button" id="CancelarSorteo" name="" value="Cancelar" class="btn btn-default estilo-boton">
          <input type="button" id="GuardarSorteo" name="" value="Guardar" class="btn btn-default estilo-boton">
    </div>
	
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop