<html>
	<head>
	    <link href="js/dist/css/sb-admin-2.css" rel="stylesheet">
	    <link href="js/vendor/bootstraps/css/combined.css" rel="stylesheet">
	    <link href="js/vendor/bootstraps/css/menuestilo.css" rel="stylesheet">
	    <link href="js/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
	    <link href="js/vendor/bootstraps/css/bootstrap-dialog.css" rel="stylesheet">
	    <link href="js/vendor/bootstraps/css/bootstrap-dialog.min.css" rel="stylesheet">
	    <link href="css/estilosInput.css" rel="stylesheet">
	</head>
	<body>
	          <div class="col-md-12">
	        
                <label class="label-estilo" ><h3 style="text-align: center;">Boletos Asignados</h3></label>
   
	        </div>

			<div class="col-md-12"><BR></div>

                <div class="col-md-12">
                    <div class="panel-body" style=" border-color: red;"> 
                        <div id='tblcanales'>
                            <div  class="panel-body" style=" border-color: red;"> 
                                    <div id="no-more-tables " class="table-responsive "   >
										<table id="tabla_lista_boletos" class="table table-striped table-bordered ocultar"  cellspacing="0" width="100%">
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
													<?php 
								 						if(isset($liq)){
								 							$rep = 0;
								 							foreach ($liq as $li) {
								 								if ($rep != $li->Id) {
									 								echo '<tr">';
										 								echo '<td>'.$li->Nombre.' '.$li->ApellidoP.' '.$li->ApellidoM.'</td>';
										 								echo '<td>'.$li->NumeroBoleto.'</td>';
										 								echo '<td></td>';
									 								echo '</tr>';
									 								$rep = $li->Id;
								 								}else{
									 								echo '<tr">';
										 								echo '<td></td>';
										 								echo '<td>'.$li->NumeroBoleto.'</td>';
										 								echo '<td></td>';
									 								echo '</tr>';
								 								}

								 							}
								 						}
													?>
								                                             
								                </tbody>
								        </table>         
                                   </div>
                           </div> 
                        </div>
                    </div>
                </div> 
	</body>
</html>