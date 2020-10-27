<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Rekap Gaji
	</h1>
</section>

<section class="content">
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<div class="box box-success">
			<div class="box-body">
				<button id="btn_kembali" class="btn btn-sm btn-danger pull-right">
				<span class="fa fa-mail-forward"></span> Kembali</button>
			</div>
		</div>
	</div>
</div>

	<!-- Content -->
<div class="row">
	<div class="col-lg-6">
		<form class="form-horizontal" id="rekapgaji" method="post" action="">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="box box-success">
			<div class="box-body">
				<br>
			<label class="control-label col-sm-2" >Lembaga</label>
				<div class="form-group col-lg-9">
					<select class="form-control select2" id="id_lembaga" name="id_lembaga
					">
							<!-- <option value="">Pilih Lembaga</option> -->
							<?php foreach ($datalembaga as $key): ?>
								<option value="<?=$key->id_lembaga; ?>"><?=$key->nama_lembaga; ?></option>
							<?php endforeach ?>
					</select>
				</div>

			<label class="control-label col-sm-2" >Unit</label>
				<div class="form-group col-lg-9">
					<select class="form-control select2" id="id_unit_kerja" name="id_unit_kerja">
						<!-- <option value="">Pilih Unit</option> -->
						<?php foreach ($dataunit as $key): ?>
								<option value="<?=$key->id_unit_kerja; ?>"><?=$key->nama_unit_kerja; ?></option>
							<?php endforeach ?>
					</select>
				</div>

			<label class="control-label col-sm-2" >Periode</label>
				<div class="form-group col-lg-9">
					<select class="form-control select2" id="id_periode" name="id_periode">
						<!-- <option value="">Pilih Periode</option> -->
						<?php foreach ($dataperiode as $key): ?>
								<option value="<?=$key->id_periode; ?>"><?=$key->nama_periode; ?></option>
							<?php endforeach ?>
					</select>
				</div>
			
			</div>
			<div class="box-footer">
				<button id="submit" class="btn btn-sm btn-info" type="button"><i class="fa fa-search"></i> Cari</button>
			</div>
		</div>
	</form>
	</div>

	<div id="datagaji">
		
	</div>
</div>
</section>


<script type="text/javascript">
	

$(document).ready(function(){   

    $("#submit").click(function(e)
    {   
    	
    	ajaxcsrf();
    
    	// if ($(this).attr("action") == base_url + "kepegawaian/LaporanGaji/TampilRekapGajiByDep") {

    		e.preventDefault();
     	e.stopImmediatePropagation();

    		var idlembaga =   $('#id_lembaga').val();
    		var idunitkerja =  $('#id_unit_kerja').val();
    		var idperiode = $('#id_periode').val();
    		console.log('tes data'+id_lembaga);

    		$.ajax({
    			url: base_url + "kepegawaian/LaporanGaji/TampilRekapGajiByDep", 
    			data: {idlembaga: idlembaga,idunitkerja:idunitkerja,idperiode:idperiode},
    			type: "POST",
    			datatype:"html",
    			success: function(respon) {
    				console.log(respon);
    				document.getElementById("datagaji").innerHTML = respon;

    			},
    			error: function() {
    				// Swal({
    				// 	title: "Data" ,
    				// 	text: "Data tidak ditemukan",
    				// 	type: "error"
    				// });
    				console.log('data tidak ditemukan');
    			}
    		});
    	// }else{
    	// 		console.log(idlembaga+'=gak masuk');
    	// }
 });
 });


</script>


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
