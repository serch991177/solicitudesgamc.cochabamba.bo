<script>
    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        };
    }(jQuery));

    $("#cantidad").inputFilter(function(value) {
        return /^\d*$/.test(value);
    });
    $("#validez").inputFilter(function(value) {
        return /^\d*$/.test(value);
    });
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Parrafo',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading2',
                        view: 'h4',
                        title: 'Subtitulo',
                        class: 'ck-heading_heading2'
                    }
                ]
            }
        })
        .then(newEditor => {
            window.editor[1] = newEditor;
        })
        .catch(error => {
            console.log(error);
        });

        ClassicEditor
        .create(document.querySelector('#info'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Parrafo',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading2',
                        view: 'h4',
                        title: 'Subtitulo',
                        class: 'ck-heading_heading2'
                    }
                ]
            }
        })
        .then(newEditor => {
            informacion = newEditor;
        })
        .catch(error => {
            console.log(error);
        });



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

        $.validator.addMethod(
            "regexp",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Por Favor, Evite los Espacios en Blanco al Principio del Texto"
        );

        $('#registro').validate({
            ignore: ".ignore"
        });

        $("#registro input[name='caracteristica[]']").each(function() {
            $(this).rules("add", {
                required: true,
                regexp: /(.|\s)*\S(.|\s)*/,
                messages: {
                    required: "Elemento de Llenado Obligatorio",
                }
            });
        });

        $("#registro textarea[name='detalle[]']").each(function() {
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Elemento de Llenado Obligatorio",
                    regexp: "Elemento de Llenado Obligatorio"
                }
            });
        });

        $('#unidad_medida').select2();
        $("#unidad_medida").select2({
            width: '100%'
        });

        var today = new Date();
        today.setDate(today.getDate() + 2)
        var to_$input = $('#fecha_limite').pickadate(),
            to_picker = to_$input.pickadate('picker')
        to_picker.set('select', today)


    });
    var i = 1;

    $('#add').click(function() {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '"><td><input id="input' + i + '" type="text" name="caracteristica[' + i + ']" placeholder="Ingrese Característica Tecnica" class="form-control name_list" /></td><td><textarea rows="5" name="detalle[' + i + ']" class="editable" placeholder="Ingrese Detalle" id="edit' + i + '" required></textarea></td><td><button type="button" name="remove" id="' + i + '" class="btn bg palette-Red btn_remove"><i class="las la-minus-circle la-2x"></i></button></td></tr>');
        var editor_id = '#edit' + i;

        var input_id = 'input' + i;

        document.getElementById(input_id).setAttribute('required', '');
        document.getElementById(input_id).setAttribute('pattern', '(.|\s)*\S(.|\s)*');

        ClassicEditor
            .create(document.querySelector(editor_id), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Parrafo',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading2',
                            view: 'h4',
                            title: 'Subtitulo',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .then(newEditor => {
                window.editor[i] = newEditor;
            })
            .catch(error => {
                console.log(error);
            });

        cargar_validacion(i);
    });

    function miFuncion() {

        var allEditors = document.querySelectorAll('.editable');

        var cant = Object.keys(editor).length;

        var k = 0;

        for (var i = 1; i < cant; ++i) {


            if (i != eliminados[k]) {
                editor[i].updateSourceElement();
            } else {
                k++;
            }
        }
    }

    let eliminados = [];

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
        eliminados.push(button_id);
    });

    $("#file_requerimiento").change(function() {
        if (document.getElementById('file_requerimiento').val != '') {            
            if(this.files[0].size/1024/1024 < 11)
            {
                document.getElementById('aviso_file').style.display = 'inline';
                document.getElementById('aviso_file').innerHTML ="ARCHIVO CARGADO CON EXITO";
                document.getElementById('aviso_file').style.color = '#000000'
            }
            else{
                document.getElementById('aviso_file').style.display = 'inline';
                document.getElementById('aviso_file').innerHTML ="EL ARCHIVO QUE INTENTA CARGAR EXCEDE EL TAMAÑO MÁXIMO PERMITIDO, MOTIVO POR EL CUAL NO SE CARGO";
                document.getElementById('aviso_file').style.color = '#EB0A0A'
                document.getElementById('file_requerimiento').value = '';
            }
        }
    });

    function cargar_validacion(id) {
        var boton = "#registro input[name='caracteristica[" + id + "]'";

        var boton1 = "#registro textarea[name='detalle[" + id + "]'";

        $(boton).rules("add", {
            required: true,
            regexp: /(.|\s)*\S(.|\s)*/,
            messages: {
                required: "Elemento de Llenado Obligatorio"
            }
        });
        $(boton1).rules("add", {
            required: true,
            messages: {
                required: "Elemento de Llenado Obligatorio"
            }
        });
    }
</script>