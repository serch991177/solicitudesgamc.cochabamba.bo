<script>
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
    $(document).ready(function() {        

        var table = $('#table').dataTable({
            data: <?php echo $items ?>,
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
                    width: "22%",
                }, 
                {
                    title: "Cantidad Requerida",
                    data: "cantidad",
                    width: "10%"
                },               
                {
                    title: "Unidad de Medida",
                    data: "unidad_medida",
                    width: "15%"//55
                }, 
                {
                    title: "N° de Proponentes",
                    data:  "proponentes",
                    width: "10%"
                },   
                {
                    title: "Fecha Publicación",
                    data:  "publicacion",
                    width: "10%"
                },
                {
                    title: "Fecha Limite",
                    data:  "limite",
                    width: "10%"
                },
                {
                    title: "Estado",
                    className: 'text-center',
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
                        if(new Date(data.fecha_limite + ' 00:00:00') < new Date(hoy()))
                            button += '<span class="label alert">VENCIDO</span>';                        
                            
                        else
                            button += '<span class="label success">ACTIVO</span>';

                        return button;
                    },
                    width: "15%"
                }
            ]
        });
    });
    function hoy(){
        var f = new Date();
        var hoy = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
        hoy = hoy + ' 00:00:00';
        return hoy;

    }
    function filtrarInfo(){
        var grupo = document.getElementById("grupo").value;
        var inicial = document.getElementsByName("fecha_publicacion_submit")[0].value;
        var final = document.getElementsByName("fecha_limite_submit")[0].value;
        var estado = document.getElementById("estado").value;

        if(inicial != null && inicial != '' && (final == null || final == ''))
        {
            final = '2099-12-31';
            document.getElementById("fecha_limite").value = '31 Diciembre, 2099';
        }

        if(final != null && final != '' && (inicial == null || inicial == ''))
        {
            inicial = '1999-12-31';
            document.getElementById("fecha_publicacion").value = '31 Diciembre, 1999';
        }

        url = "<?php echo base_url() ?>filtros";

        var data = new FormData();
        data.append('grupo', grupo)
        data.append('inicial', inicial);
        data.append('final', final)
        data.append('estado', estado);

        $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: (response) => {
                $('#table').DataTable().clear();
                $('#table').DataTable().rows.add(JSON.parse(response));
                $('#table').DataTable().draw();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
</script>