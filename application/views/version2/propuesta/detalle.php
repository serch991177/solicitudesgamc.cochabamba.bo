<?php $this->load->view('general/layout/menu') ?>

<div class="row">
   <div class="large-11 large-centered columns">
      <?php $this->load->view('general/layout/message') ?>
      <div class="box no-shadow">
         <div class="box-header panel palette-Red bg">
            <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
               <span><?= lang('propuestas.recibidas') ?></span>
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
                           <b><span class="palette-White text"><?= lang('entrega'); ?></span></b>
                        </div>
                        <div class="large-4 medium-4 columns palette-Grey-300 bg">
                           <span class="palette-Black text"><?= $item->tiempo_entrega; ?></span>
                        </div>
                        <div class="large-2 medium-2 columns palette-Celeste bg">
                           <b><span class="palette-White text"><?= lang('forma.entrega'); ?></span></b>
                        </div>
                        <div class="large-3 medium-3 columns palette-Grey-300 bg">
                           <span class="palette-Black text"><?= $item->forma_entrega; ?></span>
                        </div>
                     </div>
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
                        <table class="large-centered" style="width:70%">
                           <thead>
                              <tr class="bg palette-Celeste">
                                 <th class="palette-White text" width="30%">Característica Requerida</th>
                                 <th class="palette-White text" width="70%">Detalle Característica</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($caracteristicas as $detalle) : ?>
                                 <tr>
                                    <td class="bg palette-Celeste">
                                       <b><span class="palette-White text"><?= $detalle->descripcion ?></span></b>
                                    </td>
                                    <td>
                                       <textarea rows="5" class="editor" disabled><?= html_entity_decode($detalle->caracteristica_detalle); ?></textarea>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </fieldset>
                  <fieldset class="fieldset">
                     <legend>
                        <h4><?= lang('adjudicacion.item') ?></h4>
                     </legend>
                     <?= form_open_multipart('adjuntar-adjudicacion'); ?>
                     <div class="row">

                        <input type="hidden" id="id_item" name="id_item" value="<?= $item->id_item; ?>">
                        <div class="large-4 medium-4 columns">
                           <div id="adjInforme" style="display: none;">
                              <div class="upload-btn-wrapper">
                                 <?= form_label(lang('subir.informe'), 'file_informe'); ?>
                                 <button class="btn button expanded">Informe de Calificación</button>
                                 <span id="aviso_file1" style="display: none;" class="centered">
                                    <p><b>(Documento Cargado)</b></p>
                                 </span>
                                 <input type="file" name="file_informe" title="Adjuntar Informe de Calificación" id="file_informe" />
                              </div>
                           </div>
                           <a id="calificacion" class="button expanded bg palette-Celeste" target="_blank" style="display: none;">Ver Informe de Calificación</a>
                        </div>
                        <div class="large-4 medium-4 columns">
                           <div id="adjResolucion" style="display: none;">
                              <div class="upload-btn-wrapper">
                                 <?= form_label(lang('subir.resolucion'), 'file_resolucion'); ?>
                                 <button class="btn button expanded">Nota o Resolución de Adjudicación</button>
                                 <span id="aviso_file2" style="display: none;" class="centered">
                                    <p><b>(Documento Cargado)</b></p>
                                 </span>
                                 <input type="file" name="file_resolucion" title="Adjuntar Ruta o Resolución de Adjudicación" id="file_resolucion" />
                              </div>
                           </div>
                           <a id="resolucion" class="button expanded bg palette-Celeste" target="_blank" style="display: none;">Ver Ruta o Resolución de Adjudicación</a>
                        </div>
                        <div class="large-4 medium-4 columns">
                           <div id="adjContrato" style="display: none;">
                              <div class="upload-btn-wrapper">
                                 <?= form_label(lang('subir.contrato'), 'file_contrato'); ?>
                                 <button class="btn button expanded">Contratación, Orden de Compra U Orden de Servicio</button>
                                 <span id="aviso_file3" style="display: none;" class="centered">
                                    <p><b>(Documento Cargado)</b></p>
                                 </span>
                                 <input type="file" name="file_contrato" title="Adjuntar Contratación, Orden de Compra U Orden de Servicio" id="file_contrato" />
                              </div>
                           </div>
                           <a id="contrato" class="button expanded bg palette-Celeste" target="_blank" style="display: none;">Ver Contratación, Orden de Compra U Orden de Servicio</a>
                        </div>
                     </div>
                     <div class="row" id="btnsubir" style="display: none;">
                        <div class="large-4 columns large-centered">
                           <?= form_submit('send', lang('subir.adjuntos'), ['class' => 'button expanded bg palette-Celeste']) ?>
                        </div>
                     </div>
                     <?= form_close() ?>
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
<div class="reveal" id="modalAdjudidacion" data-reveal data-options="closeOnClick:false; closeOnEsc:false;">
   <h3 class="lead">Desea Adjudicar la Propuesta Actual?</h3>
   <p><label id="nombreb" style="font-weight:bold"><label></p>
   <p>Empresa Adjudicada: <label id="nombre" style="display:inline; font-weight:bold"><label></p>
   <?= form_open('adjudicar-propuesta', 'data-abide no-validate'); ?>
   <input type="hidden" id="id_item" name="id_item" value="<?= $item->id_item; ?>">
   <input type="hidden" id="id_propuesta" name="id_propuesta">
   <div class="row">
      <?= form_label(lang('fecha.adjudicacion'), 'fecha_adjudicacion'); ?>
      <div class="input-group">
         <span class="input-group-label"><i class="las la-calendar"></i></span>
         <?= form_input('fecha_adjudicacion', null, ['class' => 'input-group-field datepicker', 'id' => 'fecha_adjudicacion', 'required' => 'required']); ?>
      </div>
      <span class="form-error" data-form-error-for="fecha_adjudicacion">
         <?= lang('campo.requerido') ?>
      </span>
   </div>
   <div class="row align-right">
      <div class="column small-6">
         <button type="button" data-close class="button expanded bg palette-Red">Cancelar</button>
      </div>
      <div class="column small-6">
         <?= form_submit('send', lang('adjudicar'), ['class' => 'button expanded bg palette-Celeste']) ?>
      </div>
   </div>
   <?= form_close() ?>
</div>

<div class="reveal" id="modalDetAdjudidacion" data-reveal data-options="closeOnClick:false; closeOnEsc:false;">
   <h4>Fecha de la Adjudicación</h4>
   <div class="row">
      <?= form_label(lang('fecha.adjudicacion'), 'fecha_adjudicacion'); ?>
      <div class="input-group">
         <span class="input-group-label"><i class="las la-calendar"></i></span>
         <?= form_input('fecha_adjudicacion', $item->fecha_adj, ['class' => 'input-group-field', 'id' => 'fecha_adjudicacion', 'readonly' => 'readonly']); ?>
      </div>
   </div>
   <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
   </button>
</div>




<?php $this->load->view('version2/propuesta/js/detalle') ?>
<?php $this->load->view('general/layout/footer') ?>