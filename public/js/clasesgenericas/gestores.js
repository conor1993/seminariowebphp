
//--------variables globales---------
    var dialog;

//-------------------------------------eventos del sistema-----------------------------------------//
    //evento principal (load)
	$(document).ready(function(){
		//metodo que inicia la tabla
		iniciarTablagestores();
		//metodo k inicia los botones de guardar y cancelar
		iniciarBotones();
		//evento de la tabla al presionar una fila
		buscarID()
		//validaciones 
		agregarVladicaciones();

	});

	function iniciarBotones(){
	    //EVENTO AL PRESIONAR EL BOTON DE CANCELAR
	    $("#CancelarGestor").click(function(){
	       limpiar();
	    });
	    //EVENTO AL PRESIONAR EL BOTON DE GUARDAR
	    $("#GuardarGestor").click(function(){
	        dialog = dialogNotificador();
	        if( $("#txtIdgestor").val() == ""){
	        	if(validarCamposObligatorios()){
	            	dialog.open();
	            	guardarGestor();
	        	}
	        }else{
	        	if(validarCamposObligatorios()){
		            dialog.open();
		            actualizarGestor()
	        	}
	        }
	    });
	}

    function buscarID(){
      //OBTENETEMOS EL ID DEL LA FILA PRESIONADA
        $('#tabla_lista_gestores tbody').on('click', 'tr', function (event) { 
              var id = $(this).closest('tr').data('codigo');
              dialog = dialogNotificador()
              dialog.open();
              consultarGestor(id);
        });       
    }
//------------------------------------- end eventos del sistema-----------------------------------------//

//--------------------------------------------metodos abc ajax----------------------------------------//

    //metodo que sirve para guardar el sorteo de distribucion mediante ajax
    function guardarGestor(){
            $.ajax({
                  url:'/guardargestores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Nombre:$("#txtnombregestor").val(),Commission:$("#txtcomisiongestor").val(),ApellidoP:$("#txtappaternogestor").val()
                        ,ApellidoM:$("#txtapmaternogestor").val(),Canaldis:$("#stlcanaldistribucion").val()}   
            }).done(function(data) {
                  // se agrega el dato al grid
                  var rowNode = $('#tabla_lista_gestores').DataTable().row.add([data[0].Nombre,data[0].Commission]).draw().node();
                  $(rowNode).attr('data-codigo',data[0].Id);
                  // se notifica el exito de la operacion
                  notificar(true)
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });
    }

    //consulta de canal por id
    function consultarGestor(id){
         $.ajax({
              url: UURL+"/consultargestores",
              headers:{'X-CSRF-TOKEN':$("#tokena").val()},
              type:'POST',
              datatype:'html',
              data:{idGestores:id}    
         }).done(function(data) {
	           $("#txtIdgestor").val(data[0].Id)
		  	 	$("#txtnombregestor").val(data[0].Nombre) 
		  		$("#txtcomisiongestor").val(data[0].Commission) 
		  		$("#txtappaternogestor").val(data[0].ApellidoP)
		  		$("#txtapmaternogestor").val(data[0].ApellidoM)
		  		$("#stlcanaldistribucion").val(data[0].IdCanaldistribucion)
            notificar(true)
         }).fail( function() {
               notificar(false)
            });
    }

    // actualizar sorteo
    function  actualizarGestor(){
            $.ajax({
                  url:'/Actualizargestores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Id:$("#txtIdgestor").val(),Nombre:$("#txtnombregestor").val(),Commission:$("#txtcomisiongestor").val(),ApellidoP:$("#txtappaternogestor").val()
                        ,ApellidoM:$("#txtapmaternogestor").val(),Canaldis:$("#stlcanaldistribucion").val()}   
            }).done(function(data) {
	              //SE ACTUALIZA EL REGISTRO CON LOS NUEVOS DATOSN EN EL GRIDD
	              ActualizarRegistro(data);
	              //SE LIMPIAN LOS CAMPOS
	              limpiar();
	              //SE MODIFICA LA NOTIFICACION DE PROCESO A TERMINADO
	              notificar(true)
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });
    }
//--------------------------------------------end abc ajax----------------------------------------//

//--------------------------------------------helpers---------------------------------------------//
  // retorna el dialog
  function dialogNotificador(){
    dialog = new BootstrapDialog({message: 'Procesando...',closable: false,});
    return dialog
  }
  //se busca el registro modificado se borra y se agrega el nuevo
  function ActualizarRegistro(data){
    var idgestor = data[0].Id 
    //RECORREMOS EL GRID EN BUSCA DE LA FILA AFECATADA Y SE ACTUALIZA
     $("#tabla_lista_gestores tbody tr").each(function (index){
              if($(this).closest('tr').data('codigo') == idgestor ){
                    $(this).find('td:eq(0)').html(data[0].Nombre);
                    $(this).find('td:eq(1)').html(data[0].Commission);
              }
          })
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
  //validaciones a los valores 
	  function agregarVladicaciones(){
	  	$("#txtcomisiongestor").validateNumLetter(' 0123456789');
	   }
  //validar camposobligatorios
  function validarCamposObligatorios(){ 
		var valido= true
		var cadena = ""
		if($("#txtnombregestor").val() == ""){
			cadena = cadena +"   * No se ha capturado el Nombre.\n"
		}
		if($("#txtcomisiongestor").val() == ""){
			cadena = cadena +"   * No se ha capturado la Commission.\n"
		}
		if($("#txtappaternogestor").val() == ""){
			cadena = cadena +"   * No se ha capturado el Apellido Paterno.\n"
		}
		if($("#txtapmaternogestor").val() == ""){
			cadena = cadena +"   * No se ha capturado el Apellido Materno.\n"
		}
		if($("#stlcanaldistribucion").val() == "" || $("#stlcanaldistribucion").val() == "#"){
			cadena = cadena +"   * No se ha capturado el Canal de distribucion.\n"
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
  //metodo para linmpiar los campo
  function limpiar(){
  		$("#txtIdgestor").val("") 
  	 	$("#txtnombregestor").val("") 
  		$("#txtcomisiongestor").val("") 
  		$("#txtappaternogestor").val("")
  		$("#txtapmaternogestor").val("")
  		$("#stlcanaldistribucion").val("#")
  }
  //
  function iniciarTablagestores(){
	         $('#tabla_lista_gestores').dataTable({
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
	                    ordering: true});
  }
//--------------------------------------------ende helpers-----------------------------------------//