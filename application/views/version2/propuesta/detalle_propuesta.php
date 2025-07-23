<?php $this->load->view('general/layout/menu') ?>

<div class="row">
    <div class="large-11 large-centered columns">
        <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">
            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
                    <span><?= lang('revision.propuesta') ?></span>
                </h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="large-12 columns medium-12 small-12">
                        <fieldset class="fieldset">
                            <legend>
                                <h4><?= lang('datos.propuesta') ?></h4>
                            </legend>

                            <div class="row display">
                                <div class="large-1 medium-1 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('codigo'); ?></span></b>
                                </div>
                                <div class="large-4 medium-4 columns end palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $item->codigo; ?></span>
                                </div>
                                <div class="large-3 medium-3 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('fecha.registro'); ?></span></b>
                                </div>
                                <div class="large-4 medium-4 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $propuesta->fecha_format; ?></span>
                                </div>
                            </div>

                            <div class="row display">
                                <div class="large-1 medium-1 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('item'); ?></span></b>
                                </div>
                                <div class="large-11 medium-11 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><b><?= $item->nombre_item ?></b></span>
                                </div>
                            </div>

                            <div class="row display">
                                <div class="large-2 medium-2 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('cantidad'); ?></span></b>
                                </div>
                                <div class="large-1 medium-1 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $item->cantidad; ?></span>
                                </div>
                                <div class="large-2 medium-2 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('unidad.medida'); ?></span></b>
                                </div>
                                <div class="large-2 medium-2 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $item->unidad_medida; ?></span>
                                </div>
                                <div class="large-1 medium-1 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('procedencia'); ?></span></b>
                                </div>
                                <div class="large-4 medium-4 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $item->procedencia; ?></span>
                                </div>
                            </div>

                            <div class="row display">
                                <div class="large-3 medium-3 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('nombre.proveedor'); ?></span></b>
                                </div>
                                <div class="large-5 medium-5 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $propuesta->nombre_completo; ?></span>
                                </div>
                                <div class="large-2 medium-2 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('nro.celular'); ?></span></b>
                                </div>
                                <div class="large-2 medium-2 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $propuesta->celular; ?></span>
                                </div>
                            </div>
                            <div id="divprecio" style="display: none;">
                                <div class="row">
                                    <div class="large-3 columns large-centered">
                                        <?= form_label(lang('precio.propuesto'), 'precio'); ?>
                                        <div class="input-group">
                                            <span class="input-group-label"><i class="las la-money-bill"></i></span>
                                            <?= form_input('precio_propuesto', number_format($propuesta->precio_propuesto, 0, ',', '.'), ['class' => 'input-group-field', 'id' => 'precio_propuesto', 'readonly' => 'readonly']); ?>
                                        </div>
                                        <span class="form-error" data-form-error-for="precio">
                                            <?= lang('precio.incorrecto') ?>
                                        </span>
                                    </div>
                                </div>
                                <div id="numerico" style="display:none;">
                                    <h5 class="center" id="literal"></h5>
                                </div>
                            </div>
                            <?php
                            if ($propuesta->file_cotizacion != null) {
                                echo '<div class="row">
                                            <div class="large-4 columns large-centered">
                                                <a href="' . "uploads/" . $propuesta->file_cotizacion . '" target="_blank" class="large button expanded palette-Celeste bg">DESCARGAR ADJUNTO</a>
                                            </div>
                                        </div>';
                            } else {
                                echo '<div class="row">
                                            <div class="large-4 columns large-centered">
                                                <h5 class="center">NO EXISTE ADJUNTO</h5>
                                            </div>
                                        </div>';
                            }
                            ?>
                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <?= form_label(lang('informacion.adicional'), 'informacion'); ?>
                                    <?= form_textarea(array('name' => 'informacion', 'rows' => '10', 'cols' => '10', 'id' => 'informacion')); ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend>
                                <h4><?= lang('caracteristicas.tecnicas') ?></h4>
                            </legend>
                            <div class="row">
                                <table class="unstriped large-centered" style="width:80%">
                                    <thead>
                                        <tr class="bg palette-Celeste">
                                            <th class="palette-White text" width="20%">Característica Requerida</th>
                                            <th class="palette-White text" width="40%">Detalle Característica</th>
                                            <th class="palette-White text" width="40%">Característica Ofrecida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($caracteristicas as $detalle) : ?>
                                            <tr>
                                                <td class="bg palette-Celeste">
                                                    <?= form_hidden('caracteristica[]', $detalle->id_caracteristica); ?>
                                                    <b><span class="palette-Black text"><?= $detalle->descripcion ?></span></b>
                                                </td>
                                                <td>
                                                    <textarea rows="5" class="editor" disabled><?= html_entity_decode($detalle->caracteristica_detalle); ?></textarea>
                                                </td>
                                                <td>
                                                    <textarea rows="5" class="txtdetalle" disabled><?= html_entity_decode($detalle->detalle); ?></textarea>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('version2/propuesta/js/detalle_propuesta') ?>
<?php $this->load->view('general/layout/footer') ?>