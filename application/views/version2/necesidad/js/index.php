<script>
    var user = <?php echo $user ?>

    $('.datepicker').pickadate({

        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        labelMonthNext: 'Siguiente Mes',
        labelMonthPrev: 'Anterior Mes',
        labelMonthSelect: 'Seleccionar un Mes',
        labelYearSelect: 'Seleccionar un Año',
        selectYears: true,
        selectMonths: true,
        today: 'Hoy',
        clear: 'Limpiar',
        close: 'Cerrar',
        selectYears: 120,
        formatSubmit: 'yyyy-mm-dd',
        min: new Date()
    });
    $(document).ready(function() {

        $('#unidad_medida').select2();
        $("#unidad_medida").select2({
            width: '100%'
        });

        var today = new Date();
        //today.setDate(today.getDate() + 2)
        var to_$input = $('#fecha_limite').pickadate(),
            to_picker = to_$input.pickadate('picker')
        to_picker.set('min', today)

        var table = $('#table').dataTable({
            data: <?php echo $item ?>,
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
                    data: "codigo",
                    width: "8%"
                },

                {
                    title: "Ítem",
                    data: 'nombre_item',
                    width: "20%",
                },
                {
                    title: "Unidad de Medida",
                    data: "unidad_medida",
                    width: "10%"
                },

                {
                    title: "Cantidad Requerida",
                    data: "cantidad",
                    width: "10%"
                },

                {
                    title: "Fecha Final de Presentación de Propuesta",
                    data: "limite",
                    width: "15%"
                },

                {
                    title: "Ver Propuestas",
                    className: 'text-center',
                    width: "15%",
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
                        var url = '<?= site_url() ?>' + 'detalle-item';
                        var urld = '<?= site_url() ?>' + 'imprimir-propuestas';

                        button += '<form  style="display : inline;" action="' + url + '" method="post" id="form' + data.id_item + '">';
                        button += '<input type="hidden" name="item" value="' + data.id_item + '">';
                        button += '<button type="submit" data-tooltip="Ver Propuestas" class="palette-Celeste bg button" form="form' + data.id_item + '">';
                        button += '<i class="las la-users la-2x"></i></button>';
                        button += '</form>';

                        button += '<form  style="display : inline;" action="' + urld + '" method="post" id="formprint' + data.id_item + '" target="_blank">';
                        button += '<input type="hidden" name="item" value="' + data.id_item + '">';
                        button += '<button type="submit" data-tooltip="Imprimir Propuestas" class="palette-Celeste bg button" form="formprint' + data.id_item + '">';
                        button += '<i class="las la-print la-2x"></i></button>';
                        button += '</form>';

                        var y = user.toString();
                        if (data.propuestas == 0 && y == data.user) {
                            var urle = '<?= site_url() ?>' + 'mod-item'

                            button += '<form  style="display : inline;" action="' + urle + '" method="post" id="formedit' + data.id_item + '">';
                            button += '<input type="hidden" name="item" value="' + data.id_item + '">';
                            button += '<button type="submit" data-tooltip="Editar Ítem" class="palette-Celeste bg button" form="formedit' + data.id_item + '">';
                            button += '<i class="las la-pen la-2x"></i></button>';
                            button += '</form>';
                        }

                        return button;


                    }
                }
            ]
        });


    });
    $("#file_requerimiento").change(function() {
        if (document.getElementById('file_requerimiento').val != '') {
            document.getElementById('aviso_file').style.display = 'inline';
        }
    });

    function pasarDatos(descripcion, titulo) {

        document.getElementById("titulo").innerHTML = titulo;
        document.getElementById("editor").style.color = '#000000';
        editor1.setData(descripcion);
        editor1.isReadOnly = true;
    }

    function notificarNovedades() {
        var result = confirm("Quiere Notificar a Todos los Proveedores El Registro de Nuevo Items a La Espera De Propuestas?");
        if (result == true) {
            location.href = 'notificar-proveedores'
        }
    }
</script>