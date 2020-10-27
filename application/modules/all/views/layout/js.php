
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>

<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Datatables Buttons -->
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.colVis.min.js"></script>

<script src="<?=base_url()?>assets/bower_components/pace/pace.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>

<!-- timepicker -->
<script src="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>

<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<!--<script src="<?php echo base_url('assets/bower_components/daterangepicker/daterangepicker.js') ?>"></script>-->


<!-- Textarea editor -->
<script src="<?=base_url()?>assets/bower_components/codemirror/lib/codemirror.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/codemirror/mode/xml.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/froala_editor/js/froala_editor.pkgd.min.js"></script>

<!-- App JS -->
<script src="<?=base_url()?>assets/dist/js/app/dashboard.js"></script>
<script src="<?=base_url() . 'assets/plugins/toast/jquery.toast.min.js'?>"></script>
<script src="<?=base_url() . 'assets/bower_components/fullcalendar/dist/fullcalendar.min.js'?>"></script>



<script type="text/javascript">
$(document).ready(function(){
                /** add active class and stay opened when selected */
                var url = window.location;
                // for sidebar menu entirely but not cover treeview
                $('ul.sidebar-menu a').filter(function() {
                     return this.href == url;
                }).parent().addClass('active');

                // for treeview
                $('ul.treeview-menu a').filter(function() {
                     return this.href == url;
                }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');


            });
               </script>
               
<!--<script type="text/javascript">
$(document).ready(function(){
               var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.sidebar-menu a').filter(function() {
    return this.href == url;
}).parent().siblings().removeClass('active').end().addClass('active');

// for treeview
$('ul.treeview-menu a').filter(function() {
    return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active').end().addClass('active');

 });
               </script>-->















