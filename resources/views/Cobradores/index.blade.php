@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/cobradores.js"></script>
<!-- .panel principal-->
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Catálogos de Cobradores
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
	    			<input type="text" class="form-control input-sm input-estilo" id="txtnombrecol">
	    			<input  type="hidden" class="form-control" value="" id="txtIdCobradores">
	    		</div>
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Apellido Paterno:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtapellidopcol">
	    		</div>
			</div>
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Apellido Materno:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtapellidomaternocol">
	    		</div>
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Comision:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtacomisioncol">
	    		</div>
			</div>
			<div class="col-md-12">
	    		<div class="col-md-2">
	    			<label class="label-estilo" ><b>Serie:</b></label>
	    		</div>
	    		<div class="col-md-4">
	    			<input type="text" class="form-control input-sm input-estilo" id="txtseriecol">
	    		</div>
			</div>
    	</div>
         <div class="col-md-12"><h1></h1></div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblcolaboradores'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_cobradores" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th>Apellido Paertno</th>
                                                        <th>Apellido Materno</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($Cobradores)) {
                                                        foreach ($Cobradores as $Cobrador):
                                                        	echo '<tr  data-codigo = "'.$Cobrador->Id.'">';
                                                            echo '<td>' .$Cobrador->Nombre.'</td>';
                                                            echo '<td>' .$Cobrador->ApellidoP.'</td>';
                                                            echo '<td>' .$Cobrador->ApellidoM.'</td>';
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
          <input type="button" id="CancelarCobradores" name="" value="Cancelar" class="btn btn-default estilo-boton">
          <input type="button" id="GuardarCobradores" name="" value="Guardar" class="btn btn-default estilo-boton">
    </div>	
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop