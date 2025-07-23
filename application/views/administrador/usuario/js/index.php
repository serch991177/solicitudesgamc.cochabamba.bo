<script>
   $(document).ready(function(){
    
	   var table = $('#table').dataTable({
	   data: <?php echo $usuarios ?>,

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
    title: "Nombre Completo",
    className: 'text-center',
    data: "nombre_completo",
    width: "17%"
},
{ 
    title: "Carnet de Identidad",
    className: 'text-center',
    data: 'dni',
    width: "8%" 
},
{ 
    title: "Unidad Organizacional",
    className: 'text-center',
    data: 'unidad_organizacional',
    width: "17%" 
},
{ 
    title: "Cargo",
    className: 'text-center',
    data: 'cargo',
    width: "10%" 
},
{ 
    title: "Nº de Ítem",
    className: 'text-center',
    data: 'nro_item',
    width: "8%"
},
{ 
    title: "Correo",
    className: 'text-center',
    data: 'correo_municipal',
    width: "15%"
},
{ 
    title: "Rol",
    className: 'text-center',
    data: 'nombre_rol',
    width: "12%", 
},
{ 
    title: "Opciones",
    className: 'text-center',
    data: null,
    render: function (data, type, full, meta) 
    {
       
       var button = '';
       var url = "<?=site_url('funciones-usuario/')?>"+data.id_usuario;

       
        button += '<a href="'+url+'" title="Funciones de Usuario" class="palette-I-900 bg button">';
            button +='<i class="las la-cogs la-2x"></i>';
        button += '</a>';

       return button;
    },
    width: "10%" 
}
]});


});
</script>