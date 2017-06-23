
//------------------------------------variables globales--------------------------------------------//

    var dialog;

//-------------------------------------eventos del sistema-----------------------------------------//
    //evento load
    $(document).ready(function(){
        //metodo k inicia los eventos de los imputs
        iniciarEventosInput();
        //validaciones de solo numeros o letras 
        agregarVladicaciones();
        //combos seleccionar 
        seleccionarCombos();
    });

    //eventos de inputs
    function iniciarEventosInput(){
        // click a boton guardar
        $("#GuardarColaboradores").click(function(){
            dialog = dialogNotificador();
            if( $("#txtIdcolaborador").val() == ""){
                if(validarCamposObligatorios()){
                    dialog.open();
                    guardarColaboradores();
                }
            }
        });
        //click a boton cancelar
        $("#CancelarColaboradores").click(function(){
            //
        });
        //perder el foco combo estados de domicilio personal
        $("#sltestadopersonal").blur(function(){
            if($("#sltestadopersonal").val() != "#"){
                consultarMunicipios($("#sltestadopersonal").val(),'sltciudaddomicilio');
            }
        });
        //perder el foco combo estados de empleo
        $("#sltestadotrabajo").blur(function(){
            if($("#sltestadotrabajo").val() != "#"){
                consultarMunicipios($("#sltestadotrabajo").val(),'sltciudadtrabajo');
            }
        });
        //perder el foco combo estados de empleo
        $("#sltciudaddomicilio").blur(function(){
            if($("#sltciudaddomicilio").val() != "#"){
                consultarLocalidades($("#sltciudaddomicilio").val(),'sltlocaliaddom');
            }
        });
        //perder el foco combo estados de empleo
        $("#sltciudadtrabajo").blur(function(){
            if($("#sltciudadtrabajo").val() != "#"){
                consultarLocalidades($("#sltciudadtrabajo").val(),'sltlocaliadempleo');
            }
        });
    }


//--------------------------------------------metodos abc ajax----------------------------------------//
    //metodo para guardar los colaboradores mediente ajax
    function guardarColaboradores(){
        var Nombre               = $("#txtNomcolaborador").val()
        var ApellidoP            = $("#txtApellidoPaterno").val()
        var ApellidoM            = $("#txtApellidoMaterno").val()
        var IdGestor             = $("#stlgestor").val()
        var IdCanaldis           = $("#stlcanal").val()
        var Correspondecia       = $("#txtCorrespondencia").val()
        var Commission           = $("#txtcommissioncol").val()
        var domicilio            = $("#txtADomicilio").val()
        var Cp                   = $("#txtcodpostald").val()
        var Telefono             = $("#txtATelefono").val()
        var IdEstado             = $("#sltestadopersonal").val()
        var Numeroint            = $("#txtNumerointpersonal").val()
        var NumeroExt            = $("#txtNumeropersonal").val()
        var IdMunicipio          = $("#sltciudaddomicilio").val()
        var IdLocalidad          = $("#sltlocaliaddom").val()
        var Empresa              = $("#txtnombreEmpresa").val()
        var PuestoEmpresa        = $("#txtpuesto").val()
        var DomiclioEmpresa      = $("#txtdomicilioempleo").val()
        var Cpempresa            = $("#txtcodpostalp").val()
        var NumerointEmpresa     = $("#txtNumerointempleo").val()
        var NumeroextEmpresa     = $("#txtNumeroempleo").val()
        var IdEstadoEmpresa      = $("#sltestadotrabajo").val()
        var TelefonoEmpresa      = $("#txtNumerop").val()     
        var IdmunicipioEmpresa   = $("#sltciudadtrabajo").val()
        var IdLocalidadEmpresa   = $("#sltlocaliadempleo").val()

            $.ajax({
                  url:'/guardarColaboradores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Nombre:Nombre,ApellidoP:ApellidoP,ApellidoM:ApellidoM,IdGestor:IdGestor,IdCanaldis:IdCanaldis,Correspondecia:Correspondecia,Commission:Commission,
                        domicilio:domicilio,Cp:Cp,Telefono:Telefono,IdEstado:IdEstado,Numeroint:Numeroint,NumeroExt:NumeroExt,IdMunicipio:IdMunicipio,IdLocalidad:IdLocalidad,
                        Empresa:Empresa,PuestoEmpresa:PuestoEmpresa,DomiclioEmpresa:DomiclioEmpresa,Cpempresa:Cpempresa,NumerointEmpresa:NumerointEmpresa,
                        NumeroextEmpresa:NumeroextEmpresa,IdEstadoEmpresa:IdEstadoEmpresa,TelefonoEmpresa:TelefonoEmpresa,IdmunicipioEmpresa:IdmunicipioEmpresa,
                        IdLocalidadEmpresa:IdLocalidadEmpresa}   
            }).done(function(data) {
                 //notificarrrr
                  notificar(true)
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });


    }
    //metodo para consultar los colaboradores
    function consultarColaboradores(){

    }
    //metodo para actualizar los datos de los colaboradores
    function actualizarColaboradores(){
        var id                   = $("#txtIdcolaborador").val()
        var Nombre               = $("#txtNomcolaborador").val()
        var ApellidoP            = $("#txtApellidoPaterno").val()
        var ApellidoM            = $("#txtApellidoMaterno").val()
        var IdGestor             = $("#stlgestor").val()
        var IdCanaldis           = $("#stlcanal").val()
        var Correspondecia       = $("#txtCorrespondencia").val()
        var Commission           = $("#txtcommissioncol").val()
        var domicilio            = $("#txtADomicilio").val()
        var Cp                   = $("#txtcodpostald").val()
        var Telefono             = $("#txtATelefono").val()
        var IdEstado             = $("#sltestadopersonal").val()
        var Numeroint            = $("#txtNumerointpersonal").val()
        var NumeroExt            = $("#txtNumeropersonal").val()
        var IdMunicipio          = $("#sltciudaddomicilio").val()
        var IdLocalidad          = $("#sltlocaliaddom").val()
        var Empresa              = $("#txtnombreEmpresa").val()
        var PuestoEmpresa        = $("#txtpuesto").val()
        var DomiclioEmpresa      = $("#txtdomicilioempleo").val()
        var Cpempresa            = $("#txtcodpostalp").val()
        var NumerointEmpresa     = $("#txtNumerointempleo").val()
        var NumeroextEmpresa     = $("#txtNumeroempleo").val()
        var IdEstadoEmpresa      = $("#sltestadotrabajo").val()
        var TelefonoEmpresa      = $("#txtNumerop").val()     
        var IdmunicipioEmpresa   = $("#sltciudadtrabajo").val()
        var IdLocalidadEmpresa   = $("#sltlocaliadempleo").val()

            $.ajax({
                  url:'/guardarColaboradores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{id:id,Nombre:Nombre,ApellidoP:ApellidoP,ApellidoM:ApellidoM,IdGestor:IdGestor,IdCanaldis:IdCanaldis,Correspondecia:Correspondecia,Commission:Commission,
                        domicilio:domicilio,Cp:Cp,Telefono:Telefono,IdEstado:IdEstado,Numeroint:Numeroint,NumeroExt:NumeroExt,IdMunicipio:IdMunicipio,IdLocalidad:IdLocalidad,
                        Empresa:Empresa,PuestoEmpresa:PuestoEmpresa,DomiclioEmpresa:DomiclioEmpresa,Cpempresa:Cpempresa,NumerointEmpresa:NumerointEmpresa,
                        NumeroextEmpresa:NumeroextEmpresa,IdEstadoEmpresa:IdEstadoEmpresa,TelefonoEmpresa:TelefonoEmpresa,IdmunicipioEmpresa:IdmunicipioEmpresa,
                        IdLocalidadEmpresa:IdLocalidadEmpresa}   
            }).done(function(data) {
                 //notificarrrr
                  notificar(true)
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });

    }
    //metodo para consultar los municipios
    function consultarMunicipios(id,input){
        $.ajax({
            url:'/ConsultarMunicipios',
            headers:{'X-CSRF-TOKEN':$("#tokena").val()},
            type:'POST',
            datatype:'html',
            data:{Id:id}
        }).done(function(data){

              mun = data[0];

              $("#"+input).html('');
              $("#"+input).append("<option value='#'>Selecione una Opcion</option>");
              for (var i = 0; i < mun.length; i++) {
                  $("#"+input).append("<option value=\""+mun[i].id+"\">"+mun[i].Nombre+"</option>");
              }

              
        }).fail(function(){

        })
    }

    function consultarLocalidades(id,input){
        $.ajax({
            url:'/ConsultarLocalidades',
            headers:{'X-CSRF-TOKEN':$("#tokena").val()},
            type:'POST',
            datatype:'html',
            data:{Id:id}
        }).done(function(data){

              mun = data[0];

              $("#"+input).html('');
              $("#"+input).append("<option value='#'>Selecione una Opcion</option>");
              for (var i = 0; i < mun.length; i++) {
                  $("#"+input).append("<option value=\""+mun[i].idLocalidad+"\">"+mun[i].Nombre+"</option>");
              }

              
        }).fail(function(){

        })
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

  //validaciones a los valores 
    function agregarVladicaciones(){
        $("#txtNumeropersonal").validateNumLetter(' 0123456789');
         $("#txtNumerointpersonal").validateNumLetter(' 0123456789');
         $("#txtNumeroempleo").validateNumLetter(' 0123456789');
         $("#txtNumerointempleo").validateNumLetter(' 0123456789');
    }
    //validacion de campos obligatorios
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""
        if($("#txtNomcolaborador").val() == ""){
            cadena = cadena +"   * No se ha capturado el Nombre.\n"
        }
        if($("#txtApellidoPaterno").val() == ""){
            cadena = cadena +"   * No se ha capturado el Apellido paterno.\n"
        }
         if($("#txtApellidoMaterno").val() == ""){
            cadena = cadena +"   * No se ha capturado el Apellido materno.\n"
        }
        if($("#txtcommissioncol").val() == ""){
            cadena = cadena +"   * No se ha capturado la Commission.\n"
        }
        if($("#txtADomicilio").val() == ""){
            cadena = cadena +"   * No se ha capturado el Domicilio.\n"
        }
        if($("#txtATelefono").val() == ""){
            cadena = cadena +"   * No se ha capturado el codigo postal.\n"
        }
        if($("#sltestadopersonal").val() == "#" || $("#sltestadopersonal").val()==""){
            cadena = cadena +"   * No se ha capturado el Estado.\n"
        }
        if($("#sltciudaddomicilio").val() == "#" || $("#sltciudaddomicilio").val()==""){
            cadena = cadena +"   * No se ha capturado el Municipio.\n"
        }
        if($("#sltlocaliaddom").val() == "#" || $("#sltlocaliaddom").val()==""){
            cadena = cadena +"   * No se ha capturado la localidad.\n"
        }
        if($("#stlgestor").val() == "#" || $("#stlgestor").val()==""){
            cadena = cadena +"   * No se ha capturado el Gestor.\n"
        }
        if($("#stlcanal").val() == "#" || $("#stlcanal").val()==""){
            cadena = cadena +"   * No se ha capturado el Canal.\n"
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
        $("#txtNomcolaborador").val("")
        $("#txtApellidoPaterno").val("")
        $("#txtApellidoMaterno").val("")
        $("#txtCorrespondencia").val("")
        $("#txtcommissioncol").val("")
        $("#txtADomicilio").val("")
        $("#txtcodpostald").val("")
        $("#txtATelefono").val("")
        $("#txtNumerointpersonal").val("")
        $("#txtNumeropersonal").val("")
        $("#txtnombreEmpresa").val("")
        $("#txtpuesto").val("")
        $("#txtdomicilioempleo").val("")
        $("#txtcodpostalp").val("")
        $("#txtNumerointempleo").val("")
        $("#txtNumeroempleo").val("")
        $("#txtNumerop").val("")
        $("#txtIdcolaborador").val("")
        
    }
    //seleccionar combosss
    function seleccionarCombos(){
        $("#sltestadopersonal").val(25);  
        $("#sltciudaddomicilio").val(6);
        $("#sltestadotrabajo").val(25);
        $("#sltciudadtrabajo").val(6)
    }