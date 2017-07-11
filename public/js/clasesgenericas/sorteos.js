
//--------variables globales---------
    var dialog;

$(document).ready(function(){
  	//metodo que inicia la tabla
  	inciarTablaSorteos();
  	//metodo k inicia los botones de guardar y cancelar
  	iniciarBotones();
  	//metodo para buscar el sorteo dando click sobre el registro
  	buscarID();
  	//agregar validacion de solo numeros
  	agregarVladicaciones();
});

//---------------------------------------eventos del sistema----------------------------------//
  
    //escuchadores de los botones guardar y cancelar
    function iniciarBotones(){
        //EVENTO AL PRESIONAR EL BOTON DE CANCELAR
        $("#CancelarSorteo").click(function(){
           limpiar();
        });
        //EVENTO AL PRESIONAR EL BOTON DE GUARDAR
        $("#GuardarSorteo").click(function(){
            dialog = dialogNotificador();
            if( $("#txtIdsorteo").val() == ""){
            	if(validarCamposObligatorios()){
                	dialog.open();
                	guardarSorteo();
            	}
            }else{
            	if(validarCamposObligatorios()){
    	            dialog.open();
    	            actualizarSorteo()
            	}
            }
        });

    }

    ///buscar por id cuando presionan un registro sobre la tablaMetodo para buscar por id 
    function buscarID(){
      //OBTENETEMOS EL ID DEL LA FILA PRESIONADA
        $('#tabla_lista_sorteos tbody').on('click', 'tr', function (event) { 
              var id = $(this).closest('tr').data('codigo');
              dialog = dialogNotificador()
              dialog.open();
              consultarSorteo(id);
        });       
    }

//!---------------------------------------   end eventos----------------------------------//


//--------------------------------------------metodos abc ajax----------------------------------------//

    //metodo que sirve para guardar el sorteo de distribucion mediante ajax
    function guardarSorteo(){
            $.ajax({
                  url:UURL+'/guardarSorteos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{id:$("#txtIdsorteo").val(),Nombre:$("#txtnombresorteo").val(),Precio:$("#txtpreciosorteo").val(),Numeroporboleto:$("#txtnumeroboletosorteo").val()
                        ,Fechainicial:$("#txtfechainicial").val(),Fechalimite:$("#txtfechalimite").val(),CantidadBoletos:$("#txtcantidadboletos").val(),Folioinc:$("#txtFoliosorteo").val()}   
            }).done(function(data) {
                  // se notifica el exito de la operacion
                  if(data != "404"){
                    notificar(true,"Operacion Exitosa")
                  }else if (data = "404") {
                    notificar(false,"Error")
                  }
                  // se agrega el dato al grid
                  var rowNode = $('#tabla_lista_sorteos').DataTable().row.add([data[0].Nombre, data[0].Precio,data[0].Fecha,data[0].FechaLimite]).draw().node();
                  $(rowNode).attr('data-codigo',data[0].Id);
                  //limpiar campos
                  limpiar();
            }).fail( function() {
                //si falla se notifica
                notificar(false)
            });
    }

    //consulta de canal por id
    function consultarSorteo(id){
         $.ajax({
              url:UURL+'/consultarSorteos',
              headers:{'X-CSRF-TOKEN':$("#tokena").val()},
              type:'POST',
              datatype:'html',
              data:{idSorteo:id}    
         }).done(function(data) {
            $("#txtIdsorteo").val(data[0].Id)
          $("#txtnombresorteo").val(data[0].Nombre)
          $("#txtpreciosorteo").val(data[0].Precio)
          $("#txtnumeroboletosorteo").val(data[0].NumeroPorBoleto)
          $("#txtcantidadboletos").val(data[0].CantidadBoletos)
          $("#txtfechainicial").val(data[0].Fecha)
          $("#txtfechalimite").val(data[0].FechaLimite)
            notificar(true)
         }).fail( function() {
               notificar(false)
            });
    }

    // actualizar sorteo
    function actualizarSorteo(){
            $.ajax({
                  url:UURL+'/ActualizarSorteos',
                  headers:{'X-CSRF-TOKEN':$("#tokena").val()},
                  type:'POST',
                  datatype:'html',
                  data:{Id:$("#txtIdsorteo").val(),Nombre:$("#txtnombresorteo").val(),Precio:$("#txtpreciosorteo").val(),Numeroporboleto:$("#txtnumeroboletosorteo").val()
                        ,Fechainicial:$("#txtfechainicial").val(),Fechalimite:$("#txtfechalimite").val(),CantidadBoletos:$("#txtcantidadboletos").val()}    
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

//-----------------------------------------------end abc ajax----------------------------------------//


//----------------------------------------------helpers------------------------------------------------//
  // retorna el dialog
  function dialogNotificador(){
    dialog = new BootstrapDialog({message: 'Procesando...',closable: false,});
    return dialog
  }
  //se busca el registro modificado se borra y se agrega el nuevo
  function ActualizarRegistro(data){
    var idsorteo = data[0].Id 
    //RECORREMOS EL GRID EN BUSCA DE LA FILA AFECATADA Y SE ACTUALIZA
     $("#tabla_lista_sorteos tbody tr").each(function (index){
              if($(this).closest('tr').data('codigo') == idsorteo ){
                    $(this).find('td:eq(0)').html(data[0].Nombre);
                    $(this).find('td:eq(1)').html(data[0].Precio);
                    $(this).find('td:eq(2)').html(data[0].Fecha);
                    $(this).find('td:eq(3)').html(data[0].FechaLimite);
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
    $("#txtFoliosorteo").validateNumLetter(' 0123456789');
      $("#txtpreciosorteo").validateNumLetter(' 0123456789');
      $("#txtnumeroboletosorteo").validateNumLetter(' 0123456789');
      $("#txtcantidadboletos").validateNumLetter(' 0123456789');
  }
  //validar camposobligatorios
  function validarCamposObligatorios(){ 
    var valido= true
    var cadena = ""
    if($("#txtnombresorteo").val() == ""){
      cadena = cadena +"   * No se ha capturado el Nombre.\n"
    }
    if($("#txtpreciosorteo").val() == ""){
      cadena = cadena +"   * No se ha capturado el Precio.\n"
    }
    if($("#txtnumeroboletosorteo").val() == "0" || $("#txtnumeroboletosorteo").val() == ""){
      cadena = cadena +"   * No se ha capturado el Numero por boleto.\n"
    }
    if($("#txtFoliosorteo").val() == ""){
      cadena = cadena +"   * No se ha capturado el Folio.\n"
    }
    if($("#txtfechainicial").val() == ""){
      cadena = cadena +"   * No se ha capturado la Fecha inicial.\n"
    }
    if($("#txtfechalimite").val() == ""){
      cadena = cadena +"   * No se ha capturado la fecha limite.\n"
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
      $("#txtIdsorteo").val("")
      $("#txtnombresorteo").val("")
      $("#txtpreciosorteo").val("")
      $("#txtnumeroboletosorteo").val("")
      $("#txtcantidadboletos").val("")
  }
  //datable
  function inciarTablaSorteos(){
           $('#tabla_lista_sorteos').dataTable({
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

//----------------------------------------------end helpers------------------------------------------------//