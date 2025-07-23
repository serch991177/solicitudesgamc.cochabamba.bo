<script>
    $(document).ready(function() {

        var table = $('#table').dataTable({
            data: <?php echo $grupos ?>,
            responsive: true,

            "lengthMenu": [
                [15, 30, 45, -1],
                [15, 30, 45, "Todo"]
            ],
            "pageLength": 15,

            "language": {
                "search": "Buscar",
                "lengthMenu": "Mostrar _MENU_",
                "zeroRecords": "No se encontró nada",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "previous": "Anterior",
                "oPaginate": {
                    "sNext": "Siguiente",
                    "sLast": "Último",
                    "sPrevious": "Anterior",
                    "sFirst": "Primero"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
            },

            columns: [


                {
                    title: "Nº",
                    width: "5%",
                    data: "row",
                },

                {
                    title: "Código",
                    className: 'text-center',
                    data: "cod_grupo",
                    width: "10%"
                },

                {
                    title: "Grupo",
                    className: 'text-center',
                    data: 'nombre_grupo',
                    width: "20%",
                },
                {
                    title: "Fecha de Actualización",
                    className: 'text-center',
                    data: 'fecha_format',
                    width: "20%",//55
                },
                {
                    title: "Descripción",
                    className: 'text-center',
                    data: 'descripcion',
                    width: "30%",
                },  
                {
                    title: "Estado",
                    className: 'text-center',
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
                        
                        button += '<span class="label success">PUBLICADO</span>';

                        return button;
                    },
                    width: "15%"
                }



            ]
        });


    });
</script>