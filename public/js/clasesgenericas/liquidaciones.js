
//------------------------------------variables globales--------------------------------------------//

    var dialog;
    var dialogobusqueda;
//-------------------------------------eventos del sistema-----------------------------------------//
    //evento load
    $(document).ready(function(){
    //metodo k inicia los botones de guardar y cancelar
    iniciarEventosInput();
    //validaciones de solo numeros o letras 
    agregarVladicaciones()

    });
    //eventos de inputs
    function iniciarEventosInput(){
        // click a boton guardar
        $("#GuardarPago").click(function(){
            dialogo = dialogNotificador();
            if($("input[name='rdtliqu']:checked").val() == 'T'){
                guardar()
            }else if ($("input[name='rdtliqu']:checked").val() == 'P') {
                actualizar();
            }
        });
        //click a boton cancelar
        $("#CancelarPago").click(function(){
            limpiar()
        });
        //perder el foco combo estados
        $("#txtdevolbiendo").blur(function(){
           validarCero()
        });
        //ENTER EN LA CAJA DE TEXTO DE COLABORDOR
       $("#txtNomcolaborador").keypress(function(e){
            if(e.which  == 13){
                dialogo = dialogNotificador();
                dialog.open();
            	consultar();
            }
       });
       //boton para buscar colaborador por nombre
       $("#btnbuscarCol").click(function (){
            $("#myModal").modal()
       });

       $("#txtNomcol").keypress(function(e){
            if(e.which  == 13){
                dialogo = dialogNotificador();
                dialog.open();
                consultarNombreCol($("#txtNomcol").val())
            }
       });

       //EVENTO DISPARADO AL PRESIONAR LOS RADIO BUTTON
       //clicl en los radiobutton
        $('input[name="rdtliqu"]').click(function(){
            var estatus = $("input[name='rdtliqu']:checked").val(); 
            if (estatus=="A") {
                $("#divcobros1").show();
                $("#divcobros2").hide();
            }else if(estatus=="R"){
                $("#divcobros2").show();
                $("#divcobros1").hide();
            }
        });
        $(".rdtestatus1").click(function(){
                $("#divcobros1").show();
                $("#divcobros2").hide();
        });

        $(".rdtestatus2").click(function(){
                $("#divcobros2").show();
                $("#divcobros1").hide();
        });
        //EVENTO AL PRESIONAR LA FILA SOBRE EL GRID
        $('#tabla_lista_col tbody').on('click', 'tr', function (event) { 
            var idcol = $(this).closest('tr').data('col');
                dialogo = dialogNotificador();
                dialog.open();
                $("#myModal").modal("hide");
                $("#txtNomcolaborador").val(idcol)
                consultar()
        }); 
    }


//--------------------------------------------metodos abc ajax----------------------------------------//

    function guardar(){
        var iddeuda
        var monto
        var entregados

        //obteniendo el id de la deuda k se enecnura en la tabla de  saldos
        $("input[name=radiosol]").each(function (index) {  
            if($(this).is(':checked')){
                iddeuda = $(this).closest('tr').data('deuda')
                monto  = $(this).closest('tr').find('td:eq(4)').text()
                entregados = $(this).closest('tr').find('td:eq(1)').text()
            }
        });

        

        BootstrapDialog.confirm('Desea continuar el total es '+monto, function(result){
            if(result) {
                // se abre el dialogo para procesar la opercacion
                dialog.open();

                $.ajax({
                      url:UURL+'/guardarliquidacionboletos',
                      headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                      type:'POST',
                      datatype:'html',
                      data:{Id:iddeuda,Monto:monto,entregados:entregados}   
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
        });
        // MEDIANTE AJAX REALIZAMOS LA ACTUALIZACION DE LOS DATOS DE LA DEUDA
        


    }

    function consultar(){
        var contador=0
        var columna =""

            $.ajax({
                  url:UURL+'/consultarliquidacionboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{idsorteo:$("#stlsorteo").val(),idcol:$("#txtNomcolaborador").val()}   
            }).done(function(dat) {
                data = dat[0]
                if(data[0] != null){
                    var liquidados ='0'
                    var devueltos = '0'

                	$("#txtNomcolaborador").val(data[0].Nombre+' '+data[0].ApellidoP+' '+data[0].ApellidoM)
                	$("#txtADomicilio").val(data[0].Domicilio)
                	$("#txtcodpostald").val(data[0].Cp)
                	$("#txtNumerointpersonal").val(data[0].Numeroint)
                	$("#sltciudaddomicilio").val(data[0].IdMunicipio)
                	$("#txtNumeropersonal").val(data[0].NumeroExt)
                	$("#sltlocaliaddom").val(data[0].IdLocalidad)
                	$("#txtComission").val(data[0].Commission)
                    $("#txtidsolicitud").val(data[0].IdColaborador);

                	//llenar tabla de saldos
                    var anterior=0

                    for (var i = data.length - 1; i >= 0; i--) {
                        if(anterior != data[i].IdColaborador){
                            if(data[i].BoletosLiquidados!=null){liquidados=data[i].BoletosLiquidados}
                            if(data[i].boletosdevueltos!=null){devueltos=data[i].boletosdevueltos}
                            $('#tbodyCodigo').append('<tr data-deuda="'+data[i].Id+'" ><td>'+data[i].Folio+'</td><td>'+data[i].BoletosAutorizados+'</td><td>'+liquidados+'</td><td>'+devueltos+'</td><td>'+data[i].MontoAcordado+'</td><td>'+data[i].Commission+'<td><input type="radio" name="radiosol"></td>'+'</tr>');
                        }
                        anterior = data[i].IdColaborador
                            columna = columna+'<td>'+data[i].NumeroBoleto+'</td><td><input type="checkbox" name="chk" value="'+data[i].NumeroBoleto+'"></td>'
                            contador++
                            if(contador == 4){
                                columna ='<tr>'+columna+'</tr>'
                                contador=0
                            }
                    }

                    //AGREGAR COLUMNAS DE BOLETOS
                    if($('#tbodyCodigo').find('tr').length  == 1){
                        $('#tbodyboletos').append(columna)
                    }
                    //notificar el exito
                   dialog.close()
                }else{
                    notificar(true,"No se encontro el deudor")
                }
            }).fail( function(){
                //si falla se notifica
                notificar(false,"Error")
            });
    }

    function actualizar(){
        arregloBoletos =[]
        var iddeuda
        var sorteo  = $("#stlsorteo").val()
        var cantLiquidar=0
        var idcolaborador = $("#txtidsolicitud").val();
        //obteniendo el id de la deuda k se enecnura en la tabla de  saldos
        $("input[name=chk]").each(function (index) {  
            if($(this).is(':checked')){
                arregloBoletos.push($(this).val())  
            }else{
                cantLiquidar = cantLiquidar+1
            }

        });
        //obtener datos
        $("input[name=radiosol]").each(function (index) {  
            if($(this).is(':checked')){
                iddeuda = $(this).closest('tr').data('deuda')
            } 
         });


        BootstrapDialog.confirm('Desea continuar', function(result){
            if(result) {
                // se abre el dialogo para procesar la opercacion
                dialog.open();
                $.ajax({
                      url:UURL+'/Actualizarliquidacionboletos',
                      headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                      type:'POST',
                      datatype:'html',
                      data:{Id:iddeuda,arregloBoletos:arregloBoletos,sorteo:sorteo,cantLiquidar:cantLiquidar,idcolaborador:idcolaborador}   
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
        });        
    }

    function consultarNombreCol(Nombre){
           $('#tbodycol tr').remove()
            $.ajax({
                  url:UURL+'/consultarColbaradorNombre',
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
            setTimeout ("dialogWarning.close()", 2000); 
      }
    }

    //validaciones a los valores  solo numeros
    function agregarVladicaciones(){
        $("#txtdevolbiendo").validateNumLetter(' 0123456789');
    }
    //validacion de campos obligatorios
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""
        if($("#txtliquidando").val() == ""){
            cadena = cadena +"   * No se ha capturado los boletos a liquidar .\n"
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

    //validar campo devolucion
    function validarCero(){
    	if($("#txtdevolbiendo").val()== ""){
    		$("#txtdevolbiendo").val("0")
    	}
    }
    // ventana de dialogo de confirmacion
    function ventanaConfirmacion(mesnaje){
        var flag= false
        BootstrapDialog.show({
            title: 'Button Hotkey',
            message: $(mesnaje),
            buttons: [{
                label: '(Enter) Button A',
                cssClass: 'btn-primary',
                hotkey: 13, // Enter.
                action: function() {
                    flag = true
                }
            }]
        });
    }