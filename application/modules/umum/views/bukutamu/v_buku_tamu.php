<style>
#signature{
width: 100%;
height: auto;
border: 2px dashed black;
}
</style>

<section class="content-header">
  <h1>
    Buku Tamu
  </h1>
</section>
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
    </div>
  </div>
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <div class="box-body">
           <button onclick="goBack()" class="btn btn-sm btn-danger"><span class="fa fa-mail-forward"></span> Kembali</button>
            <a href="<?php echo base_url('umum/Formulir'); ?>" class="btn btn-sm btn-info">
              <span class="fa fa-refresh"></span> Refresh</a>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-success">
    	<div class="box-header with-border">
    		<h3 class="box-title">Formulir Pendaftaran Tamu</h3>
        <div class="alert alert-danger print-error-msg" style="display:none">
         </div>
    	</div>
    	<div class="box-body">
    		<center>
    		<div class="image-upload" >
    			<label for="file-input">
    				<img id="gambar" style="max-width: 300px;" src="<?=base_url('assets/images/default_foto.png') ?>" />
    				 <div id="my_camera"></div>
    				  <div id="results" ></div>
    				  <input type="text" name="image" id="image" hidden>
    				 <br>
    				 <button class="btn btn-success" onClick="take_snapshot()" style="display: none;" id="btn-ambil">Ambil Foto</button>
             <button class="btn btn-success" onClick="reset()" id="reload" style="display: none;" id="btn-ambil">Reload</button>
    			</label>
    			<input id="file-input" type="button" onClick="configure()" style="display: none;" />
    		</div>
    		</center>
    		<br>
    		<input type="text" id="nama_tamu" name="nama_tamu" placeholder="NAMA ANDA Contoh(zaenudin)" value="" class="form-control" required>
    		<br>
    		<!-- <input type="number" id="no_hp_tamu" name="" placeholder="No Handphone (ex.82124283527)" value="" class="form-control" required> -->
        <div class="input-group">
          <span class="input-group-addon">+62</span>
         <input type="number" id="no_hp_tamu" name="no_hp_tamu" placeholder="No Handphone/No WhatsApp Contoh(82124283527)" value="" class="form-control" required>
        </div>
    		<br>
    		<input type="text" id="instansi_tamu" name="instansi_tamu" placeholder="NAMA INSATNSI Contoh(Telkom)" value="" class="form-control" required>
    		<br>
    		<textarea id="alamat_tamu" class="form-control" name="alamat_tamu" placeholder="ALAMAT Contoh(Sukabumi/kp.nagewer/des.bojong asih/rt01/rw01)" required></textarea>
    		<br>
    		
        <select class="form-control select2" onchange="cekLemabaga()" name="id_lembaga" id="lembaga" required>
                  <option disabled selected>Pilih Lembaga</option>
                  <?php foreach ($datalembaga as $key): ?>
                    <option value="<?=$key->id_lembaga ; ?>"><?=$key->nama_lembaga; ?></option>
                  <?php endforeach ?>
        </select>
    		<br>  <br>
         <select class="form-control select2" onchange="cekKaryawan()" name="id_karyawan" id="karyawan" required>
                <option disabled selected>Pilih Nama Karyawan</option>
                <?php foreach ($datakaryawan as $key): ?>
                  <option value="<?=$key->id_karyawan; ?>"><?=$key->nama_karyawan ?></option>
                <?php endforeach ?>
        </select>
       
        <br>  <br>
         <select class="form-control select2"  onchange="cekUnit()" name="id_unit_kerja" id="unit" disabled="">
                  <option disabled selected>Unit</option>
                  <?php foreach ($dataunit as $key): ?>
                    <option value="<?=$key->id_unit_kerja ; ?>"><?=$key->nama_unit_kerja; ?></option>
                  <?php endforeach ?>
        </select>
        
          <br>  <br>

          <textarea id="tujuan_tamu" class="form-control" placeholder="Contoh(Interview Kerja)" required></textarea>
        <br>
    		<div id="signature"></div>
    		<!--  <input type='button' id='click' value='simpan'> -->
    		<!-- <textarea id='output'></textarea><br/> -->
    		<!-- Preview image -->
    		<!-- <img src='' id='sign_prev' style='display: none;' /> -->
    	</div>
      <div class="box-footer">
                <button style="width: 100%" type="submit" id="btn-simpan" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
 Kirim</button>
       </div>
    	<!-- /.box-body -->
    </div>
</section> 
 <!-- Script -->

 <script type="text/javascript" src="<?=base_url();?>assets/webcamjs-master/webcam.min.js"></script>

 <!-- Code to handle taking the snapshot and displaying it locally -->
 <script language="JavaScript">
 function reset(){
   $("#imageprev").hide();  
    Webcam.attach( '#my_camera' );
     $("#my_camera").show();
     $("#reload").hide(); 
     $("#btn-ambil").show(); 
 }
 // Configure a few settings and attach camera
 function configure(){
  Webcam.set({
   width: 320,
   height: 240,
   image_format: 'jpeg',
   jpeg_quality: 90
  });
  Webcam.attach( '#my_camera' );
  $("#gambar").hide();  
  $("#btn-ambil").show(); 
   
 }
 // A button for taking snaps


 // preload shutter audio clip
 var shutter = new Audio();
 shutter.autoplay = false;
 shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

 function take_snapshot() {
  // play sound effect
   $("#gambar").hide(); 
    $("#my_camera").hide();
    $("#reload").show(); 
    $("#btn-ambil").hide();  
  shutter.play();

  // take snapshot and get image data
  Webcam.snap( function(data_uri) {
  $('#image').val(data_uri);
  // display results in page
  document.getElementById('results').innerHTML = 
   '<img style="width:180px; height:240px;" id="imageprev" src="'+data_uri+'"/>';
  } );

  Webcam.reset();
 }

function saveSnap(){
 // Get base64 value from <img id='imageprev'> source
 var base64image = document.getElementById("imageprev").src;

 Webcam.upload( base64image, 'upload.php', function(code, text) {
  console.log('Save successfully');

  //console.log(text);
 });

}
</script>

<!-- Script -->
<script>
  $(document).ready(function() {
 // Initialize jSignature
 var $sigdiv = $("#signature").jSignature({
  'UndoButton':true
});

});
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $("#btn-simpan").click(function() {
       // e.preventDefault();
       ajaxcsrf();
      var nama_tamu = $('#nama_tamu').val();
      var no_hp_tamu = $('#no_hp_tamu').val();
      var instansi_tamu = $('#instansi_tamu').val();
      var alamat_tamu = $('#alamat_tamu').val();
      var tujuan_tamu = $('#tujuan_tamu').val();
      var image = $('#image').val();
      var id_karyawan = $('#karyawan').val();

    
      var tanda_tangan = $("#signature").jSignature('getData', 'image');
      var tanda_tangan_conv='data:'+tanda_tangan.toString();//cover array jadi string
     
      var default_nilai_kosong_ttd='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABFIAAAEVCAYAAADD38F5AAAEuklEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAnBu1CwAB7fI/kAAAAABJRU5ErkJggg==';

  console.log(tanda_tangan_conv+'jancok');
     // console.log(tanda_tangan_conv);
     // cek validasi ttd
    if (tanda_tangan_conv=='data:,') {
      $(".print-error-msg").css('display','block');
      $(".print-error-msg").html('Mohon lakukan Tanda Tangan Seblum Menyimpan');
    }else{
             $.ajax({
              type: 'POST',
              url: '<?php echo base_url('umum/formulir/add_tamu') ?>',
              data: { 'nama_tamu' : nama_tamu,'no_hp_tamu' :no_hp_tamu,'instansi_tamu':instansi_tamu,'alamat_tamu' : alamat_tamu,'tujuan_tamu' : tujuan_tamu,'image': image,'tanda_tangan':tanda_tangan_conv,'id_karyawan':id_karyawan},
              dataType: 'json',
              beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                  e.overrideMimeType('application/jsoncharset=UTF-8')
                }
              },
              success: function(data){
                console.log(data);
                  // cek validasi
                  if($.isEmptyObject(data.error)){
                    $(".print-error-msg").css('display','none');
              // cek data masuk
              if(data.status == 'sukses'){
                console.log('oke');
                swal({
                  title:"Data Berhasil Disimpan",
                  text: "Terimakasih",
                  type: "success"
                }).then((result) =>{
                  location.reload();
                });
              }else{
                console.log('no');
                swal({
                  title:"Data Berhasil Disimpan",
                  text: "Terimakasih",
                  type: "success"
                }); 
              }
            }else{
              $(".print-error-msg").css('display','block');
              $(".print-error-msg").html(data.error);
              console.log('eror validasi');
            }

          },error: function(e) {
           alert("some error");
         }
        });
    }
   
   });
  });
     
</script>


<script type="text/javascript">
  function cekLemabaga(){
    ajaxcsrf();
    var lembaga = $('#lembaga').val();
    var unit = $('#unit').val();
    console.log('lembaga:'+lembaga+'unit'+unit);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('umum/formulir/tampil_karyawan_perlembaga') ?>',
          data: { 'lembaga' : lembaga,'unit' :unit},
        success: function(data){
        if(data.length > 0){
          $("#karyawan").html(data);
         }
         else
         {
        $('#karyawan').html("<option disabled selected>Pilih Karyawan</option>");
         }
        }
      });
  }

    function cekKaryawan(){
    ajaxcsrf();
    var karyawan=$('#karyawan').val();
    console.log('karyawan:'+karyawan);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('umum/formulir/tampil_karyawan') ?>',
          data: { 'karyawan' : karyawan},
        success: function(data){
        if(data.length > 0){
           $("#unit").html(data);
         }
         else
         {
        $('#karyawan').html("<option disabled selected>Pilih Karyawan</option>");
         }
        }
      });
  }



  function cekUnit(){
      ajaxcsrf();
    var lembaga = $('#lembaga').val();
    var unit = $('#unit').val();
    console.log('lembaga:'+lembaga+'unit'+unit);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('umum/formulir/tampil_karyawan_perunit') ?>',
           data: { 'lembaga' : lembaga,'unit' :unit},
        success: function(data){
        if(data.length > 0){
          $("#karyawan").html(data);
         }
         else
         {
        $('#karyawan').html("<option disabled selected>Pilih Karyawan</option>");
         }
        }
      });
  }
</script>