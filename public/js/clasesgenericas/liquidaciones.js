
//------------------------------------variables globales--------------------------------------------//

    var dialog;

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
                dialog.open();
                guardar()
            }else if ($("input[name='rdtliqu']:checked").val() == 'P') {
                dialog.open();
                actualizar();
            }

        });
        //click a boton cancelar
        $("#CancelarPago").click(function(){
            //
        });
        //perder el foco combo estados
        $("#txtdevolbiendo").blur(function(){
           validarCero()
        });
        //ENTER EN LA CAJA DE TEXTO DE COLABORDOR
       $("#txtNomcolaborador").keypress(function(e){
            if(e.which  == 13){
            	consultar();
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

       $('#txttotal').val(monto)

        // MEDIANTE AJAX REALIZAMOS LA ACTUALIZACION DE LOS DATOS DE LA DEUDA
        
            $.ajax({
                  url:'/guardarliquidacionboletos',
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

    function consultar(){
        var contador=0
        var columna =""

            $.ajax({
                  url:'/consultarliquidacionboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{idsorteo:$("#stlsorteo").val(),idcol:$("#txtNomcolaborador").val()}   
            }).done(function(dat) {
                data = dat[0]
                if(data[0] != null){
                	$("#txtNomcolaborador").val(data[0].Nombre+' '+data[0].ApellidoP+' '+data[0].ApellidoM)
                	$("#txtADomicilio").val(data[0].Domicilio)
                	$("#txtcodpostald").val(data[0].Cp)
                	$("#txtNumerointpersonal").val(data[0].Numeroint)
                	$("#sltciudaddomicilio").val(data[0].IdMunicipio)
                	$("#txtNumeropersonal").val(data[0].NumeroExt)
                	$("#sltlocaliaddom").val(data[0].IdLocalidad)
                	$("#txtComission").val(data[0].Commission)
                	//llenar tabla de saldos
                    var anterior=0

                    for (var i = data.length - 1; i >= 0; i--) {
                        if(anterior != data[i].IdColaborador){
                            $('#tbodyCodigo').append('<tr data-deuda="'+data[i].Id+'" ><td>'+data[i].Folio+'</td><td>'+data[i].BoletosAutorizados+'</td><td>'+data[i].BoletosLiquidados+'</td><td>'+data[i].boletosdevueltos+'</td><td>'+data[i].MontoAcordado+'</td><td>'+data[i].Commission+'<td><input type="radio" name="radiosol"></td>'+'</tr>');
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
            }        });
        
            $.ajax({
                  url:'/Actualizarliquidacionboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Id:iddeuda,arregloBoletos:arregloBoletos,sorteo:sorteo,cantLiquidar:cantLiquidar}   
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
        $("#txtliquidando").val("") 
        
    }

    //validar campo devolucion
    function validarCero(){
    	if($("#txtdevolbiendo").val()== ""){
    		$("#txtdevolbiendo").val("0")
    	}
    }
