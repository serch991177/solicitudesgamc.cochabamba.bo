<?php $this->load->view('general/layout/menu') ?>

<div class="row">
   <div class="large-11 large-centered columns">
      <?php $this->load->view('general/layout/message') ?>
      <div class="box no-shadow">
         <div class="box-header panel palette-Red bg">
            <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
               <span><?= lang('listado.grupos') ?></span>
            </h3>
         </div>

         <div class="box-body">
            <div class="row">
               <div class="columns large-2 medium-2 small-2 large-offset-10">
                  <button class="large button expanded palette-Celeste bg" data-open="modalAñadir">
                     <i class="las la-folder-plus la-2x"></i><span> Añadir Grupo</span>
                  </button>
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

<div class="reveal" id="modalAñadir" data-reveal data-options="closeOnClick:false; closeOnEsc:false;">
   <h3 class="lead">Añadir Nuevo Grupo</h3>
   <?= form_open('registro-grupo', 'data-abide no-validate'); ?>
   <div class="row column">
      <?= form_label(lang('cod.grupo'), 'codigo'); ?>
      <div class="input-group">
         <span class="input-group-label"><i class="las la-barcode"></i></span>
         <?= form_input('codigo', set_value('codigo'), ['class' => 'input-group-field', 'required' => 'required','maxlength'=>'3','pattern'=>'[a-zA-Z]{1,3}','id' => 'codigo']); ?>
      </div>
      <span class="form-error" data-form-error-for="codigo">
         <?= lang('campo.requerido') ?>
      </span>

      <?= form_label(lang('nombre.grupo'), 'grupo'); ?>
      <div class="input-group">
         <span class="input-group-label"><i class="las la-layer-group"></i></span>
         <?= form_input('grupo', set_value('grupo'), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'grupo']); ?>
      </div>
      <span class="form-error" data-form-error-for="grupo">
         <?= lang('campo.requerido') ?>
      </span>

      <?= form_label(lang('descripcion.grupo'), 'descripcion'); ?>
      <?= form_textarea(array('cols' => 25, 'rows' => 4, 'name' => 'descripcion', 'id' => 'descripcion', 'required' => 'required')); ?>
      <span class="form-error" data-form-error-for="descripcion">
         <?= lang('campo.requerido') ?>
      </span>

      <div class="row align-right">
         <div class="column small-6">
            <button type="button" data-close class="button expanded bg palette-Red">Cancelar</button>
         </div>
         <div class="column small-6">
            <?= form_submit('send', lang('añadir.grupo'), ['class' => 'button expanded bg palette-Celeste']) ?>
         </div>
      </div>
   </div>
   <?= form_close() ?>
</div>


<?php $this->load->view('normal/grupo/js/index') ?>
<?php $this->load->view('general/layout/footer') ?>