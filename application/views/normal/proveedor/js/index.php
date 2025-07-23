<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [],            
        })
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.log(error);
        });
    ClassicEditor
        .create(document.querySelector('#editor1'), {
            toolbar: [],
        })
        .then(newEditor => {
            editor1 = newEditor;
        })
        .catch(error => {
            console.log(error);
        });

    $(document).ready(function() {

        document.getElementById("editor").style.color = '#000000';

        editor.setData('<?php echo html_entity_decode($item->descripcion); ?>');

        editor.isReadOnly = true;

        var limite = '<?php echo $item->fecha_limite ?>';

        if(new Date(limite + ' 00:00:00') < new Date(hoy()))
        {
            var precio = false;
        }
        else{
            var precio = true;
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
                    width: "25%",
                    data: null,
                    render: function ( data, type, full, meta ) {

                        /*if(precio)
                            return 'OCULTO';
                        else*/
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
                    title: "Ver Detalles",
                    className: 'text-center',
                    width: "25%",
                    data: null,
                    render: function(data, type, full, meta) {

                        var button = '';
			var urlp = "<?=site_url('propuesta-proveedor') ?>";

                        button += '<button class="palette-Celeste bg button" onclick="pasarDatos(\'' + data.descripcion_propuesta + '\',\'' + data.file_cotizacion + '\')" data-open="modalDetalles"><i class="las la-eye la-3x"></i></button>'
                        button += '<form  action="' + urlp + '" method="post" target="_blank" id="formprint' + data.id_proveedor + '">';
                        button += '<input type="hidden" name="item" value="' + data.id_item + '">';
                        button += '<input type="hidden" name="proveedor" value="' + data.id_proveedor + '">';
                        button += '<button type="submit" class="palette-Celeste bg button" form="formprint' + data.id_proveedor + '">';
                        button += '<i class="las la-print la-3x"></i></button>';
                        button += '</form>';


                        return button;
                    }
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

    function pasarDatos(descripcion, file) {

        if (file == "null" || file == '') {

            var div = document.getElementById('linkdescarga');

            var hijo = document.getElementById('hijo');

            if(hijo != null)
            {
                div.removeChild(hijo);
            }  
            var p = document.createElement('h4');
            p.setAttribute('id', "hijo");
            p.innerHTML = "NO ADJUNTO NADA";

            div.appendChild(p);
        } else {
            var url = "<?= base_url('uploads/'); ?>" + file;

            var div = document.getElementById('linkdescarga');

            var hijo = document.getElementById('hijo');

            if(hijo != null)
            {
                div.removeChild(hijo);
            }           

            var a = document.createElement('a');
            a.setAttribute('href', url);
            a.setAttribute('id', "hijo");
            a.innerHTML = "Descargar Adjunto";
            a.setAttribute('target', "_blank");
            a.className = "large button expanded palette-Celeste bg";

            div.appendChild(a);
        }

        document.getElementById("editor1").style.color = '#000000';
        editor1.setData(descripcion);
        editor1.isReadOnly = true;

    }
</script>