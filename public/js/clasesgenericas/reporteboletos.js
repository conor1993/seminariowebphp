
//------------------------------------variables globales--------------------------------------------//

    var dialog;

//-------------------------------------eventos del sistema-----------------------------------------//
    //evento load
    $(document).ready(function(){
    iniciarEventosInput();
    inciarTalba();
    });
    //eventos de inputs
    function iniciarEventosInput(){
        //click al boton de generar
        $("#Descargarpdf").click(function(){
            if(validarCamposObligatorios()){
                dialogo = dialogNotificador();
                switch ($("#stltiporeporte").val()) {
                    case '3':
                        $("#myform").attr("action","/crearpdfreporteboletos");
                        $("#myform").submit()
                        break;
                    case '1':
                        $("#myform").attr("action","/crearpdfreporteboletosAsignados");
                        $("#myform").submit()
                    break;
                    default:
                        alert("seleccione el tipo de reporte")
                        break;
                }

            }

        });
        // click a boton buscar
        $("#btuBuscarReporte").click(function(){
            if(validarCamposObligatorios()){
                limpiar()
                dialogo = dialogNotificador();
                switch ($("#stltiporeporte").val()) {
                    case '3':
                        dialog.open();
                        consultar()
                        break;
                    case '1':
                        dialog.open();
                        consultarasignados()
                    break;
                    default:
                        alert("seleccione el tipo de reporte")
                        break;
                }
            }
        });
        //click a boton cancelar
        $("#Cancelarpdf").click(function(){
            limpiar()
        });
        //evento al presionar el select de tipo de reporte
        $("#stltiporeporte").click(function(){
                switch ($("#stltiporeporte").val()) {
                    case '3':
                        $("#tblboletosliq").show()
                        $("#tblboletosasig").hide()
                        break;
                    case '1':
                        $("#tblboletosasig").show()
                        $("#tblboletosliq").hide()
                    break;
                    default:
                        break;
                }
        })
    }


//--------------------------------------------metodos abc ajax----------------------------------------//

    function guardar(){

    }
    //consulta de boletos liquidados
    function consultar(){
                var idsorteo = $("#stlsorteo").val()
                $.ajax({
                      url:UURL+'/consultarreporteboletos',
                      headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                      type:'POST',
                      datatype:'html',
                      data:{idsorteo:idsorteo}   
                }).done(function(data) {
                    datos= data[0]
                     //agregar los datos a LA TABLA
                     for (var i = 0; i < datos.length; i++) {
                         var rowNode = $('#tabla_lista_boletos').DataTable().row.add([datos[i].Nombre, datos[i].NumeroBoleto,datos[i].FechaPago]).draw().node();
                     }
                     dialog.close();
                }).fail( function() {
                    //si falla se notifica
                    //notificar(false,"Error")
                });
    }
    //consulta de boletos asignados
    function consultarasignados(){
                var idsorteo = $("#stlsorteo").val()
                $.ajax({
                      url:UURL+'/consultarboletosAsignados',
                      headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                      type:'POST',
                      datatype:'html',
                      data:{idsorteo:idsorteo}   
                }).done(function(data) {
                    datos= data[0]
                     for (var i = 0; i < datos.length; i++) {
                         var rowNode = $('#tabla_lista_boletosasig').DataTable().row.add([datos[i].Nombre, datos[i].NumeroBoleto]).draw().node();
                     }
                     dialog.close();
                }).fail( function() {
                    //si falla se notifica
                    //notificar(false,"Error")
                });
    }

    function actualizar(){

    }


//-------------------------------------HELPERS FUNCIONES----------------------------------------------//
  
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

    //limpiar campos 
    function limpiar(){
        $("input:text").val("") 
        $('#tabla_lista_boletos').DataTable().clear().draw();
        $('#tabla_lista_boletosasig').DataTable().clear().draw();

    }

    function inciarTalba(){
         $('#tabla_lista_boletos').dataTable({
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
         $('#tabla_lista_boletosasig').dataTable({
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