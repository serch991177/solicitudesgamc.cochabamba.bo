<script>
    $(document).ready(function() {

        var table = $('#table').dataTable({
            data: <?php echo $proveedores ?>,
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
                    title: "Razón Social/Nombre Empresa/Persona",
                    className: 'text-center',
                    data: "nombre_completo",
                    width: "15%"
                },
                {
                    title: "NIT/DNI",
                    className: 'text-center',
                    data: 'nit',
                    width: "10%",
                },
                {
                    title: "Correo electrónico",
                    className: 'text-center',
                    data: 'correo_electronico',
                    width: "10%",
                },
                {
                    title: "Celular",
                    className: 'text-center',
                    data: 'celular',
                    width: "5%",
                },
                {
                    title: "Dirección",
                    className: 'text-center',
                    data: 'direccion',
                    width: "20%",//70
                },

                {
                    title: "Fecha de Registro",
                    className: 'text-center',
                    data: 'fecha_format',
                    width: "10%",
                },
                {
                    title: "Rubro",
                    className: 'text-center',
                    data: 'rubro',
                    width: "10%",
                },
                {
                    title: "Estado",
                    className: 'text-center',
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
                        if(data.id_estado == 1)
                        {
                            button += '<span class="label success">ACTIVO</span>';
                        }
                        else{
                            button += '<span class="label alert">DESACTIVADO</span>';
                        }

                        return button;
                    },
                    width: "5%"
                },
                {
                    title: "Detalle",
                    className: 'text-center',
                    width: "10%",
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
                        var url = '<?= site_url() ?>' + 'info-personal';

                        button += '<form  style="display : inline;" action="' + url + '" method="post" id="form' + data.id_proveedor + '">';
                        button += '<input type="hidden" name="proveedor" value="' + data.id_proveedor + '">';
                        button += '<button type="submit" data-tooltip="Ver Información Personal" class="palette-Celeste bg button" form="form' + data.id_proveedor + '">';
                        button += '<i class="las la-eye la-2x"></i></button>';
                        button += '</form>';

                        return button;

                    }

                }

            ]
        });
    });
</script>