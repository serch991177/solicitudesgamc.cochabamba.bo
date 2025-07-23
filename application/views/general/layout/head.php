<head>
	<meta charset="utf-8">
	<title>Propuestas</title>
	<link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/ico">
		

	

	<!-- JQUERY -->
	<script src="<?=base_url('node_modules/jquery/dist/jquery.js')?>"></script>
	<script src="<?=base_url('node_modules/jquery-validation/dist/jquery.validate.js')?>"></script>	

	<!-- FOUNDATION SITES -->
   <?php echo link_tag('node_modules/foundation-sites/dist/css/foundation.css');?>
	<?php echo link_tag('node_modules/foundation-sites/dist/css/foundation-float.css');?>
	<script src="<?=base_url('node_modules/foundation-sites/dist/js/foundation.min.js')?>"></script>
	
	

	<!-- RESPONSIVE TABS -->
	<?php echo link_tag('node_modules/responsive-tabs/css/responsive-tabs.css');?>
	<?php echo link_tag('node_modules/responsive-tabs/css/style.css');?>
	<script src="<?=base_url('node_modules/responsive-tabs/js/jquery.responsiveTabs.js')?>"></script>
	

	<!-- SELECT2 -->
	<?php echo link_tag('node_modules/select2/dist/css/select2.css');?>
   <script src="<?=base_url('node_modules/select2/dist/js/select2.js')?>"></script>
   
	<!-- DATATABLES -->
	<script src="<?=base_url('node_modules/datatables/media/js/jquery.dataTables.js')?>"></script>
	<?php echo link_tag('node_modules/datatables/media/css/jquery.dataTables.css');?>
	<?php echo link_tag('public/css/datatableresponsive.css');?>
	<script src="<?=base_url('node_modules/datatables.net-responsive/js/dataTables.responsive.js')?>"></script>

	
	<!-- LINEAWESONE -->
	<?php echo link_tag('node_modules/line-awesome/dist/line-awesome/css/line-awesome.css');?>

	<!-- TOOLTIP -->
	<?php echo link_tag('node_modules/css-tooltip/dist/css-tooltip.css');?>

	<!--PIACKADATE-->
	<script src="<?=base_url('node_modules/pickadate/lib/picker.js')?>"></script>
	<script src="<?=base_url('node_modules/pickadate/lib/picker.date.js')?>"></script>
	<?php echo link_tag('node_modules/pickadate/lib/themes/default.css');?>
	<?php echo link_tag('node_modules/pickadate/lib/themes/default.date.css');?>

	<!-- CKEDITOR 5-->
	<script src="node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

	<!-- LEAFLET -->
	<?php echo link_tag('node_modules/leaflet/dist/leaflet.css');?>
	<script src="<?=base_url('node_modules/leaflet/dist/leaflet.js')?>"></script>

	<!-- MIS ESTILOS --> 
	<?php echo link_tag('public/css/palette.css');?>
   <?php echo link_tag('public/css/theme.css');?>
	<?php echo link_tag('public/css/mystyle.css');?>

</head>