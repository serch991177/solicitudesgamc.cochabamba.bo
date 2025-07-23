<script>
    $(document).ready(function() {

        var informe = '<?php echo $item->adj_file1 ?>';
        var resolucion = '<?php echo $item->adj_file2 ?>';
        var contrato = '<?php echo $item->adj_file3 ?>';

        if (informe == null || informe == '') {
            document.getElementById('adjInforme').style.display = 'inline';
            document.getElementById('btnsubir').style.display = 'inline';
        } else {
            document.getElementById('calificacion').setAttribute('href', "<?= base_url('uploads/adjudicaciones/informe/' . $item->adj_file1) ?>");
            document.getElementById('calificacion').style.display = 'inline';
        }
        if (resolucion == null || resolucion == '') {
            document.getElementById('adjResolucion').style.display = 'inline';
            document.getElementById('btnsubir').style.display = 'inline';
        } else {
            document.getElementById('resolucion').setAttribute('href', "<?= base_url('uploads/adjudicaciones/resolucion/' . $item->adj_file2) ?>");
            document.getElementById('resolucion').style.display = 'inline';
        }
        if (contrato == null || contrato == '') {
            document.getElementById('adjContrato').style.display = 'inline';
            document.getElementById('btnsubir').style.display = 'inline';
        } else {
            document.getElementById('contrato').setAttribute('href', "<?= base_url('uploads/adjudicaciones/contrato/' . $item->adj_file3) ?>");
            document.getElementById('contrato').style.display = 'inline';
        }

        var allEditors = document.querySelectorAll('#informacion');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i], {
                    toolbar: [],
                })
                .then(newEditor => {
                    editor = newEditor;
                    editor.isReadOnly = true;
                    editor.setData('<?php echo html_entity_decode($item->informacion); ?>');
                })
                .catch(error => {
                    console.log(error);
                });
        }

        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i], {
                    toolbar: [],
                })
                .then(newEditor => {
                    editor = newEditor;
                    editor.isReadOnly = true;
                })
                .catch(error => {
                    console.log(error);
                });
        }
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
            formatSubmit: 'yyyy-mm-dd'
        });

        var limite = '<?php echo $item->fecha_limite ?>';

        var adjudicacion = '<?php echo $item->propuesta_adjudicada ?>';

        var rol = '<?php echo $this->session->funcionario->id_rol ?>';

        if (rol == '3') {
            if (new Date(limite + ' 00:00:00') < new Date(hoy())) {
                var precio = false;
            } else {
                var precio = true;
            }
        }
        else
        { 
            var precio =false;
        }
        var table = $('#table').dataTable({
            data: <?php echo $propuestas ?>,
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
                    width: "20%"
                },

                {
                    title: "Precio Propuesto",
                    className: 'text-center',
                    width: "15%",
                    data: null,
                    render: function(data, type, full, meta) {

                        if(precio)
                            return 'OCULTO';
                        else
                            return new Intl.NumberFormat("de-DE").format(data.precio_propuesto);
                    }
                },
                {
                    title: "Fecha de Registro de Propuesta",
                    className: 'text-center',
                    data: 'fecha_format',
                    width: "25%",
                },
                {
                    title: "Adjudicado",
                    className: 'text-center',
                    width: "15%",
                    data: null,
                    render: function(data, type, full, meta) {

                        if (adjudicacion == null || adjudicacion == '' || adjudicacion != data.id_propuesta)
                            return 'NO';
                        else
                            return 'SI';
                    }
                },
                {
                    title: "Ver Detalles",
                    className: 'text-center',
                    width: "25%",
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
                        var urlp = "<?= site_url('imprimir-proveedor') ?>";
                        var urld = "<?= site_url('ver-propuesta') ?>";
                        var urlA = "pasarDatos(" + data.id_item + ",'" + data.id_propuesta + "','" + data.nombre_completo + "');";

                        button += '<form style="display : inline;" action="' + urld + '" method="post" target="_blank" id="formdetalle' + data.id_proveedor + '">';
                        button += '<input type="hidden" name="item" value="' + data.id_item + '">';
                        button += '<input type="hidden" name="propuesta" value="' + data.id_propuesta + '">';
                        button += '<input type="hidden" name="proveedor" value="' + data.id_proveedor + '">';
                        button += '<button type="submit" class="palette-Celeste bg button" data-tooltip="Ver en Detalle" form="formdetalle' + data.id_proveedor + '">';
                        button += '<i class="las la-eye la-3x"></i></button>';
                        button += '</form>';

                        button += '&nbsp<form  style="display : inline;" action="' + urlp + '" method="post" target="_blank" id="formprint' + data.id_proveedor + '">';
                        button += '<input type="hidden" name="item" value="' + data.id_item + '">';
                        button += '<input type="hidden" name="proveedor" value="' + data.id_proveedor + '">';
                        button += '<input type="hidden" name="propuesta" value="' + data.id_propuesta + '">';
                        button += '<button type="submit" class="palette-Celeste bg button" data-tooltip="Imprimir Propuesta" form="formprint' + data.id_proveedor + '">';
                        button += '<i class="las la-print la-3x"></i></button>';
                        button += '</form>';

                        if (adjudicacion == null || adjudicacion == '') {
                            button += '<button class="palette-Red-700 bg button" onclick="' + urlA + '" data-tooltip="Adjudicar Propuesta" data-open="modalAdjudidacion"><i class="las la-hand-pointer la-3x"></i></button>'


                            var resolucion = document.getElementById('resolucion');
                            var contrato = document.getElementById('contrato');



                        } else {
                            if (adjudicacion == data.id_propuesta) {
                                var urldet = "pasarDatos(" + data.id_item + ",'" + data.id_propuesta + "','" + data.nombre_completo + "');";
                                button += '&nbsp<button class="palette-Celeste bg button" onclick="' + urldet + '" data-tooltip="Ver Fecha Adjudicación" data-open="modalDetAdjudidacion"><i class="las la-calendar la-3x"></i></button>'
                            }
                            var informe = document.getElementById('informe');
                        }

                        return button;
                    }
                }
            ]
        });
    });

    $("#file_informe").change(function() {
        if (document.getElementById('file_informe').val != '') {
            document.getElementById('aviso_file1').style.display = 'inline';
        }
    });
    $("#file_resolucion").change(function() {
        if (document.getElementById('file_resolucion').val != '') {
            document.getElementById('aviso_file2').style.display = 'inline';
        }
    });
    $("#file_contrato").change(function() {
        if (document.getElementById('file_contrato').val != '') {
            document.getElementById('aviso_file3').style.display = 'inline';
        }
    });

    function hoy() {
        var f = new Date();
        var hoy = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
        hoy = hoy + ' 00:00:00';
        return hoy;

    }

    function pasarDatos(item, id_propuesta, nombre) {

        document.getElementById('nombre').innerHTML = nombre;

        document.getElementById('id_item').value = item;
        document.getElementById('id_propuesta').value = id_propuesta;
    }
</script>