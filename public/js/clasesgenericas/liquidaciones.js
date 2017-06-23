
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
            // 
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

    }


//--------------------------------------------metodos abc ajax----------------------------------------//

    function guardar(){

    }

    function consultar(){
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
                	for (var i = data.length - 1; i >= 0; i--) {
                		$('#tbodyCodigo tr:last').after('<tr><td>'+data[i].Folio+'</td><td>'+data[i].BoletosAutorizados+'</td><td>'+data[i].BoletosLiquidados+'</td><td>'+data[i].boletosdevueltos+'</td><td>'+data[i].MontoAcordado+'</td><td>'+data[i].Commission+'</td></tr>');
                	}
                	

                }

            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
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
