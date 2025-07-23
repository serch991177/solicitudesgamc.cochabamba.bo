<!DOCTYPE html>
<html lang="es">

<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
<meta name="referrer" content="no-referrer" />
<?php  echo header("Referrer-Policy: no-referrer"); ?>
<?php $this->load->view('general/layout/head') ?>
<body>
<div class="wrap-fluid" id="paper-bg">


	<div class="row">
		<div class="large-7 large-centered columns">
		<?php $this->load->view('general/layout/message') ?>
			<div class="box no-shadow">
				<div class="box-body">
					<div class="row">
						<div class="large-12 large-centered">
							<p>
								<div class="center">
									<?=img('public/images/logo.png',false,array('id'=>'log'))?>
								</div>
							</p>
							<div class="large-12 large-centered">
								<p>
									<div class="center">
										<h3 class="palette-Blue-Grey-600 text">Sistema de Contrataciones V2</h3>
										<h4 class="palette-Blue-Grey-600 text">Sistema Interno</h4>
									</div>
								</p>
							</div>
						</div>
					</div>
				<div class="row">
					<div class="large-9 large-centered columns">
						<div id="responsiveTabsDemo">
							<ul>
								<li><a href="#tab-1"> <?=lang('iniciar.sesion')?> </a></li>
								
							</ul>

							<div id="tab-1"> 
								<?=form_open('iniciar-sesion', 'data-abide no-validate'); ?>
									<div class="row column">
										<div class="large-centered large-2">
											<?=img('public/images/proveedor.png'); ?> 
										</div>
									</div>
								

									<div class="row column">
										<?=form_label( lang('dni'), 'dni'); ?>
											<div class="input-group">
												<span class="input-group-label"><i class="las la-id-card"></i></span>
												<?=form_input('dni', set_value('dni'), ['class'=>'input-group-field', 'required'=>'required', 'id'=>'login_dni']); ?>
											</div>
											<span class="form-error" data-form-error-for="login_dni">
												<?=lang('campo.requerido')?>
											</span>

										<?=form_label( lang('contrasenia'), 'password'); ?> 
											<div class="input-group">
												<span class="input-group-label"><i class="las la-key"></i></span>
												<?=form_password('password', null, ['class'=>'input-group-field', 'required'=>'required', 'id'=>'login_password']); ?>
											</div>
											<span class="form-error" data-form-error-for="login_password">
												<?=lang('campo.requerido')?>
											</span>  

											<p>
												<?=form_submit('send', lang('iniciar.sesion'), ['class'=>'button expanded bg palette-Celeste'])?>
											</p>
												</div>
								<?=form_close() ?>	
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('general/login/js/login') ?>
<?php $this->load->view('general/layout/footer') ?>
</div>
</body>
</html>