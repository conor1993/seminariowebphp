@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/liquidaciones.js"></script>
<!-- .panel principal-->
<div class="panel panel panel-primary">
	<!-- .panel-heading -->
	<div class="panel-heading">
		Liquidacion De boletos
	</div>
    <!-- end panel heading-->
    <!-- panel body -->
	<div class="panel-body">
	<!-- contenido de la pagina -->
	    <!-- contenido de la paina web -->
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
                                    <select class="form-control input-sm input-estilo" id="stlsorteo">
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
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Colaborador:</b></label>
                                </div>
                                <div class="col-md-4" >
                                    <input class="form-control input-sm input-estilo" type="text" id="txtNomcolaborador"  placeholder="Ingrese la clave o Nombre" autofocus>
                                </div>
                                <div class="col-md-2">
                                  
                                </div>
                                <div class="col-md-4" >
                                    
                                </div>
                        </div>
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Cobrador:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stlCobrador" disabled="disabled">
                                        <option value="#">Seleccione una opción</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Commission:</b></label>
                                </div>
                                <div class="col-md-4" >
                                    <input class="form-control input-sm input-estilo" type="text" id="txtComission" disabled="disabled">
                                </div>
                        </div>
				  </fieldset>
	        </div>
            <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Dmoicilio:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtADomicilio" disabled="disabled">
                        </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Codigo Postal:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtcodpostald" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Numero int:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtNumerointpersonal" disabled="disabled">
                        </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Municipio:</b></label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-estilo" id="sltciudaddomicilio" disabled="disabled">
                                <option value="#">Selecione una Opcion</option>
                                             <?php
                                               if(isset($municpios)){
                                                     foreach ($municpios as $municpio):
                                                        echo "<option value='".$municpio->id."'>".$municpio->Nombre."</option>";
                                                     endforeach;
                                               }
                                             ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Numero:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtNumeropersonal" disabled="disabled">
                        </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Localidad:</b></label>
                         </div>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-estilo" id="sltlocaliaddom" disabled="disabled">
                                 <option value="#">Selecione una Opcion</option>
                                             <?php
                                               if(isset($localidades)){
                                                     foreach ($localidades as $localidad):
                                                        echo "<option value='".$localidad->idLocalidad."'>".$localidad->Nombre."</option>";
                                                     endforeach;
                                               }
                                             ?>
                            </select>
                        </div>
                    </div>
             
             </div>
            <div class="col-md-12">
               <fieldset>
                 <legend>Saldos del Colaborador:</legend>
                    <div class="col-md-12">
                       <table id="tabla_lista_saldos" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                              <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                   <tr>
                                       <th>Folio Solicitud </th>
                                       <th>Entregados</th>
                                       <th>Liquidados</th>
                                       <th>Devueltos</th>
                                       <th>Saldo</th>
                                       <th>Commission</th>
                                       <th>chek</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody id="tbodyCodigo">

                                </tbody>
                        </table>          
                    </div>
                </fieldset>
             </div>
            <div class="col-md-12" >
              <fieldset>
                <legend>Liquidar:</legend>
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <label class="btn btn-default rdtestatus1"  >
                          Liquidación Total
                          <input type="radio" name="rdtliqu" id="rdtaprobado" autocomplete="off" value="T" >
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default rdtestatus2"  >
                          Liquidación Parcial
                          <input type="radio" name="rdtliqu" id="rdtrechazado" autocomplete="off" value="P" >
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>
                      </div>
                    </div>
                </fieldset>
             </div>
             <div class="col-md-12" >
             <div class="col-md-12"><br></div>
            <div class="col-md-12" style="display: none" id="divcobros1">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Total:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" disabled="disabled" type="text" id="txttotal" >
                        </div>
                    </div>
             </div>
            <div class="col-md-12" style="display: none" id="divcobros2">
                    <div class="col-md-12">
                       <table id="tabla_lista_boletos" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                              <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                   <tr>
                                       <th>boleto</th>
                                       <th>chek</th>
                                       <th>boleto</th>
                                       <th>chek</th>
                                       <th>boleto</th>
                                       <th>chek</th>
                                       <th>boleto</th>
                                       <th>chek</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody id="tbodyboletos">
                                    <tr>

                                    </tr>  
                                </tbody>
                        </table> 
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Total:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo " disabled="disabled" type="text" id="txttotaldev" >
                        </div>
                    </div>
             </div>
            <div class="col-md-12 text-right" style="">
                  <input type="button" id="CancelarPago" name="" value="Cancelar" class="btn btn-default estilo-boton">
                  <input type="button" id="GuardarPago" name="" value="Liquidar" class="btn btn-default estilo-boton">
            </div> 
     <!-- fin del contenido de la pagina-->		
	</div>
    <!--fin del pánel body-->
</div>
<!-- .din del panel principal-->
@stop