<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>PROVEEDORES</title>
    <link rel="icon" href="<?= base_url() ?>/favicon.ico" type="image/ico">
    <!-- JQUERY -->
    <?php echo link_tag('node_modules/foundation-emails/dist/foundation-emails.css'); ?>
    
    <?php echo link_tag('public/css/palette.css');?>
    <?php echo link_tag('public/css/theme.css');?>
    <?php echo link_tag('public/css/mystyle.css'); ?>
</head>

<body>

    <div class="row">
        <div class="large-5 large-centered columns">
            <columns small="6" valign="middle" class="centered">
                <img src="<?=base_url('public/images/escudo.png')?>" style="width: 30%;">
            </columns>
        </div>
    </div>


    <div class="row">
        <div class="large-11 large-centered columns">
            <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">
            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
                    <span><?=lang('validacion.cuenta')?></span>
                </h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="large-12 columns medium-12 small-12">
                        

                    <div class="row">
       
                                <container>
                                    <row class="collapse">
                                        
                                        <columns small="6" valign="middle">
                                            <h3 class="text-left">VALIDACIÓN DE CUENTA DE PROVEEDOR</h3>
                                        </columns>
                                    </row>
                                </container>
                            
                            <container>

                                <spacer size="16"></spacer>

                                <row>
                                    <columns>
                                        <p class="lead">NIT / DOCUMENTO DE IDENTIDAD: <b><?= $registro->nit; ?></b></p>
                                        <p class="lead">Este es el ultimo paso para el registro en el sistema de Propuestas, por favor, para validar su cuenta haga click <a href="<?=site_url('validar/').$registro->hash; ?>">AQUI!</a></p>
                                        <p>** Este mensaje fue enviado automaticamente por el sistema, por favor no responda al mismo.</p>
                                    </columns>
                                </row>

                                <wrapper class="secondary">
                                    <spacer size="16"></spacer>
                                    <row>
                                        <columns small="12" large="6">
                                            <h5>Encuentranos:</h5>
                                            <menu class="vertical">
                                                <p style="text-align: left;" href="https://twitter.com/gam_cochabamba"><i class="lab la-twitter la-2x"></i>Twitter</p>
                                                <p style="text-align: left;" href="https://www.facebook.com/gamcochabamba"><i class="lab la-facebook la-2x"></i>Facebook</p>
                                            </menu>
                                        </columns>
                                        <columns small="12" large="6">
                                            <h5>Información de Contacto:</h5>
                                            <p><i class="las la-phone la-2x"></i>Teléfono: +591 - 4258030</p>
                                            <p><i class="las la-envelope-open-text la-2x"></i>Correo electrónico: <a href="mailto:contactos@cochabamba.bo">contactos@cochabamba.bo</a></p>
                                            <p><i class="las la-globe la-2x"></i>Pagina WEB: <a href="http://www.cochabamba.bo">Gobierno Autonomo Municipal de Cochabamba</a></p>
                                        </columns>
                                    </row>
                                </wrapper>

                            </container>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>






