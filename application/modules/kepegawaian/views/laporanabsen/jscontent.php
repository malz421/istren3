

<!--load select2-->
<script>
  $(function () {
    $(".select2").select2();
  });
</script>

<script type="text/javascript">
	$('#tglperiode1').datepicker({
      autoclose: true
      
    });
    	$('#tglperiode2').datepicker({
      autoclose: true
    });
    $("#tglperiode1").datepicker().datepicker("setDate", new Date());
     $("#tglperiode2").datepicker().datepicker("setDate", new Date());
</script>


<script type="text/javascript">
$(document).ready(function() {
    var table = $('#example2').dataTable({
					scrollX : true,
					paging: false,
	  				ordering: true,
                    scrollCollapse : true
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
<?php else: ?>
<?php endif;?>


<!--COMBO-->
<script type="text/javascript">

   $(document).ready(function(){
	   ajaxcsrf();
	   	var idlembaga = $('#idlembaga').val();
		var idunitkerja = $("#idunitkerja").val();
		var tglawal = $("#tglawal").val();
		var tglakhir = $("#tglakhir").val();
		var idkaryawan = $('#idkaryawan').val();

		$('#idlembaga').change(function(e){

			var idlembaga = $('#idlembaga').val();
			var idunitkerja = $("#idunitkerja").val();
			$.ajax({
			    type: 'POST',
				url: '<?php echo base_url('kepegawaian/karyawan/tampil_combo_karyawan') ?>',
			    data: { 'idlembaga' : idlembaga,'idunitkerja' : idunitkerja},
				success: function(data){
				if(data.length > 0){
					$("#idkaryawan").html(data);
			   }
			   else
			   {
				$('#idkaryawan').html("<option><---Pilih Karyawan---></option>");
			   }
			  }
			})
		})


			$.ajax({
			    type: 'POST',
				url: '<?php echo base_url('kepegawaian/karyawan/tampil_combo_karyawan') ?>',
			    data: { 'idlembaga' : idlembaga,'idunitkerja' : idunitkerja},
				success: function(data){
				if(data.length > 0){
					$("#idkaryawan").html(data);
			   }
			   else
			   {
				$('#idkaryawan').html("<option><---Pilih Karyawan---></option>");
			   }
			  }
			})

			$("#exprekapabsenkaryawan").attr("href", "<?php echo base_url() . 'kepegawaian/laporanabsen/exp_rekap_absensi_karyawan/'; ?>"+idkaryawan+"/"+tglawal+"/"+tglakhir);

			$('#idunitkerja').change(function(e){

			var idlembaga = $('#idlembaga').val();
			var idunitkerja = $("#idunitkerja").val();
			ajaxcsrf();

			$.ajax({
			    type: 'POST',
				url: '<?php echo base_url('kepegawaian/karyawan/tampil_combo_karyawan') ?>',
			    data: { 'idlembaga' : idlembaga,'idunitkerja' : idunitkerja},
				success: function(data){
				if(data.length > 0){
					$("#idkaryawan").html(data);
			   }
			   else
			   {
				$('#idkaryawan').html("<option><---Pilih Karyawan---></option>");
			   }
			  }
			})
		})


		$('#idkaryawan').change(function(e){

		var idkaryawan = $('#idkaryawan').val();
		var tglawal = $("#tglawal").val();
		var tglakhir = $("#tglakhir").val();

        $("#exprekapabsenkaryawan").attr("href", "<?php echo base_url() . 'kepegawaian/laporanabsen/exp_rekap_absensi_karyawan/'; ?>"+idkaryawan+"/"+tglawal+"/"+tglakhir);
		});



		$('#tglawal').change( function(){


		var idkaryawan = $('#idkaryawan').val();
		var tglawal = $("#tglawal").val();
		var tglakhir = $("#tglakhir").val();

		$("#exprekapabsenkaryawan").attr("href", "<?php echo base_url() . 'kepegawaian/laporanabsen/exp_rekap_absensi_karyawan/'; ?>"+idkaryawan+"/"+tglawal+"/"+tglakhir);
		});

		$('#tglakhir').change( function(){


		var idkaryawan = $('#idkaryawan').val();
		var tglawal = $("#tglawal").val();
		var tglakhir = $("#tglakhir").val();

		$("#exprekapabsenkaryawan").attr("href", "<?php echo base_url() . 'kepegawaian/laporanabsen/exp_rekap_absensi_karyawan/'; ?>"+idkaryawan+"/"+tglawal+"/"+tglakhir);
		});




	})
</script>


<!-- Load Gambar -->
<script>
	function readURL() {

    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("image").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("blah").src = oFREvent.target.result;
    };
  };
</script>

<!--Format Tanggal -->
<?php
function rubah_tanggal($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    //result = $tgl . "-" . $BulanIndo[(int)$bulan-1]. "-". $tahun;
    $result = $tgl . "-" . $bulan . "-" . $tahun;
    return ($result);
}

?>



<!---REKAP ABSEN PER UNIT KERJA -->
<script type="text/javascript">
$(document).ready(function(){
  $("#absenrekap").on("submit", function(e) {
    ajaxcsrf();
    var btn = $('#submit');
    if ($(this).attr("action") == base_url + "kepegawaian/LaporanAbsen/TampilRekapAbsensiByDep") {
	 
      e.preventDefault();
      e.stopImmediatePropagation();

 	  var idlembaga =   $('#idlembaga_combo').val();
      var idunitkerja =  $('#idunitkerja').val();
      var tglperiode1 = $('#tglperiode1').val(); 
      var tglperiode2 = $('#tglperiode2').val();


      $.ajax({
      url: $(this).attr("action"),
      data: {idlembaga: idlembaga,idunitkerja:idunitkerja,tglperiode1:tglperiode1,tglperiode2:tglperiode2 },
      type: "POST",
      datatype:"html",
      success: function(respon) {
        console.log(respon);
        document.getElementById("dataabsen").innerHTML = respon;
      
      },
      error: function() {
        Swal({
          title: "Data" ,
          text: "Data tidak ditemukan",
          type: "error"
        });
      }
      });
    }
  });
});

//tampil data rekap
function reload_rekapabsendep() {
	$("#absenrekap").attr("action", base_url + "kepegawaian/LaporanAbsen/TampilRekapAbsensiByDep");
    $("#absenrekap").submit();
}

</script>

<!---REKAP ABSEN PER UNIT KERJA END -->

<!---REKAP ABSEN PER KARYAWAN -->
<script type="text/javascript">
$(document).ready(function(){
  $("#absenrekapkaryawan").on("submit", function(e) {
    ajaxcsrf();
    var btn = $('#submit');
    if ($(this).attr("action") == base_url + "kepegawaian/LaporanAbsen/TampilRekapAbsensiByKaryawan") {
	 
      e.preventDefault();
      e.stopImmediatePropagation();
      
	  var idunitkerja =  $('#idunitkerja').val();
	  var idkaryawan =  $('#idkaryawan').val();
 	  var idlembaga =   $('#idlembaga').val();
      var tglperiode1 = $('#tglperiode1').val();
      var tglperiode2 = $('#tglperiode2').val();


      $.ajax({
      url: $(this).attr("action"),
      data: {idlembaga: idlembaga,idkaryawan:idkaryawan,idunitkerja:idunitkerja,tglperiode1:tglperiode1,tglperiode2:tglperiode2 },
      type: "POST",
      datatype:"html",
      success: function(respon) {
        console.log(respon);
        document.getElementById("dataabsen").innerHTML = respon;
      
      },
      error: function() {
        Swal({
          title: "Data" ,
          text: "Data tidak ditemukan",
          type: "error"
        });
      }
      });
    }
  });
});

//tampil data rekap
function reload_rekapabsenkaryawan() {
	$("#absenrekapkaryawan").attr("action", base_url + "kepegawaian/LaporanAbsen/TampilRekapAbsensiByKaryawan");
    $("#absenrekapkaryawan").submit();
}

</script>

<!---REKAP ABSEN PER KARYAWAN END -->







