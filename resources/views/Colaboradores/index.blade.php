@extends('layouts.menu')
@section('contenido')

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
                                    <label class="label-estilo" ><b>Nombres:</b></label>
                                </div>
                                <div class="col-md-4" >
                                    <input class="form-control input-sm input-estilo" type="text" id="txtNomcolaborador" >
                                    <input  type="hidden" class="form-control" value="" id="txtId">
                                </div>

                                <div class="col-md-2">
                                    <label class="label-estilo" ><b>Gestor:</b></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control input-sm input-estilo" type="text" id="stlgestor">
                                        <option value="#">seleccione uno</option>
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
                                <select class="form-control input-sm input-estilo" type="text" id="stlCanal">
                                    <option value="#">seleccione uno</option>
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
                            <label class="label-estilo" ><b>Colonia:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtColonia">
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
                            <label class="label-estilo" ><b>Ciduad:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtCiudad">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Numero:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtNumero">
                        </div>

                        <div class="col-md-2">
                            <label class="label-estilo" ><b>Numero int:</b></label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm input-estilo" type="text" id="txtNumeroint">
                        </div>
                    </div>
                        <div class="col-md-12">

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Estado:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltestadod">
                                    <option value="#">Selecione una Opcion</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Ciduad:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltciudadd">
                                    <option value="#">Selecione una Opcion</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Codigo Postal:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtcodpostald">
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-4">
                               
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
                                <input type="text" class="form-control input-estilo input-sm" name="" txtdomicilio>
                            </div>
                            <div class="col-md-2">
                                <label class="label-estilo"><b>Colonia:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-estilo input-sm" name="" id="txtcolonia">
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Numero:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtNumerop">
                            </div>

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Numero int:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtNumerointp">
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
                                <label class="label-estilo" ><b>Codigo Postal:</b></label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm input-estilo" type="text" id="txtcodpostalp">
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Estado:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltestadop">
                                    <option value="#">Selecione una Opcion</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="label-estilo" ><b>Ciduad:</b></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm input-estilo" id="sltciudad">
                                    <option value="#">Selecione una Opcion</option>
                                </select>
                            </div>
                        </div>
                </fieldset>
             </div>

	    <!-- fin del conteido de la pagina web  -->
	    </div>
        <!-- /.panel-body -->
</div>
@stop



