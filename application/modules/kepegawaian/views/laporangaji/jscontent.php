

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

<!---REKAP ABSEN PER UNIT KERJA -->
<script type="text/javascript">
$(document).ready(function(){
  $("#rekapgaji").on("submit", function(e) {
  	console.log('test');
    ajaxcsrf();
    var btn = $('#submit');
    if ($(this).attr("action") == base_url + "kepegawaian/LaporanGaji/TampilRekapGajiByDep") {
	 
      e.preventDefault();
      e.stopImmediatePropagation();

 	  var idlembaga =   $('#id_lembaga').val();
      var idunitkerja =  $('#id_unit_kerja').val();
      var idperiode = $('#id_periode').val();

      $.ajax({
      url: $(this).attr("action"),
      data: {idlembaga: idlembaga,idunitkerja:idunitkerja,idperiode:idperiode},
      type: "POST",
      datatype:"html",
      success: function(respon) {
        console.log(respon);
        document.getElementById("datagaji").innerHTML = respon;
      
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

</script>

<!---REKAP ABSEN PER KARYAWAN END -->







