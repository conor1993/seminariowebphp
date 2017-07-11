
//-----------------------------------------------------------------------------------------------------//

//------------------------------------variables globales--------------------------------------------//

//-----------------------------------------------------------------------------------------------------//

    var dialog;

//-----------------------------------------------------------------------------------------------------//

//-------------------------------------eventos del sistema-----------------------------------------//

//-----------------------------------------------------------------------------------------------------//

    //evento load
    $(document).ready(function(){
        //iniciar tablas de autores  
        //iniciarTablaColaboradores();
        //metodo k inicia los botones de guardar y cancelar
        iniciarEventosInput();
        //validaciones de solo numeros o letras 
        agregarVladicaciones();
        //evento enter
    });
    //eventos de inputs
    function iniciarEventosInput(){

        // click a boton guardar
        $("#GuardarSolicitud").click(function(){
            dialogo = dialogNotificador();
            if($("#txtidsolicitud").val()==""){
                if(validarCamposObligatorios()){
                  dialog.open();
                  guardar();
                }
            }else{
                dialog.open();
                actualizar();
            }
        });

        //click a boton cancelar
        $("#CancelarSolicitud").click(function(){
            limpiar()
        });

        //evento enter en texbox colaborador
       $("#txtcolaboradorsol").keypress(function(e){
            if(e.which  == 13){
            dialogo = dialogNotificador();
            dialog.open();
                consultarColaborador($("#txtcolaboradorsol").val());
            }
       });

       //evento al presionar el boton de buscar
       $("#btnbuscarfolio").click(function(){
            consultar()
       });

       //evento enter folio 
       $("#txtFoliosolicitud").keypress(function(e){
            if(e.which  == 13){
                consultar()
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
       //
        //EVENTO AL PRESIONAR LA FILA SOBRE EL GRID
        $('#tabla_lista_col tbody').on('click', 'tr', function (event) { 
            var idcol  = $(this).closest('tr').find('td:eq(0)').text()
            var nombre = $(this).closest('tr').find('td:eq(1)').text()
                $("#myModal").modal("hide");
                $("#txtcolaboradorsol").val(nombre)
                $("#txtcolaboradorsolid").val(idcol)
        }); 
    }


    //funcion 

//-----------------------------------------------------------------------------------------------------//

//--------------------------------------------metodos abc ajax----------------------------------------//

//-----------------------------------------------------------------------------------------------------//

    function guardar(){


            $.ajax({
                  url:UURL+'/guardarsolicitudboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{IdColaborador:$("#txtcolaboradorsolid").val()
                  ,BoletosSolicitados:$("#txtboletossol").val(),BoletosAutorizados:""
                   ,Estatus:'V',IdSorteo:$("#sltsorteosol").val()}   
            }).done(function(data) {
                  //notificar 
                  notificar(true,"Se guardo con exito el folio "+data[0].Folio)
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false,"error")
            });
    }

    function consultar(){
            $.ajax({
                  url:UURL+'/consultarsolicitudboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Folio:$("#txtFoliosolicitud").val()}   
            }).done(function(dat) {
                data = dat[0]
                if(data[0] != null){

                        $("#txtboletossol").val(data[0].BoletosSolicitados)
                        $("#sltsorteosol").val(data[0].IdSorteo)
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
                  url:UURL+'/Actualizarsolicitudboletos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Id:$("#txtidsolicitud").val(),IdColaborador:$("#txtcolaboradorsolid").val()
                  ,BoletosSolicitados:$("#txtboletossol").val(),BoletosAutorizados:""
                   ,Estatus:'V',IdSorteo:$("#sltsorteosol").val()}   
            }).done(function(data) {
                  //notificar 
                  notificar(true,"Operacion Exitosa")
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
            });
    }

    function consultarColaborador(id){
            $.ajax({
                  url:UURL+'/consultarColaboradores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{id:id}   
            }).done(function(data) {
                if(data[0] != null){
                  $("#txtcolaboradorsol").val(data[0].Nombre+' '+data[0].ApellidoP+' '+data[0].ApellidoM)
                  $("#txtcolaboradorsolid").val(data[0].Id)
                   dialog.close()
                }else{
                    notificar(true,"No existe el colaborador")
                }
            }).fail( function() {
                //si falla se notifica
                notificar(false,"Error")
            });
    }
    function consultarNombreCol(Nombre){
           $('#tbodycol tr').remove()
            $.ajax({
                  url:UURL+'/consultarColbaradorNombretodos',
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


//-----------------------------------------------------------------------------------------------------//

//-------------------------------------HELPERS FUNCIONES----------------------------------------------//

//-----------------------------------------------------------------------------------------------------//
  
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
        $("#txtboletossol").validateNumLetter(' 0123456789');
        $("#txtboletosaut").validateNumLetter(' 0123456789');
    }

    //validacion de campos obligatorios
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""
        if($("#txtboletossol").val() == ""){
            cadena = cadena +"   * No se ha capturado los boletos solicitados .\n"
        }

        if($("#sltsorteosol").val()== "#"){
            cadena= cadena +"    * No se ha capturado el sorteo .\n"
        }

        if($("#txtcolaboradorsolid").val()==""){
            cadena = cadena + "     * No se ha capturado el colaborador .\n"
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
        $("#txtFoliosolicitud").val("")
        $("#txtidsolicitud").val("")
     }

