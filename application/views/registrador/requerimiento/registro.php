<?php $this->load->view('general/layout/menu') ?>
<?php
function fecha_final(){
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
            <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
               <span><?= lang('lista.requerimientos') ?></span>
            </h3>
         </div>

         <div class="box-body">
            <div class="row">
               <div class="columns large-3 medium-3 small-3 large-offset-4">
                  <?= form_open(current_url()); ?>
                  <?= form_label(lang('filtrar.grupo'), 'precio'); ?>
                  <?= form_dropdown('grupo', $grupos, set_value('grupo'), ['onchange' => "this.form.submit()"]); ?>
                  <?= form_close(); ?>
               </div>
               <div class="columns large-2 medium-2 small-2 large">
                  <button class="large button expanded palette-Celeste bg" data-open="modalRegistrar" disabled>
                     <i class="las la-folder-plus la-2x"></i><span> Añadir Ítem</span>
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
<div class="large reveal" id="modalRegistrar" data-reveal data-options="closeOnClick:false; closeOnEsc:false;">
   <h3 class="lead">Añadir Nuevo Ítem</h3>
   <?= form_open_multipart('agregar-requerimiento', 'data-abide no-validate'); ?>
   <div class="large-12">
      <div class="row">
         <div class="large-6 columns">
            <?= form_label(lang('grupo'), 'grupo'); ?>
            <div class="input-group">
               <span class="input-group-label"><i class="las la-layer-group"></i></span>
               <?= form_dropdown('grupo', $grupo, set_value('grupo'), ['id' => "grupo", 'required' => 'required']); ?>
            </div>
            <span class="form-error" data-form-error-for="grupo">
               <?= lang('campo.requerido') ?>
            </span>
         </div>
         <div class="large-6 columns">
            <?= form_label(lang('procedencia'), 'procedencia'); ?>
            <div class="input-group">
               <span class="input-group-label"><i class="las la-globe-americas"></i></span>
               <?= form_input('procedencia', set_value('procedencia'), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'procedencia']); ?>
            </div>
            <span class="form-error" data-form-error-for="procedencia">
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
         <div class="large-4 columns">
            <?= form_label(lang('cantidad'), 'cantidad'); ?>
            <div class="input-group">
               <span class="input-group-label"><i class="las la-pen"></i></span>
               <?= form_input('cantidad', set_value('cantidad'), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'cantidad']); ?>
            </div>
            <span class="form-error" data-form-error-for="cantidad">
               <?= lang('campo.requerido') ?>
            </span>
         </div>
         <div class="large-4 columns">
            <?= form_label(lang('unidad.medida'), 'unidad_medida'); ?>
            <?= form_dropdown('unidad_medida', $unidades, set_value('unidad_medida'), ['id' => "unidad_medida", 'required' => 'required']); ?>
            <span class="form-error" data-form-error-for="item">
               <?= lang('campo.requerido') ?>
            </span>
         </div>
         <div class="large-4 columns">
            <?= form_label(lang('entrega'), 'entrega'); ?>
            <div class="input-group">
               <span class="input-group-label"><i class="las la-hourglass-start"></i></span>
               <?= form_input('entrega', set_value('entrega'), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'entrega']); ?>
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
               <?= form_input('forma_entrega', set_value('forma_entrega'), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'forma_entrega']); ?>
            </div>
            <span class="form-error" data-form-error-for="forma_entrega">
               <?= lang('campo.requerido') ?>
            </span>
         </div>
         <div class="large-4 columns">
            <?= form_label(lang('validez.propuesta'), 'validez'); ?>
            <div class="input-group">
               <span class="input-group-label"><i class="las la-business-time"></i></span>
               <?= form_input('validez', set_value('validez'), ['class' => 'input-group-field', 'required' => 'required', 'id' => 'validez']); ?>
            </div>
            <span class="form-error" data-form-error-for="validez">
               <?= lang('campo.requerido') ?>
            </span>
         </div>
         <div class="large-4 columns">
            <?= form_label(lang('fecha.limite'), 'fecha_limite'); ?>
            <div class="input-group">
               <span class="input-group-label"><i class="las la-calendar"></i></span>
               <?= form_input('fecha_limite', fecha_final(), ['class' => 'input-group-field datepicker', 'id' => 'fecha_limite', 'required' => 'required']); ?>
            </div>
            <span class="form-error" data-form-error-for="fecha_limite">
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
         <button class="btn button expanded">Adjuntar Documento</button>
         <span id="aviso_file" style="display: none;" class="centered">
            <p><b>(Documento Cargado)</b></p>
         </span>
         <input type="file" name="file_requerimiento" title="Adjuntar Documento de Requerimientos o Especificaciones" id="file_requerimiento" />
      </div>


      <div class="row align-right">
         <div class="column small-6">
            <button type="button" data-close class="button expanded bg palette-Red">Cancelar</button>
         </div>
         <div class="column small-6">
            <?= form_submit('send', lang('añadir.item'), ['class' => 'button expanded bg palette-Celeste']) ?>
         </div>
      </div>
   </div>
   <?= form_close() ?>
</div>

<div class="large reveal" id="modalDescripcion" data-reveal>
   <h3 class="lead">Descripción de Características: <span id="titulo"></span></h3>
   <div class="row column">
      <?= form_textarea(array('name' => 'descripcion', 'rows' => '10', 'cols' => '10', 'id' => 'editor1')); ?>
   </div>
   <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<?php $this->load->view('registrador/requerimiento/js/registro') ?>
<?php $this->load->view('general/layout/footer') ?>