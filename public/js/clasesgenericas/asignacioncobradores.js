//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------VARIABLES GLOBALES---------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------

var dialog

//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------EVENTOS DEL SISTEMA--------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------
	
	//EVENTO LOAD
	$(document).ready(function(){

		//escuchadores
		iniciareventosinput()
		//inicar las tablas
		iniciartablas();
	});

	//METODO QUE ESCUCHA LOS EVENTOS DEL SISTEMA
	function iniciareventosinput(){

		//evento al presionae el boton de guardar
		$("#GuardarAsignacion").click(function(){
			if(validarCamposObligatorios()){
				dialog.open();
				guardar()
			}
			
		});
       //boton para buscar colaborador por nombre
       $("#btnbuscarCol").click(function (){
            $("#myModal").modal()
       });
        //ENTER EN LA CAJA DE TEXTO DE COLABORDOR
       $("#txtNomcol").keypress(function(e){
            if(e.which  == 13){
                dialogo = dialogNotificador();
                dialog.open();
            	consultarNombreCol($("#txtNomcol").val());
            }
       });
        //EVENTO AL PRESIONAR LA FILA SOBRE EL GRID
        $('#tabla_lista_col tbody').on('click', 'tr', function (event) { 
            var idcol = $(this).closest('tr').data('col');
                $("#txtidNomcolaborador").val($(this).closest('tr').data('col'))
                $("#txtNomcolaborador").val($(this).closest('tr').find('td:eq(1)').text())
                $("#myModal").modal("hide");
        }); 
	}




//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------METODOS ABC AJAX-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------


	function guardar(){
		var IdCobrador = $("#idcobrador").val()
		var IdColaborador = $("#txtidNomcolaborador").val()

		$.ajax({
			url:'/guardarasignacioncobradores',
			headers:{'X-CSRF-TOKEN':$("#tokena").val()},
			type:'POST',
			datatype:'HTML',
			data:{IdColaborador:IdColaborador,IdCobrador:IdCobrador}
		}).done(function(data){
			 notificar(true,"Exito")
		}).fail( function(){
                //si falla se notifica
                notificar(false,"Error")
		});
	}

	function actualizar(){

	}

    function consultarNombreCol(Nombre){
           $('#tbodycol tr').remove()
            $.ajax({
                  url:'/consultarColbaradorNombre',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Nombre:Nombre}   
            }).done(function(dat) {
                data = dat[0]
                if(data[0] != null){
                    $('#tbodycol tr').remove()
                    for (var i = data.length - 1; i >= 0; i--) {
                            $('#tbodycol').append('<tr data-col="'+data[i].Id+'" ><td>'+data[i].Id+'</td><td>'+data[i].Nombre+' '+data[i].ApellidoP+' '+data[i].ApellidoM+'</td><td>'+data[i].Domicilio+'</td></tr>');
                    }
                    dialog.close()
                }else{
                    notificar(true,"No se encontraron coincidencias")
                }
            }).fail( function(){
                //si falla se notifica
                notificar(false,"Error")
            });
    }






//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------HELPERS--------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------


    // retorna el dialog
    function dialogNotificador(){
        dialog = new BootstrapDialog({message: 'Procesando...',closable: false,});
        return dialog
    }

    //metodo notificacion en este metodo se modifica el modal agregando el mesnaje y cerrando el modal
    function notificar(exito,text){
      if(exito){
              dialog.setMessage(text)
              dialog.setClosable(true);
              setTimeout ("dialog.close()", 5000);
      }else{
            dialog.close()
            dialogWarning = dialogNotificador();
            dialogWarning.setType(BootstrapDialog.TYPE_WARNING);
            dialogWarning.setMessage(text)
            dialogWarning.open()
            setTimeout ("dialogWarning.close()", 2000); 
      }
    }
    //validaciones a los valores  solo numeros
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""
        if($("#idcobrador").val() == "" || $("#idcobrador").val() == "#"){
            cadena = cadena +"   * No se ha capturado el cobrador .\n"
        }
        if($("#txtNomcolaborador").val() == ""){
            cadena = cadena +"   * No se ha capturado el colaborador .\n"
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
    //limpiar campos 
    function limpiar(){
        $("input:text").val("") 
        $('#tbodyCodigo tr').remove()
    }

    //inicar tablas
    function iniciartablas(){
         $('#tabla_lista_asignacion').dataTable({
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
