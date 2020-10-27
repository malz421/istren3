
<script>

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "scrollY":'50vh',
      "scrollCollapse": true
    });
  });
</script>

<script type="text/javascript">
   $("#btn_kembali").on('click',function(){
    window.history.go(-1);
   });
</script>


<script type="text/javascript">
  const flashData =$('.flash-data').data('flashdata');
  if (flashData) {
    Swal({
      title : 'Berhasil',
      text : flashData+'',
      type : 'success'
    });
  }

const flashData2 =$('.flash-data2').data('flashdata2');

if (flashData2) {
  Swal({
    title : 'Gagal',
    text : flashData2+'',
    type : 'error'
  });
}

$('.tombol-hapus').on('click', function (e){
  e.preventDefault();
  const href=$(this).attr('href');
  Swal({
    title: 'Anda Yakin?',
    text: 'pilih yes untuk menghapus!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      document.location.href=href;


    }
  });
});

$('#Kategori').change(function(e){
    ajaxcsrf();
    console.log("text");
      var Kategori = $('#Kategori').val();
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('kepegawaian/payroll/tampil_combo_komponen') ?>',
          data: { 'Kategori' : Kategori},
        success: function(data){
        if(data.length > 0){
          $("#komponen").html(data);
         }
         else
         {
        $('#komponen').html("<option disabled selected>Pilih komponen</option>");
         }
        }
      })
    });
  function cekKategori(id){
      ajaxcsrf();
    var Kategori = $('#Kategori'+id).val();
    console.log(Kategori);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('kepegawaian/payroll/tampil_combo_komponen') ?>',
          data: { 'Kategori' : Kategori},
        success: function(data){
        if(data.length > 0){
          $("#komponen"+id).html(data);
         }
         else
         {
        $('#komponen'+id).html("<option disabled selected>Pilih komponen</option>");
         }
        }
      });
  }
function cekLemabaga(){
    ajaxcsrf();
    var lembaga = $('#lembaga').val();
    var unit = $('#unit').val();
    console.log('lembaga:'+lembaga+'unit'+unit);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('kepegawaian/payroll/tampil_karyawan_perlembaga') ?>',
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

    function cekUnit(){
      ajaxcsrf();
    var lembaga = $('#lembaga').val();
    var unit = $('#unit').val();
    console.log('lembaga:'+lembaga+'unit'+unit);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('kepegawaian/payroll/tampil_karyawan_perunit') ?>',
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

  function hapus(element) {
    var menu = document.getElementById('record');
    menu.removeChild(menu.lastElementChild);
   }
  function readURL() {

    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("image").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("blah").src = oFREvent.target.result;
    };
  };
</script>
