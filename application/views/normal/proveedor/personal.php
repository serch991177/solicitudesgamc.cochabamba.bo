<?php $this->load->view('general/layout/menu') ?>
<?php
if ($proveedor->representante != '' && $proveedor->representante != null) {
    $representante = $proveedor->representante;
} else {
    $representante = "NO REGISTRADO / NO CORRESPONDE";
}
if ($proveedor->latitud == null && $proveedor->longitud == null) {
    $flag = true;
}
if ($proveedor->file_nit != null) {
    $display_nit = 'none';
    $nit_file = 'inline';
}
else{
    $display_nit = 'inline';
    $nit_file = 'none';
}
if ($proveedor->file_rupe != null) {
    $display_rupe = 'none';
    $rupe_file = 'inline';
}
else{
    $display_rupe = 'inline';
    $rupe_file = 'none';
}
if ($proveedor->file_poder != null) {
    $display_poder = 'none';
    $poder_file = 'inline';
}
else{
    $display_poder = 'inline';
    $poder_file = 'none';
}
?>

<div class="row">
    <div class="large-8 medium-8 small-12 large-centered columns">
        <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">

            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="lab la-wpforms la-2x"></i>
                    <span><?= lang('registro.propuesta') ?></span>
                </h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="large-12 columns medium-12 small-12">
                        <?= form_open_multipart('modificar-personal', 'data-abide no-validate'); ?>
                        <fieldset class="fieldset">
                            <legend>
                                <h4><?= lang('datos.proveedor') ?></h4>
                            </legend>

                            <div class="row display">
                                <div class="large-4 medium-4 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('nombre.proveedor'); ?></span></b>
                                </div>
                                <div class="large-8 medium-8 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $proveedor->nombre_completo; ?></span>
                                </div>
                            </div>

                            <div class="row display">
                                <div class="large-4 medium-4 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('nit'); ?></span></b>
                                </div>
                                <div class="large-3 medium-3 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $proveedor->nit; ?></span>
                                </div>
                                <div class="large-2 medium-2 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('usuario.rupe'); ?></span></b>
                                </div>
                                <div class="large-3 medium-3 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $proveedor->nro_rupe; ?></span>
                                </div>
                            </div>

                            <div class="row display">
                                <div class="large-3 medium-3 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('representante.legal'); ?></span></b>
                                </div>
                                <div class="large-9 medium-9 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $representante; ?></span>
                                </div>                                
                            </div>

                            <div class="row display">
                                <div class="large-3 medium-3 columns palette-Celeste bg">
                                    <b><span class="palette-White text"><?= lang('direccion'); ?></span></b>
                                </div>
                                <div class="large-9 medium-9 columns palette-Grey-300 bg">
                                    <span class="palette-Black text"><?= $proveedor->direccion; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <?= form_hidden('latitude',$proveedor->latitud); ?>
                                <?= form_hidden('longitude',$proveedor->longitud); ?>
                            </div>
                            <?= form_label(lang('seleccion.mapa'), 'mapa', array('id' => 'maplabel')); ?>
                            <span class="form-error" data-form-error-for="mapa" id='mapa-error'>
                                <?= lang('ubicacion.mapa') ?>
                            </span>
                            <div id="mapid" style="height: 350px; z-index: 5;"></div>
                            </br>
                            <div class="row">
                            <div class="large-4 columns large">
                            <a href="<?= base_url('uploads/nit/'.$proveedor->file_nit) ?>" target="_blank" style="display:<?= $nit_file; ?>;" class="button expanded bg palette-Celeste">VER NIT</a>
                            </div>
                            <div class="large-4 columns large">
                                <a href="<?= base_url('uploads/rupe/'.$proveedor->file_rupe) ?>"  target="_blank" style="display:<?= $rupe_file; ?>;"  class="button expanded bg palette-Celeste">VER RUPE</a>
                            </div>
                            <div class="large-4 columns large">
                                <a href="<?= base_url('uploads/poder/'.$proveedor->file_poder) ?>" target="_blank" style="display:<?= $poder_file; ?>;"  class="button expanded bg palette-Celeste">VER PODER</a>
                            </div>
                        </div>
                        </fieldset>

                        <div class="row">
                            <div class="large-4 columns large-centered">
                                <a href="ver-proveedores" class="button expanded bg palette-Celeste">ATRAS</a>
                            </div>
                        </div>
                        <?= form_close(); ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('normal/proveedor/js/personal') ?>
<?php $this->load->view('general/layout/footer') ?>