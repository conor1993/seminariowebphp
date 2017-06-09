//-----------------------------------------varibles de sistema globales-------------------------->
    var dialog;
//-----------------------------------------fIN--------------------------------------------------->

//----------------------------------------Eventos del sistema------------------------------------>
  // evento load 
    $(document).ready(function(){
        iniciartablaCobradores();
        //metodo k inicia los botones de guardar y cancelar
        iniciarBotones();
        //metodo para buscar el Cobrador dando click sobre el registro
        buscarID();
        //agregar validacion de solo numeros
        agregarVladicaciones();
    });

  //eventos click botones
    function iniciarBotones(){
        //EVENTO AL PRESIONAR EL BOTON DE CANCELAR
        $("#CancelarCobradores").click(function(){
           limpiar();
        });
        //EVENTO AL PRESIONAR EL BOTON DE GUARDAR
        $("#GuardarCobradores").click(function(){
            dialog = dialogNotificador();
            if( $("#txtIdCobradores").val() == ""){
                if(validarCamposObligatorios()){
                    dialog.open();
                    guardarCobradores();
                }
            }else{
                if(validarCamposObligatorios()){
                    dialog.open();
                    actualizarCobradores()
                }
            }
        });
    }

    ///buscar por id cuando presionan un registro sobre la tablaMetodo para buscar por id 
    function buscarID(){
      //OBTENETEMOS EL ID DEL LA FILA PRESIONADA
        $('#tabla_lista_cobradores tbody').on('click', 'tr', function (event) { 
              var id = $(this).closest('tr').data('codigo');
              dialog = dialogNotificador()
              dialog.open();
              consultarCobrador(id);
        });       
    }

//-----------------------------------------FIN--------------------------------------------------->


//---------------------------------------Metodos abc ajax --------------------------------------->
    //metodo para guardar cobradores
    function guardarCobradores(){
            $.ajax({
                  url:'/guardarCobradores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{id:$("#txtIdcobrador").val(),Nombre:$("#txtnombrecol").val(),Apellidop:$("#txtapellidopcol").val(),Apellidom:$("#txtapellidomaternocol").val()
                        ,Commission:$("#txtacomisioncol").val(),Serie:$("#txtseriecol").val()}   
            }).done(function(data) {
                  // se agrega el dato al grid
                  var rowNode = $('#tabla_lista_cobradores').DataTable().row.add([data[0].Nombre, data[0].ApellidoP,data[0].ApellidoM]).draw().node();
                  $(rowNode).attr('data-codigo',data[0].id);
                  // se notifica el exito de la operacion
                  notificar(true)
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });
    }

    //metodo para consultar cobradores
    function  consultarCobrador(id){
            $.ajax({
                  url:'/consultarCobradores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{id:id}   
            }).done(function(data) {
                $("#txtIdCobradores").val(data[0].Id)
                $("#txtnombrecol").val(data[0].Nombre)
                $("#txtapellidopcol").val(data[0].ApellidoP)
                $("#txtapellidomaternocol").val(data[0].ApellidoM)
                $("#txtacomisioncol").val(data[0].Commission)
                $("#txtseriecol").val(data[0].Serie)
                  notificar(true)
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });

    }

    //metodo para actualizar cobradores
    function  actualizarCobradores(){
            $.ajax({
                  url:'/ActualizaRrCobradores',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{id:$("#txtIdCobradores").val(),Nombre:$("#txtnombrecol").val(),Apellidop:$("#txtapellidopcol").val(),Apellidom:$("#txtapellidomaternocol").val()
                        ,Commission:$("#txtacomisioncol").val(),Serie:$("#txtseriecol").val()}   
            }).done(function(data) {
                $("#txtIdCobradores").val(data[0].Id)
                $("#txtnombrecol").val(data[0].Nombre)
                $("#txtapellidopcol").val(data[0].ApellidoP)
                $("#txtapellidomaternocol").val(data[0].ApellidoM)
                $("#txtacomisioncol").val(data[0].Commission)
                $("#txtseriecol").val(data[0].Serie)
                  notificar(true)
                  limpiar();
                  ActualizarRegistro(data)
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });
    }
//--------------------------------------- FIN---------------------------------------------------->

//----------------------------------------helpers------------------------------------------------>
  // retorna el dialog
    function dialogNotificador(){
        dialog = new BootstrapDialog({message: 'Procesando...',closable: false,});
        return dialog
    }

  //se busca el registro modificado se borra y se agrega el nuevo
    function ActualizarRegistro(data){
        var Id = data[0].Id 
    //RECORREMOS EL GRID EN BUSCA DE LA FILA AFECATADA Y SE ACTUALIZA
     $("#tabla_lista_cobradores tbody tr").each(function (index){
              if($(this).closest('tr').data('codigo') == Id ){
                    $(this).find('td:eq(0)').html(data[0].Nombre);
                    $(this).find('td:eq(1)').html(data[0].ApellidoP);
                    $(this).find('td:eq(2)').html(data[0].ApellidoM);
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
        $("#txtacomisioncol").validateNumLetter(' 0123456789');
    }

  //validar camposobligatorios
    function validarCamposObligatorios(){ 
        var valido= true
        var cadena = ""

        if($("#txtnombrecol").val() == ""){
          cadena = cadena +"   * No se ha capturado el Nombre.\n"
        }
        if($("#txtapellidopcol").val() == ""){
          cadena = cadena +"   * No se ha capturado el Apellido Paterno .\n"
        }
        if($("#txtapellidomaternocol").val() == ""){
          cadena = cadena +"   * No se ha capturado el Apellido Materno.\n"
        }
        if($("#txtacomisioncol").val() == ""){
          cadena = cadena +"   * No se ha capturado la Commission.\n"
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
        $("#txtIdCobradores").val("")
        $("#txtnombrecol").val("")
        $("#txtapellidopcol").val("")
        $("#txtapellidomaternocol").val("")
        $("#txtacomisioncol").val("")
        $("#txtseriecol").val("")
    }

  //metodo inicia la tabla colaboradores
    function iniciartablaCobradores(){

             $('#tabla_lista_cobradores').dataTable({

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
                        ordering: true });
    }
//-----------------------------------------FIN--------------------------------------------------->
