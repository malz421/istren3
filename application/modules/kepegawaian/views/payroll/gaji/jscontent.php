

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
          title: "Data" ,
          text:  flashData2+'',
          type: "error"
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
$('.tombol-batal-pengambilan').on('click', function (e){
  e.preventDefault();
  const href=$(this).attr('href');
  Swal({
    title: 'Anda Yakin?',
    text: 'pilih yes untuk membatalkan Pembayaran!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.value) {
      document.location.href=href;


    }
  });
});

</script>

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

<!--load select2-->
<script>
  $(function () {
    $(".select2").select2();
  });
</script>

<script type="text/javascript">
  $('.timepicker').timepicker({
    showMeridian: false,
    timeFormat: 'H:i'
  });
</script>

<script type="text/javascript">
  $('#datepicker2').datepicker({
      autoClose: true,
      zIndex: 2048,
    });
</script>


<script type="text/javascript">
  $('#datepicker3').datepicker({
      autoClose: true,
      zIndex: 2048,
    });
</script>
<!-- checkbox -->
<script type="text/javascript">
  // $(".select_all").on("click", function() {
  //   if (this.checked) {
  //     $(".check").each(function() {
  //       this.checked = true;
  //       $(".select_all").prop("checked", true);
  //     });
  //   } else {
  //     $(".check").each(function() {
  //       this.checked = false;
  //       $(".select_all").prop("checked", false);
  //     });
  //   }
  // });

  // $("#example2 tbody").on("click", "tr .check", function() {
  //   var check = $("#karyawan tbody tr .check").length;
  //   var checked = $("#karyawan tbody tr .check:checked").length;
  //   if (check === checked) {
  //     $(".select_all").prop("checked", true);
  //   } else {
  //     $(".select_all").prop("checked", false);
  //   }
  // });
</script>


<!--load datatables -->

<!--pop message box -->



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

<!-- format rupiah -->
  <script type="text/javascript">
    function tandaPemisahTitik(b){
      var _minus = false;
      if (b<0) _minus = true;
      b = b.toString();
      b=b.replace(".","");
      b=b.replace("-","");
      c = "";
      panjang = b.length;
      j = 0;
      for (i = panjang; i > 0; i--){
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)){
          c = b.substr(i-1,1) + "." + c;
        } else {
          c = b.substr(i-1,1) + c;
        }
      }
      if (_minus) c = "-" + c ;
      return c;
    }

    function numbersonly(ini, e){
      if (e.keyCode>=49){
        if(e.keyCode<=57){
          a = ini.value.toString().replace(".","");
          b = a.replace(/[^\d]/g,"");
          b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
          ini.value = tandaPemisahTitik(b);
          return false;
        }
        else if(e.keyCode<=105){
          if(e.keyCode>=96){
//e.keycode = e.keycode - 47;
a = ini.value.toString().replace(".","");
b = a.replace(/[^\d]/g,"");
b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
ini.value = tandaPemisahTitik(b);
//alert(e.keycode);
return false;
}
else {return false;}
}
else {
  return false; }
}else if (e.keyCode==48){
  a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
  b = a.replace(/[^\d]/g,"");
  if (parseFloat(b)!=0){
    ini.value = tandaPemisahTitik(b);
    return false;
  } else {
    return false;
  }
}else if (e.keyCode==95){
  a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
  b = a.replace(/[^\d]/g,"");
  if (parseFloat(b)!=0){
    ini.value = tandaPemisahTitik(b);
    return false;
  } else {
    return false;
  }
}else if (e.keyCode==8 || e.keycode==46){
  a = ini.value.replace(".","");
  b = a.replace(/[^\d]/g,"");
  b = b.substr(0,b.length -1);
  if (tandaPemisahTitik(b)!=""){
    ini.value = tandaPemisahTitik(b);
  } else {
    ini.value = "";
  }

  return false;
} else if (e.keyCode==9){
  return true;
} else if (e.keyCode==17){
  return true;
} else {
//alert (e.keyCode);
return false;
}

}
</script>
