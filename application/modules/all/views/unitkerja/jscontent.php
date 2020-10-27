
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true
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

    
