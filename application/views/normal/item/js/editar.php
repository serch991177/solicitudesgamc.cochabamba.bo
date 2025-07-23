<script>
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
        })
        .catch(error => {
            console.log(error);
        });

    $(document).ready(function() {

        $('#unidad_medida').select2();
        $("#unidad_medida").select2({
            width: '100%'
        });

        document.getElementById("item").value = "<?= $item->nombre_item; ?>";
        editor.setData('<?php echo html_entity_decode($item->descripcion); ?>');        
    });
</script>