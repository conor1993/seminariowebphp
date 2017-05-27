@extends('layouts.menu')
@section('contenido')

<!--aqui tenemos el contenido de la pagina we -->
<script src="js/clasesgenericas/autores.js"></script>
<div class="panel panel panel-primary">
    <div class="panel-heading"> 
        Catálogo de Autores
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
                                  
    <!-- contenido de la paina web -->
    <div class="col-md-12">
        <div class="col-md-1">
            <b>Nombre:</b>
        </div>
        <div class="col-md-5">
            <input class="form-control input-sm" type="text" id="txtNombreAutor">
        </div>
        <div class="col-md-1">
    		
    	</div>
    	<div class="col-md-5">
			<input  type="hidden" class="form-control" value="" id="txtId">
        </div>


    </div>
                <!--esto es una separacion   -->
                <div class="col-md-12"><h1></h1></div>

                <div class="col-md-12">
                	<div class="col-md-1">
                		<b>Pais:</b>
                		
                	</div>
                	<div class="col-md-5">
                		<select id="stlPais" class="form-control input-sm ">
            				<option value="#">Seleccione una opción</option>
                             <?php
                               if(isset($paises)){
                                     foreach ($paises as $pais):
                                        echo "<option value='".$pais->Id."'>".$pais->Nombre."</option>";
                                     endforeach;
                               }
                             ?>

            			</select>
                	</div>
                </div>	

                <!-- separacion-->
                    <!--esto es una separacion   -->
                <div class="col-md-12"><h1></h1></div>
                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red; border-style: "> 
                        <div id='tblautores'>
                            <div  class="panel-body" style=" border-color: red; border-style:;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
                                        <table id="tabla_lista_autores" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
                                            <caption class="captionTableMotivos"><b></b>

                                            </caption>
                                                  <thead class="ui-th-column ui-th-ltr ui-state-default" style="height: 50px">
                                                    <tr>
                                                        
                                                        <th>Nombre </th>
                                                        <th>Pais</th>
                                                    </tr>
                                                  </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody id="tbodyCodigo">

                                                <?php
                                                if (isset($autores)) {
                                                        foreach ($autores as $autor):
                                                            echo '<tr  data-codigo = "'.$autor->Id.'">';
                                                            echo '<td style="border: #3CA4FF  ; text-align: center;" >' .$autor->NombreAutor.'</td>';
                                                            echo '<td style="border: #3CA4FF  ; text-align: center;" >' .$autor->Nombre.'</td>';
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
                <div class="col-md-12 text-right" style="">
                    <input type="button" id="CancelarAutores" name="CancelarAutores" value="Cancelar" class="btn btn-default estilo-boton">
                    <input type="button" id="GuardarAutores" name="GuardarAutores" value="Guardar" class="btn btn-default estilo-boton">
                </div>

    <!-- contenido de la paina web -->
    </div>
<!-- /.panel-body -->
</div>
<!-- fin del conteido de la pagina web  -->
@stop