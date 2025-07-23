<?php $this->load->view('general/layout/menu') ?>

<div class="row">
   <div class="large-11 large-centered columns">
      <?php $this->load->view('general/layout/message') ?>
      <div class="box no-shadow">
         <div class="box-header panel palette-Red bg">
            <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
               <span><?= lang('mis.propuestas') ?></span>
            </h3>
         </div>

         <div class="box-body">
            <div class="row">
               <div class="large-12 columns medium-12 small-12">
                  <fieldset class="fieldset">
                     <legend>
                        <h4><?= lang('datos.item.solicitado') ?></h4>
                     </legend>

                     <div class="row display">
                        <div class="large-2 medium-2 columns palette-Celeste bg">
                           <b><span class="palette-White text"><?= lang('codigo'); ?></span></b>
                        </div>
                        <div class="large-4 medium-4 columns end palette-Grey-300 bg">
                           <span class="palette-Black text"><?= $item->codigo; ?></span>
                        </div>
                        <div class="large-3 medium-3 columns palette-Celeste bg">
                           <b><span class="palette-White text"><?= lang('validez.propuesta'); ?></span></b>
                        </div>
                        <div class="large-3 medium-3 columns palette-Grey-300 bg">
                           <span class="palette-Black text"><?= $item->validez; ?></span>
                        </div>
                     </div>

                     <div class="row">
                        <div class="large-12 small-6 medium-12 columns">
                           <?= form_label(lang('item'), 'item'); ?>
                           <?php $options = array('name' => '', 'rows' => '3', 'value' => $item->nombre_item, 'readonly' => 'readonly'); ?>
                           <?= form_textarea($options); ?>
                        </div>
                     </div>

                     <div class="row">
                        <div class="large-12 medium-12 small-12 columns">
                           <?= form_label(lang('descripcion.item'), 'descripcion'); ?>
                           <?= form_textarea(array('name' => 'descripcion', 'rows' => '10', 'cols' => '10', 'id' => 'editor')); ?>
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
                        <div class="large-4 medium-4 columns palette-Celeste bg">
                           <b><span class="palette-White text"><?= lang('entrega'); ?></span></b>
                        </div>
                        <div class="large-3 medium-3 columns palette-Grey-300 bg">
                           <span class="palette-Black text"><?= $item->tiempo_entrega; ?></span>
                        </div>
                        <div class="large-2 medium-2 columns palette-Celeste bg">
                           <b><span class="palette-White text"><?= lang('forma.entrega'); ?></span></b>
                        </div>
                        <div class="large-3 medium-3 columns palette-Grey-300 bg">
                           <span class="palette-Black text"><?= $item->forma_entrega; ?></span>
                        </div>
                     </div>
                  </fieldset>
               </div>
            </div>

            <div class="row">
               <div class="large-12 columns medium-12 small-12">
                  <table id="table" class="hover display dataTable" style="width:100%">

                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="large reveal" id="modalDetalles" data-reveal>
   <h3 class="lead">Detalles Propuesta</h3>
   <div class="row column">
      <?= form_label(lang('descripcion.item'), 'descripcion'); ?>
      <?= form_textarea(array('name' => 'descripcion', 'rows' => '10', 'cols' => '10', 'id' => 'editor1')); ?>
      <div id="linkdescarga">

      </div>
   </div>
   <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
   </button>
</div>


<?php $this->load->view('normal/proveedor/js/index') ?>
<?php $this->load->view('general/layout/footer') ?>