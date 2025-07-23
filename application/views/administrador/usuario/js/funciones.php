<script>
   $(document).ready(function(){
    
	   var table = $('#table').dataTable({
	   data: <?php echo $funciones ?>,
       

    "lengthMenu": [ [15, 30, 45, -1], [15, 30, 45, "Todo"] ],
    "pageLength": 15,

"language":{                     
					  "search": "Buscar" ,   
					  "lengthMenu": "Mostrar _MENU_",
					  "zeroRecords": "No se encontró nada",
					  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					  "infoEmpty": "No hay registros disponibles",
					  "infoFiltered": "(Filtrado de _MAX_ registros totales)",
					  "previous": "Anterior",
					  "oPaginate": { "sNext":"Siguiente", "sLast": "Último", "sPrevious": "Anterior", "sFirst":"Primero" },
					  "oAria": 
							 {
								 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
								 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
							 },                  
},      

columns: [


{
  title: "Nº",
  width: "5%",
 "render": function (data, type, full, meta) 
 {
	 var valueincrement = meta.row+1;
	 return valueincrement;
 }
},

{ 
    title: "Funcion",
    className: 'text-center',
    data: "nombre_accion",
    width: "20%"
},
{ 
    title: "Icono",
    data: null,
    className: 'text-center',
    render: function (data, type, full, meta) 
    {
       return '<i class="' + data.icon + ' la-2x"></i>';
    },
    width: "10%"
},
{ 
    title: "Ruta Amigable",
    className: 'text-center',
    data: 'ruta_amigable',
    width: "20%"
},
{ 
    title: "Estado",
    className: 'text-center',
    data: null,
    render: function (data, type, full, meta) 
    {
       var estado = '';
       
       if(data.descripcion === 'HABILITADO')
       {
            estado = '<span class="label success">HABILITADO</span>';
       }

       else
       {
            estado = '<span class="label alert">INHABILITADO</span>';
       }
       
       return estado;
    },
    width: "15%"
},

{ 
    title: "Opciones",
    className: 'text-center',
    data: null,
    render: function (data, type, full, meta) 
    {
       
       var button = '';
       var url = "<?=site_url('cambiar-estado-funcion-usuario')?>";

       button += '<form action="'+url+'" method="post" id="menu'+data.id_menu+'">';
        button += '<input name="id_menu" type="hidden" value="'+data.id_menu+'"/>';
        button += '<input name="id_estado" type="hidden" value="'+data.id_estado+'"/>';
        button += '<input name="id_usuario" type="hidden" value="'+data.id_usuario+'"/>';

        button += '<button title="Cambiar de Estado" class="palette-Celeste bg button" type="submit" form="menu'+data.id_menu+'" value="'+data.id_menu+'">';
            button +='<i class="las la-exchange-alt la-2x"></i>';
        button += '</button>';
       button += '</form>';

       return button;
    },
    width: "10%" 
}
]});



});
</script>