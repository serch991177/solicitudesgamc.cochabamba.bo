<script>
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
                        model: 'heading1',
                        view: 'h1',
                        title: 'Titulo',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Subtitulo',
                        class: 'ck-heading_heading2'
                    }
                ]
            }
        })
        .then(newEditor => {
            editor = newEditor;
            editor.setData('<?php echo html_entity_decode($item->informacion); ?>');
        })
        .catch(error => {
            console.log(error);
        });

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

    $.validator.addMethod(
        "regexp",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Por Favor, Evite los Espacios en Blanco al Principio del Texto"
    );

    $('#actualizar').validate({
        ignore: ".ignore"
    });

    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i], {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
            })
            .then(editor => {
                window.editor = editor;

                detectTextChanges(editor);
                //detectFocusOut(editor);
            })
            .catch(error => {
                console.error(error);
            });
        cargar_validacion(i);
    }

    function detectTextChanges(editor) {
        editor.model.document.on('change:data', () => {
            editor.updateSourceElement();
        });
    }

    function cargar_validacion(i) {
        var elementoc = "#actualizar input[name='caracteristica[" + i + "]']";
        var elementod = "#actualizar textarea[name='detalle[" + i + "]']";

        $(elementoc).rules("add", {
            required: true,
            regexp: /(.|\s)*\S(.|\s)*/,
            messages: {
                required: "Elemento de Llenado Obligatorio",
            }
        });

        $(elementod).rules("add", {
            required: true,
            messages: {
                required: "Elemento de Llenado Obligatorio",
                regexp: "Elemento de Llenado Obligatorio"
            }
        });
    }

    $(document).ready(function() {

        $('#unidad_medida').select2();
        $("#unidad_medida").select2({
            width: '100%'
        });

        var i = 0;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="nueva_caracteristica[' + i + ']" placeholder="Ingrese Característica Tecnica" class="form-control name_list" required /></td><td><textarea rows="5" name="new_detalle[' + i + ']" placeholder="Ingrese Detalle" id="edit' + i + '" required></textarea></td><td><button type="button" name="remove" id="' + i + '" class="btn bg palette-Red btn_remove"><i class="las la-minus-circle la-2x"></i></button></td></tr>');
            var editor_id = '#edit' + i;

            var input_id = 'input' + i;

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
                .then(editor1 => {
                    window.editor1 = editor1;

                    detectTextChanges(editor1);
                    //detectFocusOut(editor);
                })
                .catch(error => {
                    console.error(error);
                });
            cargar_newvalidacion(i);
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $("#file_requerimiento").change(function() {
            if (document.getElementById('file_requerimiento').val != '') {
                if (this.files[0].size / 1024 / 1024 < 11) {
                    document.getElementById('aviso_file').style.display = 'inline';
                    document.getElementById('aviso_file').innerHTML = "ARCHIVO CARGADO CON EXITO";
                    document.getElementById('aviso_file').style.color = '#000000'
                } else {
                    document.getElementById('aviso_file').style.display = 'inline';
                    document.getElementById('aviso_file').innerHTML = "EL ARCHIVO QUE INTENTA CARGAR EXCEDE EL TAMAÑO MÁXIMO PERMITIDO, MOTIVO POR EL CUAL NO SE CARGO";
                    document.getElementById('aviso_file').style.color = '#EB0A0A'
                    document.getElementById('file_requerimiento').value = '';
                }
            }
        });

        function detectTextChanges(editor) {
            editor.model.document.on('change:data', () => {
                editor.updateSourceElement();
            });
        }

        function cargar_newvalidacion(id) {
            var boton = "#actualizar input[name='nueva_caracteristica[" + id + "]'";

            var boton1 = "#actualizar textarea[name='new_detalle[" + id + "]'";

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
    });
</script>