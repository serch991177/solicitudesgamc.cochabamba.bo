
<?php if ($this->session->flashdata('default')) : ?>
	<div class="callout secondary" data-closable="">
	    <h6><?php echo lang('mensaje.sesion') ?></h6>
	    <p><?php echo $this->session->flashdata('default') ?></p>
	    <button class="close-button" aria-label="Dismiss alert" type="button" data-close=""><span aria-hidden="true">&times;</span></button>
	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('default_error')) : ?>
	<div class="callout secondary" data-closable="">
	    <h6><i class="fontello-warning"></i><?php echo lang('mensaje.sesion.error') ?></h6>
	    <p><?php echo $this->session->flashdata('default_error') ?></p>
	    <button class="close-button" aria-label="Dismiss alert" type="button" data-close=""><span aria-hidden="true">&times;</span></button>
	</div>
<?php endif; ?>


<?php if ($this->session->flashdata('info')) : ?>
	<div class="primary callout" data-closable="">
        <h6><?php echo lang('actualizar.registro') ?></h6>
        <p><?php echo $this->session->flashdata('info') ?></p>
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close=""><span aria-hidden="true">&times;</span></button>
    </div>
<?php endif; ?>


<?php if ($this->session->flashdata('success')) : ?>
    <div class="success callout" data-closable="">
        <p><i class="las la-check-circle"></i><b><?php echo $this->session->flashdata('success')?></b></p>
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close="">
         <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('warning')) : ?>
	<div class="warning callout" data-closable="">
      <h6>This is a warning callout</h6>
      <p>Warning! Best check yo self, you're not looking too good.</p>
      <button class="close-button" aria-label="Dismiss alert" type="button" data-close="">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
<?php endif; ?>


<?php if ($this->session->flashdata('alert')) : ?>
    <div class="alert callout" data-closable="">
        <?php echo $this->session->flashdata('alert')?>
        <button class="close-button" data-close="" aria-label="Close modal" type="button">
            <i class="las la-times-circle la-2x close"></i>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('large')) : ?>
	<div class="callout large" data-closable="">
    	<h5>This is a large callout</h5>
    	<p>It has an easy to override visual style, and is appropriately subdued.</p>
    	<button class="close-button" aria-label="Dismiss alert" type="button" data-close=""><span aria-hidden="true">&times;</span></button>
    </div>
<?php endif; ?>
