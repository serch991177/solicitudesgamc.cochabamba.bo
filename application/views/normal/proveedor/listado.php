<?php $this->load->view('general/layout/menu') ?>

<div class="row">
    <div class="large-11 large-centered columns">
        <?php $this->load->view('general/layout/message') ?>
        <div class="box no-shadow">
            <div class="box-header panel palette-Red bg">
                <h3 class="box-title palette-White"><i class="las la-th-list la-2x"></i>
                    <span><?= lang('listado.proveedores') ?></span>
                </h3>
            </div>

            <div class="box-body">
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
<?php $this->load->view('normal/proveedor/js/listado') ?>
<?php $this->load->view('general/layout/footer') ?>