
<!--load select2-->
<script>
  $(function () {
    $(".select2").select2();
  });
</script>

<!--load datatables -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
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


		$('#lembaga').on('change', function(){
			var idlembaga = $('#lembaga').val();
		
			$.ajax({
			    type: 'POST',
			    url: '<?php echo base_url('kepegawain/departemen/tampil_combo_lembaga') ?>',
				cache: false,
			    data: { 'id' : idlembaga },
				success: function(data){
					if(data.length > 0){
						$("#departemen").html(data);
					}
					else 
					{
						$('#penerimaan').html("<option>Pilih Penerimaan</option>");
					}
				}
			});
		});
	});
</script>


