<?php $this->load->view('general/layout/menu') ?>
<?php
function fecha_final()
{
    $date = date('Y-m-d');
    $fecha = date('Y-m-d', strtotime($date . "+ 2 days"));
    return $fecha;
}
?>

<div class="row">
    <div class="large-11 large-centered columns">
        <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">
            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="las la-folder-plus la-2x"></i>
                    <span><?= lang('registrar.requerimiento') ?></span>
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="large-12 columns medium-12 small-12">
                        <?= form_open_multipart('new-registro', ['data-abide' => '', 'no-validate' => '', 'id' => 'registro']); ?>
                        <div class="large-12">
                            <fieldset>
                                <legend>
                                    <h3>DATOS ÍTEM</h3>
                                </legend>
                                <div class="row">
                                    <div class="large-6 columns">
                                        <?= form_label(lang('grupo'), 'grupo'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-layer-group"></i></span>
                                            <?= form_dropdown('grupo', $grupo, set_value('grupo'), ['class' => 'ignore', 'id' => "grupo", 'required' => 'required']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="grupo">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                    <div class="large-6 columns">
                                        <?= form_label(lang('procedencia'), 'procedencia'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-globe-americas"></i></span>
                                            <?= form_input('procedencia', set_value('procedencia'), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'procedencia','onkeyup'=> 'javascript:this.value=this.value.toUpperCase();']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="procedencia">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-12 columns">
                                        <?= form_label(lang('item'), 'item'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-question"></i></span>
                                            <?= form_input('item', set_value('item'), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'item', 'maxlength' => '249','onkeyup'=> 'javascript:this.value=this.value.toUpperCase();']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="cantidad">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-4 columns">
                                        <?= form_label(lang('cantidad'), 'cantidad'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-pen"></i></span>
                                            <?= form_input('cantidad', set_value('cantidad'), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'cantidad']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="cantidad">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                    <div class="large-4 columns">
                                        <?= form_label(lang('unidad.medida'), 'unidad_medida'); ?>
                                        <?= form_dropdown('unidad_medida', $unidades, set_value('unidad_medida'), ['class' => 'ignore', 'id' => "unidad_medida", 'required' => 'required']); ?>
                                        <span class="form-error" data-form-error-for="item">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                    <div class="large-4 columns">
                                        <?= form_label(lang('entrega'), 'entrega'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-hourglass-start"></i></span>
                                            <?= form_input('entrega', set_value('entrega'), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'entrega']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="entrega">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-4 columns">
                                        <?= form_label(lang('forma.entrega'), 'forma_entrega'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-truck"></i></span>
                                            <?= form_input('forma_entrega', set_value('forma_entrega'), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'forma_entrega','onkeyup'=> 'javascript:this.value=this.value.toUpperCase();']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="forma_entrega">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                    <div class="large-4 columns">
                                        <?= form_label(lang('validez.propuesta'), 'validez'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-business-time"></i></span>
                                            <?= form_input('validez', set_value('validez'), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'validez']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="validez">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                    <div class="large-4 columns">
                                        <?= form_label(lang('fecha.limite'), 'fecha_limite'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-calendar"></i></span>
                                            <?= form_input('fecha_limite', fecha_final(), ['class' => 'input-group-field datepicker ignore', 'id' => 'fecha_limite', 'required' => 'required']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="fecha_limite">
                                            <?= lang('campo.requerido') ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        <?= form_label(lang('informacion.adicional'), 'informacion'); ?>
                                        <?= form_textarea(array('name' => 'informacion', 'rows' => '10', 'cols' => '10', 'id' => 'info', 'placeholder' => 'Agrege Información Adicional si es Necesario')); ?>
                                    </div>
                                </div>
                                <div class="upload-btn-wrapper">
                                    <?= form_label(lang('subir.detrequerimiento'), 'file_requerimiento'); ?>
                                    <button class="btn button expanded">Adjuntar Documento</button>
                                    <span id="aviso_file" style="display: none; font-size: 18px;" class="centered"></span>
                                    <input type="file" name="file_requerimiento" title="Adjuntar Documento de Requerimientos o Especificaciones" id="file_requerimiento" />
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>
                                    <h3>Características Tecnicas</h3>
                                </legend>
                                <div class="form-group">
                                    <div name="add_name" id="add_name">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <thead>
                                                    <tr class="bg palette-Celeste">
                                                        <th class="palette-White text" width="40%">Característica Requerida</th>
                                                        <th class="palette-White text" width="50%">Detalle Característica</th>
                                                        <th class="palette-White text" width="10%">Añadir Nuevo</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td><input type="text" name="caracteristica[]" placeholder="Ingrese Característica Tecnica" pattern="(.|\s)*\S(.|\s)*" class="form-control name_list" required /></td>
                                                    <td><textarea name="detalle[]" rows="5" placeholder="Ingrese Detalle" id="editor" class="editable" required></textarea></td>
                                                    <td><button type="button" name="add" id="add" class="btn bg palette-Celeste"><i class="las la-plus-circle la-2x"></i></button></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="row">
                                <div class="large-4 columns large-centered">
                                    <?= form_submit('send', lang('añadir.item'), ['class' => 'button expanded bg palette-Celeste', 'onclick' => 'miFuncion()']) ?>
                                </div>
                            </div>

                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('version2/necesidad/js/registro') ?>
<?php $this->load->view('general/layout/footer') ?>