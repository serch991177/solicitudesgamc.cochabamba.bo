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
                        <?= form_open_multipart('actualizar-item', ['data-abide' => '', 'no-validate' => '', 'id' => 'actualizar']); ?>
                        <fieldset>
                            <legend>
                                <h3>DATOS ÍTEM</h3>
                            </legend>
                            <div class="row">
                                <div class="large-4 columns">
                                    <?= form_label(lang('grupo'), 'grupo'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-layer-group"></i></span>
                                        <?= form_dropdown('grupo', $grupo, set_value('grupo', $item->id_grupo), ['class' => 'ignore', 'id' => "grupo", 'required' => 'required']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="grupo">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                                <div class="large-4 columns">
                                    <?= form_label(lang('procedencia'), 'procedencia'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-globe-americas"></i></span>
                                        <?= form_input('procedencia', set_value('procedencia', $item->procedencia), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'procedencia','onkeyup'=> 'javascript:this.value=this.value.toUpperCase();']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="procedencia">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                                <div class="large-4 columns">
                                    <?= form_label(lang('validez.propuesta'), 'validez'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-business-time"></i></span>
                                        <?= form_input('validez', set_value('validez', $item->validez), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'validez']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="validez">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                <?= form_label(lang('item'), 'nombre_item'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-globe-americas"></i></span>
                                        <?= form_input('nombre_item', set_value('nombre_item',$item->nombre_item), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'nombre_item','onkeyup'=> 'javascript:this.value=this.value.toUpperCase();']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="nombre_item">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="large-3 columns">
                                    <?= form_label(lang('cantidad'), 'cantidad'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-pen"></i></span>
                                        <?= form_input('cantidad', set_value('cantidad', $item->cantidad), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'cantidad']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="cantidad">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                                <div class="large-3 columns">
                                    <?= form_label(lang('unidad.medida'), 'unidad_medida'); ?>
                                    <?= form_dropdown('unidad_medida', $unidades, set_value('unidad_medida', $item->unidad_medida), ['class' => 'ignore', 'id' => "unidad_medida", 'required' => 'required']); ?>
                                    <span class="form-error" data-form-error-for="unidad_medida">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                                <div class="large-3 columns">
                                    <?= form_label(lang('forma.entrega'), 'forma_entrega'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-truck"></i></span>
                                        <?= form_input('forma_entrega', set_value('forma_entrega', $item->forma_entrega), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'forma_entrega','onkeyup'=> 'javascript:this.value=this.value.toUpperCase();']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="forma_entrega">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                                <div class="large-3 columns">
                                    <?= form_label(lang('entrega'), 'entrega'); ?>
                                    <div class="input-group">
                                        <span class="input-group-label"><i class="las la-hourglass-start"></i></span>
                                        <?= form_input('entrega', set_value('entrega', $item->tiempo_entrega), ['class' => 'input-group-field ignore', 'required' => 'required', 'id' => 'entrega']); ?>
                                    </div>
                                    <span class="form-error" data-form-error-for="entrega">
                                        <?= lang('campo.requerido') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <?= form_label(lang('informacion.adicional'), 'informacion'); ?>
                                    <?= form_textarea(array('name' => 'informacion', 'id' => 'info', 'rows' => '10', 'cols' => '10', 'id' => 'info', 'placeholder' => 'Agrege Información Adicional si es Necesario')); ?>
                                </div>
                            </div>
                            <div class="upload-btn-wrapper">
                                <?= form_label(lang('subir.detrequerimiento'), 'file_requerimiento'); ?>
                                <button class="btn button expanded">Adjuntar / Cambiar Documento</button>
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
                                                    <th class="palette-White text" width="40%">Caracteristica Requerida</th>
                                                    <th class="palette-White text" width="50%">Detalle Caracteristica</th>
                                                    <th class="palette-White text" width="10%">Añadir Nuevo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = -1;
                                                foreach ($caracteristicas as $detalle) :
                                                    $i = $i + 1;
                                                    $cant = count($caracteristicas); ?>
                                                    <tr>
                                                        <td>
                                                            <?= form_hidden('id_caracteristica[]', $detalle->id_caracteristica); ?>
                                                            <input type="text" name="caracteristica[<?= $i ?>]" placeholder="Ingrese Característica Tecnica" class="form-control name_list" value="<?= $detalle->descripcion ?>" required /></td>
                                                        </td>
                                                        <td>
                                                            <textarea name="detalle[<?= $i ?>]" placeholder="Ingrese Detalle" class="editor" required><?= html_entity_decode($detalle->caracteristica_detalle); ?></textarea>
                                                        </td>
                                                        <?php if($cant == $i+1)
                                                            echo '<td><button type="button" name="add" id="add" class="btn bg palette-Celeste"><i class="las la-plus-circle la-2x"></i></button></td>';
                                                        ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row align-right">
                            <div class="column small-6">
                                <a href="ver-necesidades" data-close class="button expanded bg palette-Red">Volver</a>
                            </div>
                            <div class="column small-6">
                                <input name="gpanterior" type="hidden" value="<?= $item->id_grupo ?>" />
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

<?php $this->load->view('version2/necesidad/js/editar') ?>
<?php $this->load->view('general/layout/footer') ?>