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
          </div>
        </div>
      </div>
    </div>
    <div class="box box-success">
    	<div class="box-header with-border">
    		<h3 class="box-title">Formulir Pendaftaran Tamu</h3>
    	</div>
    	<div class="box-body">
    		<center>
    		<div class="image-upload" >
    			<label for="file-input">

            <?php if ($datatamu->image == ""): ?>
                <img id="gambar" style="max-width: 300px;" src="<?=base_url('assets/images/default_foto.png') ?>" />
            <?php endif ?>

            <?php if ($datatamu->image != ""): ?>
              <img id="gambar" style="max-width: 300px;" src="<?=$datatamu->image; ?>" />
            <?php endif ?>

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
    		<input type="text" id="nama_tamu" name="nama_tamu" placeholder="Silahkan Masukan Nama Anda" value="<?=$datatamu->nama_tamu; ?>" class="form-control">
        <input type="text" value="<?=$datatamu->id_tamu; ?>" id="id_tamu" name="id_tamu" hidden>
    		<br>
    		  <div class="input-group">
          <span class="input-group-addon">+62</span>
         <input type="number" id="no_hp_tamu" name="" placeholder="No Handphone/no WhatsApp Contoh(82124283527)" value="<?=$datatamu->no_hp_tamu; ?>" class="form-control" required>
        </div>
    		<br>
    		<input type="text" id="instansi_tamu" name="instansi_tamu" placeholder="Silahkan Masukan Nama Instansi/Perusahaan" value="<?=$datatamu->instansi_tamu; ?>" class="form-control" required>
    		<br>
    		<textarea id="alamat_tamu" class="form-control" name="alamat_tamu" placeholder="Silahkan Masukan Alamat Anda" required><?=$datatamu->alamat_tamu; ?></textarea>
    		<br>
    	 

        <select class="form-control select2" onchange="cekLemabaga()" name="id_lembaga" id="lembaga" required>
                  <option alue="<?=$datatamu->id_lembaga ; ?>" selected><?=$datatamu->nama_lembaga; ?></option>
                  <?php foreach ($datalembaga as $key): ?>
                    <option value="<?=$key->id_lembaga ; ?>"><?=$key->nama_lembaga; ?></option>
                  <?php endforeach ?>
        </select>
        <br>  <br>
        <select class="form-control select2" onchange="cekKaryawan()" name="id_karyawan" id="karyawan" required>
                <option value="<?=$datatamu->id_karyawan; ?>" selected><?=$datatamu->nip_karyawan; ?>-<?=$datatamu->nama_karyawan ?></option>
                <?php foreach ($datakaryawan as $key): ?>
                  <option value="<?=$key->id_karyawan; ?>"><?=$key->id_karyawan; ?>-<?=$key->nama_karyawan ?></option>
                <?php endforeach ?>
        </select>
        
        <br>  <br>
         <select class="form-control select2"  onchange="cekUnit()" name="id_unit_kerja" id="unit" disabled="">
                  <option value="<?=$datatamu->id_unit_kerja ; ?>" selected><?=$datatamu->nama_unit_kerja; ?></option>
                  <?php foreach ($dataunit as $key): ?>
                    <option value="<?=$key->id_unit_kerja ; ?>"><?=$key->nama_unit_kerja; ?></option>
                  <?php endforeach ?>
        </select>

        <br>
    		<br>
          <textarea id="tujuan_tamu" class="form-control" placeholder="Silahkan Masukan Tujuan Anda" required><?=$datatamu->tujuan_tamu; ?></textarea>
          <br>
        <div class="col-sm-12">
          <label for="file-input2">
        <img id="ttd" src="<?=$datatamu->tanda_tangan; ?>" class="img-responsive">
      </label>
    </div>
      <input id="file-input2" type="button" onClick="configure_ttd()" style="display: none;" />
      <div id="signature" style="display: none;"></div>
        <br>
    	</div>
      <div class="box-footer">
                <button style="width: 100%" type="submit" id="btn-simpan" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
 UPDATE</button>
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

  function configure_ttd(){
    // $(document).ready(function() {
     $("#ttd").hide();
     $('#signature').show();
      // document.getElementById('results_ttd').innerHTML ='';
      var $sigdiv = $("#signature").jSignature({'UndoButton':true});
      // $('#click').click(function(){
      // // Get response of type image
      // var data = $sigdiv.jSignature('getData', 'image');
      // // Storing in textarea
      // $('#output').val(data);
      // Alter image source 
      // $('#sign_prev').attr('src',"data:"+data);
      // $('#sign_prev').show();
      // });
      // });
    
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
<style>
#signature{
width: 100%;
height: auto;
border: 2px dashed black;
}
</style>


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
      var id_tamu = $('#id_tamu').val();
       var id_karyawan = $('#karyawan').val();

      var tanda_tangan = $("#signature").jSignature('getData', 'image');
      if (tanda_tangan) {
           var tanda_tangan_conv='data:'+tanda_tangan.toString();
      }else{
         var tanda_tangan_conv='data:,'; //sama dengan kosong
      }
     //cover array jadi string
     // console.log(tanda_tangan_conv);
    
     $.ajax({
          type: 'POST',
          url: '<?php echo base_url('umum/formulir/update_tamu') ?>',
          data: { 'nama_tamu' : nama_tamu,'no_hp_tamu' :no_hp_tamu,'instansi_tamu':instansi_tamu,'alamat_tamu' : alamat_tamu,'tujuan_tamu' : tujuan_tamu,'image': image,'tanda_tangan':tanda_tangan_conv,'id_tamu':id_tamu,'id_karyawan':id_karyawan},
           dataType: 'json',
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType('application/jsoncharset=UTF-8')
              }
            },
        success: function(data){
          console.log(data);
          if(data.status == 'sukses'){
            console.log('oke');
            swal({
              title:data.pesan,
              text: "Terimakasih",
              type: "success"
            }).then((result) =>{
              window.location.href= "<?=base_url('umum/Daftartamu') ?>";
              // location.reload();
            });
          }else{
            console.log('no');
              swal({
              title:data.pesan,
              text: "Terimakasih",
              type: "failed"
            }); 
          }
        },error: function(e) {
         alert("some error");
        }
      });
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