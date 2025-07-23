<?php $this->load->view('general/layout/menu') ?>

<div class="row">
    <div class="large-11 large-centered columns">
        <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">
            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
                    <span><?= lang('editar.item') ?></span>
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="large-12 columns medium-12 small-12">
                        <?= form_open_multipart('modificar-requerimiento', 'data-abide no-validate'); ?>
                        <div class="row">
                            <div class="large-4 columns">
                                <?= form_label(lang('grupo'), 'grupo'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-layer-group"></i></span>
                                    <?= form_dropdown('grupo', $grupo, set_value('grupo', $item->id_grupo), ['id' => "grupo", 'required' => 'required']); ?>
                                </div>
                                <span class="form-error" data-form-error-for="grupo">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                            <div class="large-4 columns">
                                <?= form_label(lang('procedencia'), 'procedencia'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-globe-americas"></i></span>
                                    <?= form_input('procedencia', set_value('procedencia', $item->procedencia), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'procedencia']); ?>
                                </div>
                                <span class="form-error" data-form-error-for="procedencia">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                            <div class="large-4 columns">
                                <?= form_label(lang('validez.propuesta'), 'validez'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-business-time"></i></span>
                                    <?= form_input('validez', set_value('validez',$item->validez), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'validez']); ?>
                                </div>
                                <span class="form-error" data-form-error-for="validez">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <?= form_label(lang('item'), 'item'); ?>
                                <?= form_textarea(array('cols' => 25, 'rows' => 5, 'name' => 'item', 'id' => 'item', 'required' => 'required')); ?>
                                <span class="form-error" data-form-error-for="item">
                                    <?= lang('campo.requerido') ?>
                                </span>

                            </div>
                        </div>

                        <div class="row">
                            <div class="large-3 columns">
                                <?= form_label(lang('cantidad'), 'cantidad'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-pen"></i></span>
                                    <?= form_input('cantidad', set_value('cantidad', $item->cantidad), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'cantidad']); ?>
                                </div>
                                <span class="form-error" data-form-error-for="cantidad">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                            <div class="large-3 columns">
                                <?= form_label(lang('unidad.medida'), 'unidad_medida'); ?>
                                <?= form_dropdown('unidad_medida', $unidades, set_value('unidad_medida', $item->unidad_medida), ['id' => "unidad_medida", 'required' => 'required']); ?>
                                <span class="form-error" data-form-error-for="item">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                            <div class="large-3 columns">
                                <?= form_label(lang('forma.entrega'), 'forma_entrega'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-truck"></i></span>
                                    <?= form_input('forma_entrega', set_value('forma_entrega', $item->forma_entrega), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'forma_entrega']); ?>
                                </div>
                                <span class="form-error" data-form-error-for="forma_entrega">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                            <div class="large-3 columns">
                                <?= form_label(lang('entrega'), 'entrega'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-hourglass-start"></i></span>
                                    <?= form_input('entrega', set_value('entrega', $item->tiempo_entrega), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'entrega']); ?>
                                </div>
                                <span class="form-error" data-form-error-for="entrega">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <?= form_label(lang('descripcion.item'), 'descripcion'); ?>
                                <?= form_textarea(array('name' => 'descripcion', 'rows' => '10', 'cols' => '10', 'id' => 'editor')); ?>
                                <span class="form-error" data-form-error-for="descripcion">
                                    <?= lang('campo.requerido') ?>
                                </span>
                            </div>
                        </div>
                        <div class="upload-btn-wrapper">
                            <?= form_label(lang('subir.requerimiento'), 'file_requerimiento'); ?>
                            <button class="btn button expanded">Adjuntar / Cambiar Documento</button>
                            <span id="aviso_file" style="display: none;" class="centered">
                                <p><b>(Documento Cargado)</b></p>
                            </span>
                            <input type="file" name="file_requerimiento" title="Adjuntar Documento de Requerimientos o Especificaciones" id="file_requerimiento" />
                        </div>


                        <div class="row align-right">
                            <div class="column small-6">
                                <a href="requerimientos-gamc" data-close class="button expanded bg palette-Red">Volver</a>
                            </div>
                            <div class="column small-6">
                                <input name="nombre_adjunto" type="hidden" value="<?= $item->file_documento ?>" />
                                <input name="id_item" type="hidden" value="<?= $item->id_item ?>" />
                                <?= form_submit('send', lang('modificar'), ['class' => 'button expanded bg palette-Celeste']) ?>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('registrador/requerimiento/js/editar') ?>
<?php $this->load->view('general/layout/footer') ?>