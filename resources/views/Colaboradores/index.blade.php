@extends('layouts.menu')
@section('contenido')
<script src="js/clasesgenericas/colaboradores.js"></script>
<div class="panel panel panel-primary">
    <div class="panel-heading"> 
    <!-- .panel-heading -->
        Catálogos de Colaboradores
	<!-- /.panel-heading -->
    </div>
        <!-- .panel-body -->
	    <div class="panel-body">
	    <!-- contenido de la paina web -->
            <div class="col-md-12"><h1></h1></div>
          <!-- datos personales -->
          <div class="col-md-12">
              <fieldset>
                  <legend>Datos Personales:</legend>
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Nombre:</b></label>
                                </div>
                                <div class="col-md-4" >
                                    <input class="form-control input-sm input-estilo" type="text" id="txtNomcolaborador" >
                                    <input  type="hidden" class="form-control" value="" id="txtIdcolaborador">
                                </div>

                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Gestor:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stlgestor">
                                        <option value="#">Seleccione una opción</option>
                                             <?php
                                               if(isset($gestores)){
                                                     foreach ($gestores as $gestor):
                                                        echo "<option value='".$gestor->Id."'>".$gestor->Nombre."</option>";
                                                     endforeach;
                                               }
                                             ?>
                                    </select>
                                </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Apellido Paterno:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtApellidoPaterno">
                            </div>
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Canal:</b></label>
                            </div>
                            <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" id="stlcanal">
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

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Apellido Materno:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtApellidoMaterno">
                            </div>

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Correspondencia a:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtCorrespondencia">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Commission:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtcommissioncol">
                            </div>
                        </div>
            </fieldset>
          </div>

            <div class="col-md-12"><h1></h1></div>

           
           <!-- datos del domicilio -->
           <div class="col-md-12">
               <fieldset>
                 <legend>Domicilio:</legend>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Dmoicilio:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtADomicilio">
                        </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Codigo Postal:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtcodpostald">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Telefono:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtATelefono">
                        </div>
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Estado:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltestadopersonal">
                                    <option value="#">Selecione una Opcion</option>
                                             <?php
                                               if(isset($estados)){
                                                     foreach ($estados as $estado):
                                                        echo "<option value='".$estado->id."'>".$estado->Nombre."</option>";
                                                     endforeach;
                                               }
                                             ?>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Numero int:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtNumerointpersonal">
                        </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Municipio:</b></label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-estilo" id="sltciudaddomicilio">
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
                            <input class="form-control input-sm input-estilo" type="text" id="txtNumeropersonal">
                        </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Localidad:</b></label>
                         </div>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-estilo" id="sltlocaliaddom">
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
                </fieldset>
            </div>
            <!-- fin de datos del domicilio -->
            <div class="col-md-12"><h1></h1></div>
             
             <!-- datos del empleo-->
             <div class="col-md-12">
                <fieldset>
                    <legend>Datos del Empleo:</legend>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Empresa:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm input-estilo" id="txtnombreEmpresa">
                            </div>
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Puesto</b></label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm input-estilo" name="" id="txtpuesto">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Domicilio:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-estilo input-sm" name="" id="txtdomicilioempleo">
                            </div>
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Codigo Postal:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtcodpostalp">
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Numero:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtNumeroempleo">
                            </div>
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Estados:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltestadotrabajo">
                                    <option value="#">Selecione una Opcion</option>
                                             <?php
                                               if(isset($estados)){
                                                     foreach ($estados as $estado):
                                                        echo "<option value='".$estado->id."'>".$estado->Nombre."</option>";
                                                     endforeach;
                                               }
                                             ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Telefono:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtNumerop">
                            </div>
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Municipio:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltciudadtrabajo">
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
                                <label class="label-estilo" ><b>Numero int:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtNumerointempleo">
                            </div>
                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Localidad:</b></label>
                         </div>
                        <div class="col-md-4">
                            <select class="form-control input-sm input-estilo" id="sltlocaliadempleo">
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
                </fieldset>
             </div>
            <div class="col-md-12 text-right" style="">
                  <input type="button" id="CancelarColaboradores" name="" value="Cancelar" class="btn btn-default estilo-boton">
                  <input type="button" id="GuardarColaboradores" name="" value="Guardar" class="btn btn-default estilo-boton">
            </div>  
	    <!-- fin del conteido de la pagina web  -->
	    </div>
        <!-- /.panel-body -->
</div>
@stop



