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
    <form class="form-horizontal" id="rekapgaji" action="" method="POST">
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
            <option value="Umum">Umum</option>
            <?php foreach ($dataunit as $key): ?>
                <option value="<?=$key->id_unit_kerja; ?>"><?=$key->nama_unit_kerja; ?></option>
              <?php endforeach ?>
          </select>
        </div>

      <label class="control-label col-sm-2" >Periode</label>
        <div class="form-group col-lg-9">
          <select class="form-control select2" id="id_periode" name="id_periode" onchange="Periode()">
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
</div>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-success">
        <div class="box-body">
          <div class="pull-right">
            <form class="form-horizontal" method="post" action="<?=base_url(); ?>kepegawaian/laporangaji/exportrekapgaji" enctype="multipart/form-data">
             <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                         <input type="text" name="idlembaga2" value="" hidden>
                        <input  type="text" name="idunitkerja2" value="" hidden>
                        <input type="text" id="Periode2" name="idperiode2" value="" hidden>
             <button type="submit" id="btnExportExcel" class="btn btn-info">Export Laporan Gaji</button>
           </form>
         </div>
       </div>
       <div class="box-body">
        <table class="table table-bordered table-striped" style="font-size:14px;" id="datagaji">
          <thead>
            <tr>
              <th>NO</th>
              <th>Nip</th>
              <th>Nama</th>
              <th>Unit</th>
              <th>Teamplate</th>
              <th>Periode</th>
              <th>Pendapatan</th>
              <th>Potongan</th>
              <th>Status</th>
            </tr>
          </thead>
            <tbody id="tbl_data">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function Periode() {
  var x = document.getElementById("id_periode").value;

    
}
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#btnExportExcel").hide();


  function format_angka(angka){
   var reverse = angka.toString().split('').reverse().join(''),
   ribuan = reverse.match(/\d{1,3}/g);
   ribuan = ribuan.join('.').split('').reverse().join('');
   return ribuan;
 }


 


   $("#submit").click(function(e){   
    console.log('test');
    ajaxcsrf();
    var btn = $('#submit');
    // if ($(this).attr("action") == base_url + "kepegawaian/LaporanGaji/TampilRekapGajiByDep") {
   
      e.preventDefault();
      e.stopImmediatePropagation();

      var idlembaga =   $('#id_lembaga').val();
      var idunitkerja =  $('#id_unit_kerja').val();
      var idperiode = $('#id_periode').val();



      $.ajax({
         url: base_url + "kepegawaian/LaporanGaji/TampilRekapGajiByDep", 
         data: {idlembaga: idlembaga,idunitkerja:idunitkerja,idperiode:idperiode},
         type: "POST",
          async: true,
         dataType: 'json',

      success: function(response){
         
          var i;
          var no = 0;
          var html = "";
           if (response.ok == ""){
             Swal({
              title: "Data" ,
              text: "Data tidak ditemukan",
              type: "error"
            });
           }else {
           for(i=0;i < response.ok.length ; i++){
            no++;
            html += '<tr>'
            + '<td>' + no + '</td>'
            + '<td>' + response.ok[i].nip_karyawan  + '</td>'
            + '<td>' + response.ok[i].nama_karyawan  + '</td>'
            + '<td>' + response.ok[i].nama_unit_kerja  + '</td>'
            + '<td>' + response.ok[i].nama_teamplate  + '</td>'
            + '<td>' + response.ok[i].nama_periode  + '</td>';
            
            if (response.ok[i].Pendapatan==null) {
             html += '<td>0</td>';
            }else{
            html += '<td>' + format_angka(response.ok[i].Pendapatan)  + '</td>';
            }
      
            if (response.ok[i].Potongan==null) {
             html += '<td>0</td>';
            }else{
               html += '<td>' + response.ok[i].Potongan  + '</td>';   
            }
            
            
            if(response.ok[i].status == 1){
              html += '<td><p style="color:green;">Sudah Dibayarkan</p></td>';
            }else{
               html += '<td><p style="color:red;">Belum Dibayarkan</p></td>';
            }
              html += '</tr>';
            }

          $("#tbl_data").html(html);  
          $('#datagaji').dataTable();
          $("#btnExportExcel").show();
          $('input[name="idperiode2"]').val(idperiode);
          $('input[name="idunitkerja2"]').val(idunitkerja);
          $('input[name="idlembaga2"]').val(idlembaga);

       } },
      error: function() {
        Swal({
          title: "Data" ,
          text: "Data tidak ditemukan",
          type: "error"
        });
      }
      });
    // }
  });
});

</script>

