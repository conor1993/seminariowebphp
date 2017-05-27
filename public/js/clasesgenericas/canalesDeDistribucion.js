
//variables
var  dialog;
$(document).ready(function(){
    //funciones
    agregarVladicaciones();
    iniciartablaCanales();
    iniciarBotones();
    buscarID();
    limpiar()
});
//validaciones a los valores 
function agregarVladicaciones(){
  $("#txtacomisioncan").validateNumLetter(' 0123456789');
}
//
function dialogNotificador(){
  dialog = new BootstrapDialog({message: 'Procesando.',closable: false,});
  return dialog
}
//metodo para linmpiar los campo
function limpiar(){
    $("#txtIdcanal").val("")
    $("#txtnombrecan").val("")
    $("#txtacomisioncan").val("")
}
//se inician los botones  agregando el evento
function iniciarBotones(){
    //EVENTO AL PRESIONAR EL BOTON DE CANCELAR
    $("#CancelarCanalesDistribucion").click(function(){
       limpiar();
    });
    //EVENTO AL PRESIONAR EL BOTON DE GUARDAR
    $("#GuardarCanalesDistribucion").click(function(){
        dialog = dialogNotificador();
        if( $("#txtIdcanal").val() == ""){
            dialog.open();
            guardarCanalDistribucion();
        }else{
            dialog.open();
            actualizarCanalDistribucion()
        }
    });
    
}
//metodo que sirve para guardar el canal de distribucion mediante ajax
function guardarCanalDistribucion(){
        $.ajax({
              url:'/guardarCanalDistribucion',
              headers:{'X-CSRF-TOKEN':$("#tokena").val()},
              type:'POST',
              datatype:'html',
              data:{id:$("#txtIdcanal").val(),Nombre:$("#txtnombrecan").val(),Comision:$("#txtacomisioncan").val()}   
        }).done(function(data) {
              // se agrega el dato al grid
              var rowNode = $('#tabla_lista_canales').DataTable().row.add([data[0].Nombre, data[0].Comision]).draw().node();
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
//acutalizar canales de distribucion
function actualizarCanalDistribucion(){
        $.ajax({
              url:'/ActualizaRrCanalDistribucion',
              headers:{'X-CSRF-TOKEN':$("#tokena").val()},
              type:'POST',
              datatype:'html',
              data:{Id:$("#txtIdcanal").val(),Nombre:$("#txtnombrecan").val(),Comision:$("#txtacomisioncan").val()}    
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
//se busca el registro modificado se borra y se agrega el nuevo
function ActualizarRegistro(data){
  var idcanal = data[0].Id 
  //RECORREMOS EL GRID EN BUSCA DE LA FILA AFECATADA Y SE ACTUALIZA
   $("#tabla_lista_canales tbody tr").each(function (index){
            if($(this).closest('tr').data('codigo') == idcanal ){
                  $(this).find('td:eq(0)').html(data[0].Nombre);
                  $(this).find('td:eq(1)').html(data[0].Comision);
            }
        })
}
//metodo notificacion en este metodo se modifica el modal agregando el mesnaje y cerrando el modal
function notificar(exito){
    if(exito){
        dialog.setMessage("Operacion Exitosa")
    }else{
        dialog.setMessage("Ocurrio un error intentelo de nuevo")
    }
    setTimeout ("dialog.close()", 1000); 
}

//Metodo para buscar por id 
function buscarID() {
  //OBTENETEMOS EL ID DEL LA FILA PRESIONADA
    $('#tabla_lista_canales tbody').on('click', 'tr', function (event) { 
          var id = $(this).closest('tr').data('codigo');
          dialog = dialogNotificador()
          dialog.open();
          consultarCanalDistribucion(id);
    });       
}
//consulta de canal por id
function consultarCanalDistribucion(id){
     $.ajax({
          url:'/consultarCanalDistribucion',
          headers:{'X-CSRF-TOKEN':$("#tokena").val()},
          type:'POST',
          datatype:'html',
          data:{idCanal:id}    
     }).done(function(data) {
        $("#txtIdcanal").val(data[0].Id)
        $("#txtnombrecan").val(data[0].Nombre)
        $("#txtacomisioncan").val(data[0].Comision)
        notificar(true)
     }).fail( function() {
           notificar(false)
        });
}
//
function valiarCamposObligatorios(){

}
//SE INICIA EL DATATABLE
function iniciartablaCanales(){
         $('#tabla_lista_canales').dataTable({
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
