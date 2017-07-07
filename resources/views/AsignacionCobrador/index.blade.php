@extends('layouts.menu')
@section('contenido')
<!-- .panel principal-->
<script src="js/clasesgenericas/asignacioncobradores.js"></script>
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Asignacion de cobradores
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
                  <fieldset>
                    <legend></legend>
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Cobrador:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm " id="idcobrador" name="idcobrador">
                                        <option value="#">Seleccione una opción</option>
                                        <?PHP
                                        if(isset($cobradores)){
                                            foreach ($cobradores as $cobradore ) {
                                                echo "<option value='".$cobradore->Id."'>".$cobradore->Nombre."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Colaborador:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group ">
                                      <input type="text" class="form-control" id="txtNomcolaborador" placeholder="Ingrese la clave o Nombre" autofocus>
                                      <input type="hidden" class="form-control input-sm input-estilo" id="txtidNomcolaborador">
                                      <span class="input-group-btn">
                                        <button class="botonestilo btn" type="button" id="btnbuscarCol">Buscar</button>
                                      </span>
                                    </div>
                                </div>
                        </div>
                  </fieldset>
              </div>
            <!-- fin de el area -->
         		<div class="col-md-12"><h1></h1></div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblautorizacion'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_asignacion" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Cobrador </th>
                                                        <th>Colaborador</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($asignaciones)) {
                                                        foreach ($asignaciones as $asignacion):
                                                        	echo '<tr  data-idcol ="'.$asignacion->idcol.'  data-idcob = "'.$asignacion->idcob.'">';
                                                            echo '<td  >'.$asignacion->Nombre.'</td>';
                                                            echo '<td  >'.$asignacion->Nombrecol.'</td>';
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
                  <input type="button" id="CancelarAutorizacion" name="" value="Cancelar" class="btn btn-default estilo-boton">
                  <input type="button" id="GuardarAsignacion" name="" value="Guardar" class="btn btn-default estilo-boton">
            </div> 
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop