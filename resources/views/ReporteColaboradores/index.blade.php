@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/reportecolaboradores.js"></script> 
<!-- .panel principal-->
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Reporte De Colaboradores
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
                              <legend>Datos:</legend>
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
                                    <select class="form-control input-sm input-estilo" id="stltiporeporte" name="stltiporeporte">
                                        <option value="#">Seleccione una opción</option>
                                        <option value="1">Pendientes de pago por gestor</option>
                                        <option value="2">Pendientes de pago por canal</option>
                                        <option value="3">4</option>
                                    </select>
                                </div>
                        </div>
              </div>
	          <div class="col-md-12">
                        <div class="col-md-12" style="display: none" id="stgestor">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Gestor:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stlgestor" name="stlgestor">
                                        <option value="#">Seleccione una opción</option>
                                        <?PHP
                                        if(isset($ges)){
                                            foreach ($ges as $ca ) {
                                                echo "<option value='".$ca->Id."'>".$ca->Nombre."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-12" style="display: none" id="stcanal">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Canal de distribucion:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stlcanal" name="stlcanal">
                                        <option value="#">Seleccione una opción</option>
                                        <?PHP
                                        if(isset($canal)){
                                            foreach ($canal as $ca ) {
                                                echo "<option value='".$ca->Id."'>".$ca->Nombre."</option>";
                                            }
                                        }
                                        ?>
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
                        <div id='tblgestorrep' style="display:none ">
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_pendientesporgestor" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Colaborador </th>
                                                        <th>Gestor</th>
                                                        <th>Saldo</th>
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
                        <div id='tblcanalrept' style="display:none ">
                            <div  class="panel-body"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_pendientesporcanal" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        <th>Colaborador </th>
                                                        <th>Canal</th>
                                                        <th>Saldo</th>
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