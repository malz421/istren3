
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url('assets/images/istren-icon.png') ?>" >
  <title>ISTREN | INFORMASI SISTEM PESANTREN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
	<link  rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>" />
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!--<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/daterangepicker/daterangepicker.css">-->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/pace/pace-theme-flash.css">
    <!--timepicker -->
    
	<!-- Datatables Buttons -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/css/buttons.bootstrap.min.css">

	<!-- textarea editor -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/codemirror/lib/codemirror.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/froala_editor/css/froala_editor.pkgd.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/froala_editor/css/froala_style.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/froala_editor/css/themes/royal.min.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>"/>

	<link rel="stylesheet" href="<?php echo base_url() . 'assets/bower_components/fullcalendar/dist/fullcalendar.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css' ?>" media="print" >
	<!-- /texarea editor; -->

  <!-- dropzone -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropzone/dropzone.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropzone/basic.min.css') ?>">

<script type="text/javascript" src="<?php echo base_url('assets/dropzone/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/dropzone/dropzone.min.js') ?>"></script>


	<style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
	  opacity:0.6;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }

    .dropzone {
      margin-top: 100px;
      border: 2px dashed #0087F7;
    }
    </style>



	<style type="text/css">

	  .brandlogo-image {
		width: 25px;
		height: 25px;
		margin-right: 10px;
		margin-top: -2px;
		background-color: #ffffff;
		}
	</style>


<style>
@media print {
  .visible-print  { display: inherit !important; }
  .hidden-print   { display: none !important; }
  .noprint { 
                  visibility: hidden; 
               } 
    a[href]:after {
    content: none !important;
  }
}
</style>

<script type="text/javascript">

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

</script>

</head>

<script src="<?=base_url()?>assets/bower_components/jquery/jquery-3.3.1.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/select2/js/select2.full.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
	let base_url = '<?=base_url()?>';
</script>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
