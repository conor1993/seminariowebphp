
//------------------------------------variables globales--------------------------------------------//

    var dialog;

//-------------------------------------eventos del sistema-----------------------------------------//
    //evento load
    $(document).ready(function(){
    //metodo k inicia los botones de guardar y cancelar
    iniciarEventosInput();
    //validaciones de solo numeros o letras 
    agregarVladicaciones()
    //iniciar tablas
    iniciartablaCanales()
    });
    //eventos de inputs
    function iniciarEventosInput(){
        // click a boton guardar
        $("#GuardarAutorizacion").click(function(){
            if (validarCamposObligatoriosrechazar()){
              if($("input[name='rdtestatus']:checked").val() == "A"){
                if(validarCamposObligatorios()){
                  dialogo = dialogNotificador();
                  dialog.open();
                  verificarBoletos()
                }
              }else if ($("input[name='rdtestatus']:checked").val() == "R") {
                  dialogo = dialogNotificador();
                  dialog.open();
                  actualizar();
              }  
            }
        });
        //click a boton cancelar
        $("#CancelarAutorizacion").click(function(){
            limpiar()
        });

       //evento al presionar el boton de buscar
       $("#btnbuscarfolio").click(function(){
            consultar($("#txtFoliosolicitud").val())
       });

       //evento enter folio 
       $("#txtFoliosolicitud").keypress(function(e){
            if(e.which  == 13){
                consultar($("#txtFoliosolicitud").val())
            }
       });

        //EVENTO AL PRESIONAR LA FILA SOBRE EL GRID
        $('#tabla_lista_autorizacion tbody').on('click', 'tr', function (event) { 
            var folio = $(this).closest('tr').data('codigo');
            consultar(folio)
        }); 

       //clicl en los radiobutton
        $('input[name="rdtestatus"]').click(function(){
            var estatus = $("input[name='rdtestatus']:checked").val(); 
            if (estatus=="A") {
                $("#asignacionboletosdiv").show();
            }else if(estatus=="R"){
                $("#asignacionboletosdiv").hide();
            }
        });

        $(".rdtestatus1").click(function(){
            $("#asignacionboletosdiv").show();
        });

        $(".rdtestatus2").click(function(){
            $("#asignacionboletosdiv").hide();
        });


    }


//--------------------------------------------metodos abc ajax----------------------------------------//

    function guardar(){

            // obtener boletos arreglos
            // se obtiene el arreglo de boletos k se van a comprobar
            var inicial = $("#txtbolinicial").val()
            var finall  = $("#txtbofinal").val()
            var sorteo  = $("#sltsorteosol").val()
            var arregloBoletos = obtenerRegloBoletos(inicial,finall) 
            var idsolicitud = $("#txtidsolicitud").val()
            //------------------------------------------------------

            var estatus = $("input[name='rdtestatus']:checked").val(); 
            var boletos = $("#txtboletosaut").val()
            var  idcolaborador= $("#txtcolaboradorsolid").val();
            if (estatus=='R'){boletos=0} 
            $.ajax({
                  url:'/guardarautorizacionboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Id:$("#txtidsolicitud").val(),BoletosAutorizados:boletos,Estatus:estatus,arregloBoletos:arregloBoletos,
                        idsolicitud:idsolicitud,sorteo:sorteo,IdSorteo:$("#sltsorteosol").val(),idcolaborador:idcolaborador}   
            }).done(function(data) {
                  //notificar 
                  if(data != "404"){
                    notificar(true,"Operacion Exitosa")
                  }else if (data = "404") {
                    notificar(false,"Error")
                  }
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
            });

    }

    function consultar(folio){
            $.ajax({
                  url:'/consultarsolicitudboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Folio:folio}   
            }).done(function(dat) {
                data = dat[0]
                if(data[0] != null){

                        $("#txtboletossol").val(data[0].BoletosSolicitados)
                        $("#sltsorteosol").val(data[0].IdSorteo)
                        $("#stlcanalsol").val(data[0].IdCanalDistribucion)
                        $("#stlgestorsol").val(data[0].IdGestor)
                        $("#txtcolaboradorsol").val(data[0].Nombre+' '+data[0].ApellidoP+' '+data[0].ApellidoM)
                        $("#txtcolaboradorsolid").val(data[0].IdColaborador)
                        $("#txtidsolicitud").val(data[0].Id)
                }else{
                    dialogo = dialogNotificador();
                    dialog.open();
                    limpiar()
                    notificar(true,"No existse la solicitud")
                }
            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
            });
    }

    function actualizar(){
            $.ajax({
                  url:'/EditarEstatussolicitudboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Id:$("#txtidsolicitud").val()}   
            }).done(function(data) {
                  //notificar 
                  if(data != "404"){
                    notificar(true,"Operacion Exitosa")
                  }else if (data = "404") {
                    notificar(false,"Error")
                  }
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
            });
    }

    function verificarBoletos(){
        var boletosRpetidos="";
        var inicial = $("#txtbolinicial").val()
        var finall  = $("#txtbofinal").val()
        var sorteo  = $("#sltsorteosol").val()
        // se obtiene el arreglo de boletos k se van a comprobar
        var arregloBoletos = obtenerRegloBoletos(inicial,finall) 

            $.ajax({
                  url:'/validarBoletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{sorteo:sorteo,arregloBoletos:arregloBoletos}   
            }).done(function(data) {
                  bol = data[0]

                  for(i=0;i<bol.length;i++){
                    boletosRpetidos=boletosRpetidos+"     *"+bol[i].NumeroBoleto+" \n"
                  }

                  //notificar 
                  if(boletosRpetidos != ""){
                    cadenaNotificadora = "Los sigueintes boletos no estan disponibles:\n\n"+ boletosRpetidos;
                    notificar(false,cadenaNotificadora)
                  }else {
                      guardar()
                  }
            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
            });
            
    }

//-------------------------------------HELPERS FUNCIONES----------------------------------------------//
  
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
            setTimeout ("dialogWarning.close()", 5000); 
      }
    }


    //validaciones a los valores  solo numeros
    function agregarVladicaciones(){
        $("#txtboletossol").validateNumLetter(' 0123456789');
        $("#txtboletosaut").validateNumLetter(' 0123456789');
    }

    //validacion de campos obligatorios
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""

        if($("#txtboletosaut").val()==""){
            cadena = cadena +"   * No se ha capturado el numero de boletos autorizados .\n"
        }
        if($("#txtbolinicial").val()==""){
            cadena = cadena +"   * No se ha capturado el numero de boleto inicial .\n"
        }
        if($("#txtbofinal").val()==""){
            cadena = cadena +"   * No se ha capturado el numero de boleto final .\n"
        }
        if($("#txtidsolicitud").val()==""){
            cadena = cadena + "     * No seleccionado la solicitud .\n"
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
    //valida los campos en caso de que el usuario rechaze la solicitud
    function validarCamposObligatoriosrechazar(){
        var valido= true
        var cadena = ""

        if($("#txtidsolicitud").val()==""){
            cadena = cadena + "     * No seleccionado la solicitud .\n"
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
        $("#txtboletossol").val("")
        $("#txtcolaboradorsolid").val("")
        $("#sltsorteosol").val("#")
        $("#txtcolaboradorsol").val("")
        $("#stlcanalsol").val("#")
        $("#stlgestorsol").val("#")
        $("#txtFoliosolicitud").val("")
        $("#txtidsolicitud").val("")
        $("#rdtaprobado").checked()=false
        $("#rdtrechazado").checked()=false
        
    }
    //OBTENER ARREGLO DE BOLETOS
    function obtenerRegloBoletos(inicial,finall){
        var limiteboletos = finall - inicial
        var boletos = []
        for (var i = 0; i < limiteboletos+1; i++) {
            boletos.push(inicial)
            inicial++
        }

        return boletos
    }

    //iniciar tabla de solicitudes
//SE INICIA EL DATATABLE
function iniciartablaCanales(){
         $('#tabla_lista_autorizacion').dataTable({
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

