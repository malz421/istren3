
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


<!--load select2-->
<script>
  $(function () {
    $(".select2").select2();
  });
</script>



<!--pop message box -->
<?php if ($this->session->flashdata('msg') == 'success'): ?>
	<script type="text/javascript">
			$.toast({
				heading: 'Success',
				text: "Data Berhasil Disimpan.",
				showHideTransition: 'slide',
				icon: 'success',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#7EC857'
			});
	</script>
<?php elseif ($this->session->flashdata('msg') == 'info'): ?>
	<script type="text/javascript">
			$.toast({
				heading: 'Info',
				text: "Data berhasil di update",
				showHideTransition: 'slide',
				icon: 'info',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#00C9E6'
			});
	</script>
<?php elseif ($this->session->flashdata('msg') == 'info-error'): ?>
	<script type="text/javascript">
			$.toast({
				heading: 'Error',
				text: "Data Gagal di update",
				showHideTransition: 'slide',
				icon: 'info',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#FF4859'
			});
	</script>
<?php elseif ($this->session->flashdata('msg') == 'success-hapus'): ?>
	<script type="text/javascript">
			$.toast({
				heading: 'Success',
				text: "Data Berhasil dihapus.",
				showHideTransition: 'slide',
				icon: 'success',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#7EC857'
			});
	</script>
<?php elseif ($this->session->flashdata('msg') == 'error'): ?>
	<script type="text/javascript">
			$.toast({
				heading: 'Error',
				text: "Data Gagal Disimpan.",
				showHideTransition: 'slide',
				icon: 'danger',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#FF4859'
			});
	</script>
<?php elseif ($this->session->flashdata('msg') == 'error-hapus'): ?>
	<script type="text/javascript">
			$.toast({
				heading: 'Error',
				text: "Data Gagal Dihapus.",
				showHideTransition: 'slide',
				icon: 'danger',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#FF4859'
			});
	</script>
<?php else: ?>
<?php endif;?>




<script type="text/javascript">


    $(document).ready(function(){
        ajaxcsrf();

			var idrole = $('#idrole').val();
			var table = $('#show_data').DataTable({
           	"processing":true,
			"paging": false,
           	"serverSide":true,
			"autoWidth":true,
        	"scrollCollapse": true,
           	"ajax":{
                "url":"<?php echo base_url() . 'all/Menuakses/data_hak_akses'; ?>",
                "type":"POST",
  							"data":function(data){data.idrole = $('#idrole').val();},
							},
							"columnDefs":[
                {
									"targets":[1,2,3,4],
									"orderable":false,
                }]
			});
			$("#idrole").change(function(){
					var table = $('#show_data').DataTable({
							"processing":true,
							"destroy":true,
							"paging": false,
							"serverSide":true,
							"autoWidth":true,
							"scrollCollapse": true,
							"ajax":{
										"url":"<?php echo base_url() . 'all/Menuakses/data_hak_akses'; ?>",
										"type":"POST",
										"data":function(data){data.idrole = $('#idrole').val();},
									},
									"columnDefs":[
										{
											"targets":[1,2,3,4],
											"orderable":false,
										}]
					});
			    table.draw();
	    });



    });
</script>

<script type="text/javascript">
  			function cgHakMenu(idmenu,idrole,nilai)
			{
				data = {
					idrole: idrole,
					idmenu: idmenu,
					hak: nilai
				}
				$.post('<?php echo base_url() . 'all/Menuakses/updateHakMenu'; ?>', data);
			}

			function cgHakAkses(id,idmenu,idparent,idrole,nilai)
			{
				/* var Table = $('#show_data').DataTable({
           "processing":true,
					 "paging": false,
					 "destroy":true,
           "serverSide":true,
					 "autoWidth":true,
					 "scrollY":true,
        	 "scrollCollapse": true,
           "ajax":{
                "url":"<?php echo base_url() . 'all/Menuakses/data_hak_akses'; ?>",
                "type":"POST",
  							"data":function(data){data.idrole = idrole;},
							},
							"columnDefs":[
                {
									"targets":[1,2,3,4],
									"orderable":false,
                }]
			  }); */

				data={
						idakses: id,
						idmenu: idmenu,
						idparent: idparent,
						idrole: idrole,
						hak: nilai
					}
				$.post('<?php echo base_url() . 'all/Menuakses/changeHakAkses'; ?>', data);

				if ($('input#'+idmenu).is(':checked')) {
					if ($('input#'+idmenu+"_tambah").length) {
						$('input#'+idmenu+"_tambah").prop('disabled', false);
						$('input#'+idmenu+"_tambah").prop('checked', true);
					}
					if ($('input#'+idmenu+"_ubah").length) {
						$('input#'+idmenu+"_ubah").prop('disabled', false);
						$('input#'+idmenu+"_ubah").prop('checked', true);
					}
					if ($('input#'+idmenu+"_hapus").length) {
						$('input#'+idmenu+"_hapus").prop('disabled', false);
						$('input#'+idmenu+"_hapus").prop('checked', true);
					}

				} else {
					if ($('input#'+idmenu+"_tambah").length) {
						$('input#'+idmenu+"_tambah").prop('disabled', true);
						$('input#'+idmenu+"_tambah").prop('checked', false);
					}
					if ($('input#'+idmenu+"_ubah").length) {
						$('input#'+idmenu+"_ubah").prop('disabled', true);
						$('input#'+idmenu+"_ubah").prop('checked', false);
					}
					if ($('input#'+idmenu+"_hapus").length) {
						$('input#'+idmenu+"_hapus").prop('disabled', true);
						$('input#'+idmenu+"_hapus").prop('checked', false);
					}

				}
				//Table.draw();
			}








</script>










