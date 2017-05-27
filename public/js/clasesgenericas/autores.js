//variables globales
    //botones
    var btnGuardarAutor;
    //cajas de texto
    var txtIdAut;
    var txtNombreAut;
    var sltPais; 
    //token
    var token;


$(document).ready(function () { 
    //iniciar tablas
    iniciartablaAutores();
    //iniciar botones
    iniciarElementosAutores();
    // evento clicl sobre columna
    buscarID()
});


function iniciarElementosAutores(){
     //token
     token = $("#tokena").val();
    //cajas de texto
     txtIdAut = $("#txtId");
     txtNombreAut = $("#txtNombreAutor"); 
     //combos
     sltPais = $("#stlPais");
     //botones
     btnGuardarAutor = $("#GuardarAutores");
     btnGuardarAutor.click(function(){
        guardarAutor();    
     })
     btnGuardarAutor = $("#CancelarAutores");
     btnGuardarAutor.click(function(){
        cancelarguardar();    
     })

}

function guardarAutor(){
      nombre= txtNombreAut.val()
      pais = sltPais.val()
     $.ajax({
          url:'/guardarAutor',
          headers:{'X-CSRF-TOKEN':token},
          type:'POST',
          datatype:'html',
          data:{Nombre:nombre,IdPais:pais}    
     }).done(function(data) {

        var rowNode = $('#tabla_lista_autores').DataTable().row.add([data[0].id, data[0].Nombre, data[0].IdPais]).draw().node();

        $(rowNode).attr('data-codigo',data[0].id); 
        //$(rowNode).find('td').eq(1).addClass('myclas');
        //$(rowNode).find('td').eq(2).addClass('myclas');

     });

}

function cancelarguardar(){

         $("#txtId").prop("value", "");
         $("#txtNombreAutor").prop("value", "");
         $("#stlPais").prop("value", "#");
}


function buscarID() {
    $('#tabla_lista_autores tbody').on('click', 'tr', function (event) { 
      var id = $(this).closest('tr').data('codigo');
      consultarAutor(id)
    }); 
       
}

function consultarAutor(idAutor){
     $.ajax({
          url:'/consultarAutor',
          headers:{'X-CSRF-TOKEN':token},
          type:'POST',
          datatype:'html',
          data:{idAutor:idAutor}    
     }).done(function(data) {
         $("#txtId").prop("value", data[0].Id);
         $("#txtNombreAutor").prop("value", data[0].Nombre);
         $("#stlPais").prop("value", data[0].IdPais);
     });
}

function iniciartablaAutores(){

         $('#tabla_lista_autores').dataTable({

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