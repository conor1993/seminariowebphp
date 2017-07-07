//---------------------------------------------------------------------------------------------------------//
                     //----------------------variables globales ---------------------------//
//---------------------------------------------------------------------------------------------------------//



var dialog;


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
                     //----------------------eventos del sistema ---------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------------------------//


	//evento load
	$(document).ready(function(){
		//metodo k inicia las datatable del sistema
		iniciartabla();
		//escuchadores
		escuchadoresInput()
	});

	function escuchadoresInput(){

		$("#btuBuscarReporte").click(function(){
	        if(validarCamposObligatorios()){
	            limpiar()
	            dialogo = dialogNotificador();
				switch($("#stltiporeporte").val()){
					case '1':
						dialog.open()
						consultarPendientesDePagoGestor()
						break;
					case '2':
						dialog.open()
						consultarpendientesporcanal()
						break;
					default:
						break;
				}
			}
		});
		//click al boton imprimir
		$("#Descargarpdf").click(function(){
	        if(validarCamposObligatorios()){
	                dialogo = dialogNotificador();
				switch($("#stltiporeporte").val()){
					case '1':
						$("#myform").attr("action","/crearpdfreportependientesgestor")
						$("#myform").submit()
						break;
					case '2':
						$("#myform").attr("action","/crearpdfPendientesDePagocanal")
						$("#myform").submit()
						break;
					default:
						break;
				}
		    }
		});
		//click en el select tipo de reporte
		$("#stltiporeporte").click(function(){
			switch($("#stltiporeporte").val()){
				case '1':
					ocultarDesocultarstl("stgestor")
					break;
				case '2':
					ocultarDesocultarstl("stcanal")
					break;
				default:
					break;
			}
		})
		//boton cancelar 
		$("#Cancelarpdf").click(function(){
			limpiar()
		})
	}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
                  //------------------------metos abc del sistema ---------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	function consultarPendientesDePagoGestor(){
		var idsorteo =$("#stlsorteo").val();
		var idgestor =$("#stlgestor").val();
		

		$.ajax({
			url:'/consultarPendientesDePagoGestor',
			headers:{'X-CSRF-TOKEN':$("#tokena").val()},
			type:'POST',
			datatype:'HTML',
			data:{idsorteo:idsorteo,idgestor:idgestor}
		}).done(function(data){
			datos=data[0]
                    datos= data[0]
                     //agregar los datos a LA TABLA
                     for (var i = 0; i < datos.length; i++) {
                         var rowNode = $('#tabla_lista_pendientesporgestor').DataTable().row.add([datos[i].colnombre+' '+datos[i].colapellidop+' '+datos[i].colapellidom,datos[i].gestornombre+' '+datos[i].gesapellido+' '+datos[i].gesapellidom,datos[i].pago]).draw().node();
                     }
            dialogo.close()
			ocultarDesocultartablas("tblgestorrep")
		}).fail(function(){

		});
	}

	function consultarpendientesporcanal(){
		var idsorteo = $("#stlsorteo").val()
		var idcanal = $("#stlcanal").val()

		$.ajax({
			url:'/consultarPendientesDePagocanal',
			headers:{'X-CSRF-TOKEN':$("#tokena").val()},
			type:'POST',
			datatype:'html',
			data:{idsorteo:idsorteo,idcanal:idcanal},
		}).done(function(data){
			datos=data[0]
                     for (var i = 0; i < datos.length; i++) {
                         var rowNode = $('#tabla_lista_pendientesporcanal').DataTable().row.add([datos[i].colnombre+' '+datos[i].colapellidop+' '+datos[i].colapellidom,datos[i].canornombre,datos[i].pago]).draw().node();
                     }
            dialogo.close()
			ocultarDesocultartablas("tblcanalrept")
		}).fail(function(){

		});

	}

	function guardar(){

	}

	function buscar(){

	}

	function update(){

	}


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
                     //----------------------helpers ------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    // retorna el dialog
    function dialogNotificador(){
        dialog = new BootstrapDialog({message: 'Procesando...',closable: false,});
        return dialog
    }

    //metodo notificacion en este metodo se modifica el modal agregando el mesnaje y cerrando el modal
    function notificar(exito){
      if(exito){
              dialog.setMessage("Operacion Exitosa")
              setTimeout ("dialog.close()", 1000);
      }else{
            dialog.close()
            dialogWarning = dialogNotificador();
            dialogWarning.setType(BootstrapDialog.TYPE_WARNING);
            dialogWarning.setMessage("Ocurrio un error intentelo de nuevo")
            dialogWarning.open()
            setTimeout ("dialogWarning.close()", 2000); 
      }
    }


    //validacion de campos obligatorios
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""
        if($("#stlsorteo").val() == "#"){
            cadena = cadena +"   * No se ha capturado el sorteo.\n"
        }

        if($("#stltiporeporte").val() == "#"){
            cadena = cadena +"   * No se ha capturado el tipo de reporte.\n"
        }
 
        
        if (cadena != ""){
            valido=false;
            dialogWarning = dialogNotificador();
            dialogWarning.setType(BootstrapDialog.TYPE_WARNING);
            dialogWarning.setClosable(true);
            dialogWarning.setMessage("Antes de guardar debe corregir lo siguiente:\n\n"+ cadena)
            dialogWarning.open()
            setTimeout ("dialogWarning.close()", 5000);
        }

        return valido
    }

	function ocultarDesocultartablas(op){
		//oculta
		$("#tblgestorrep").hide()
		$("#tblcanalrept").hide()
		//muestra
		$("#"+op).show()
		
	}
	function ocultarDesocultarstl(op){
		//oculta
		$("#stgestor").hide()
		$("#stcanal").hide()
		//muestra
		$("#"+op).show()
		
	}

	//limpiar campos
	function limpiar(){
		$("input:text").val("") 
        $('#tabla_lista_pendientesporgestor').DataTable().clear().draw();
        $('#tabla_lista_pendientesporcanal').DataTable().clear().draw();
	}

	function iniciartabla(){
         $('#tabla_lista_pendientesporgestor').dataTable({
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "bProcessing": true,
                            "sAjaxDataProp": "",
                            "bServerSide": true,
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                    },

                    "aLengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                    "iDisplayLength": 5,
                    ordering: true
      });
         $('#tabla_lista_pendientesporcanal').dataTable({
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "bProcessing": true,
                            "sAjaxDataProp": "",
                            "bServerSide": true,
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                    },

                    "aLengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                    "iDisplayLength": 5,
                    ordering: true
      });
	}