<!doctype html>
<html>
  <head>
	<title>Rumahweb - SMS Gateway</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap-modal.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap-combobox.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>include/less/combobox.less">

    <script src="<?php echo base_url(); ?>include/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>include/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>include/js/bootstrap-combobox.js"></script>
	<script type="text/javascript">
		$(document).ajaxStart(function() {
			$('#prog').modal('show');
		});

		$(document).ajaxStop( function() {
			$('#prog').modal('hide');

		});
		
		$(window).load(function() {
			$('#prog').modal('hide');
		});
		$(document).ready(function () {
			if ($("[rel=tooltip]").length) {
			$("[rel=tooltip]").tooltip();
			}
		});
			
	</script>
	  <style type="text/css">
		  #prog {
			outline: none;
			position: absolute;
			margin-top: 0;
			top: 50%;
			overflow: visible;
			#z-index : 99999;
			}
	  </style>
  </head>


<div id="prog" class="modal hide fade progress progress-striped active" >
<div class="bar" style="width: 100%;"></div>
</div>
