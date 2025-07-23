<?php $this->load->view('general/layout/menu') ?>

<div class="row">
    <div class="large-11 large-centered columns">
        <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">
            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
                    <span><?= lang('reporte.general') ?></span>
                </h3>
            </div>



            <div class="box-body">
                <div class="row">
                    <div class="large-12">
                        <?= form_open('imprimir-general', array('method' => 'post', 'target' => '_blank')) ?>
                        <div class="row">
                            <div class="large-4 medium-4 small-4 columns">
                                <?= form_label(lang('grupo'), 'grupo'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-layer-group"></i></span>
                                    <?= form_dropdown('grupo', $grupos, set_value('grupo'), ['id' => "grupo"]); ?>
                                </div>
                            </div>
                            <div class="large-3 medium-3 small-3 columns">
                                <?= form_label(lang('fecha.inicial'), 'fecha_publicacion'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-calendar"></i></span>
                                    <?= form_input('fecha_publicacion', null, ['class' => 'input-group-field datepicker', 'id' => 'fecha_publicacion']); ?>
                                </div>
                            </div>
                            <div class="large-3 medium-3 small-3 columns">
                                <?= form_label(lang('fecha.final'), 'fecha_limite'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-calendar"></i></span>
                                    <?= form_input('fecha_limite', null, ['class' => 'input-group-field datepicker', 'id' => 'fecha_limite']); ?>
                                </div>
                            </div>
                            <div class="large-2 medium-2 small-2 columns">
                                <?= form_label(lang('estado'), 'estado'); ?>
                                <div class="input-group">
                                    <span class="input-group-label"><i class="las la-question-circle"></i></span>
                                    <?= form_dropdown(['name' => 'estado'], array('' => 'TODO', 'ACTIVOS' => 'ACTIVOS', 'VENCIDOS' => 'VENCIDOS'), '', array('id' => 'estado')); ?>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="large-2 large-offset-10 columns">
                                <button type="button" onclick="filtrarInfo();" title="VER" class="palette-Celeste bg button">
                                    <i class="las la-eye la-3x"></i>
                                </button>
                                <button type="submit" title="IMPRIMIR" class="palette-Celeste bg button">
                                    <i class="las la-print la-3x"></i>
                                </button>
                            </div>
                        </div>
                        <?= form_close() ?>

                        <table id="table" class="hover">

                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>



<?php $this->load->view('normal/reporte/js/general') ?>
<?php $this->load->view('general/layout/footer') ?>