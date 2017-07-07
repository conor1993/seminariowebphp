@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/reporteboletos.js"></script> 
<!-- .panel principal-->
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Reporte De boletos
	</div>
    <!-- end panel heading-->
    <!-- formulario inicio-->
    <form id='myform' >
    <!-- panel body -->
	<div class="panel-body">
	<!-- contenido de la pagina -->
		<div class="col-md-12"><h1></h1></div>
              <div class="col-md-12">
                  <fieldset>
                              <legend>
                      Datos Personales:</legend>
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Sorteo:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stlsorteo" name="stlsorteo">
                                        <option value="#">Seleccione una opción</option>
                                        <?PHP
                                        if(isset($sorteos)){
                                            foreach ($sorteos as $sorteo ) {
                                                echo "<option value='".$sorteo->Id."'>".$sorteo->Nombre."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                  </fieldset>
              </div>
	          <div class="col-md-12">
	        
                        <div class="col-md-12">

                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Reporte:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stltiporeporte">
                                        <option value="#">Seleccione una opción</option>
                                        <option value="1">Lista Anexada de boletos</option>
                                        <option value="2">Inventario</option>
                                        <option value="3">Boletos Liquidados</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-12">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-4" >
                                   <input type="button" id="btuBuscarReporte" name="" value="BUSCAR" class="btn btn-primary input-estilo">
                                </div>
                                <div class="col-md-2">
                                  
                                </div>
                                <div class="col-md-4" >
                                    
                                </div>
                        </div>
	        </div>
                <div class="col-md-12"><h1></h1></div>
                <div class="col-md-12" >
                    <div class="panel-body"> 
                        <div id='tblboletosliq' style="display:none ">
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_boletos" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th>Num Boleto</th>
                                                        <th>Fecha </th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>
                                            </tfoot>
                                            <tbody id="tbodyCodigo">
                                             
                                            </tbody>
                                        </table>          
                                   </div>
                           </div> 
                        </div>
                    </div>

                </div>
                <div class="col-md-12" >
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblboletosasig' style="display:none ">
                            <div  class="panel-body"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_boletosasig" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Nombre </th>
                                                        <th>Num Boleto</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>
                                            </tfoot>
                                            <tbody id="tbodyCodigo">
                                             
                                            </tbody>
                                        </table>          
                                   </div>
                           </div> 
                        </div>
                    </div>

                </div>
            <div class="col-md-12 text-right" style="">
                  <input type="button" id="Cancelarpdf" name="" value="Cancelar" class="btn btn-default estilo-boton">
                  <input type="button" id="Descargarpdf" name="" value="Generar" class="btn btn-default estilo-boton">
            </div> 
     <!-- fin del contenido de la pagina-->		
	</div>
    <!--fin del pánel body-->
    </form>
    <!--fin del fomulario-->
</div>
<!-- .din del panel principal-->
@stop