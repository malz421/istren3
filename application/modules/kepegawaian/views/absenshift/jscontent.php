
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
var table;

$(document).ready(function() {
  ajaxcsrf();
  var idlembaga = $('#idlembaga_combo').val();
  var idunitkerja = $('#idunitkerja').val();
  
  table = $("#absenshift").DataTable({
    paging:   false,
    ordering: false,
    scrollY:   "200px",
    scrollCollapse: true,
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "kepegawaian/Absen_shift/data/" + idlembaga + "/" + idunitkerja ,
      type: "POST"
    },
    columns: [
      {
        data: "id_karyawan",
        orderable: false,
        searchable: false
      },
	  {
        data: "id_karyawan",
        orderable: false,
        searchable: false
      },
      { data: "nip_karyawan" },
      { data: "nama_karyawan" }
    ],
    columnDefs: [
      {
        targets:0,
        data: "id_karyawan",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<input name="checkid[]" class="check" value="${data}" type="checkbox">
								</div>`;
        }
      }
    ],
    order: [[2, "asc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(1)", row).html(index);
    }
  });


  $(".select_all").on("click", function() {
    if (this.checked) {
      $(".check").each(function() {
        this.checked = true;
        $(".select_all").prop("checked", true);
      });
    } else {
      $(".check").each(function() {
        this.checked = false;
        $(".select_all").prop("checked", false);
      });
    }
  });

  $("#absenshift tbody").on("click", "tr .check", function() {
    var check = $("#absenshift tbody tr .check").length;
    var checked = $("#absenshift tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });

});

</script>


<script type="text/javascript">
$(document).ready(function(){
  $("#reloadshift").on("submit", function(e) {
    ajaxcsrf();
    
    var btn = $('#submit');
    

    if ($(this).attr("action") == base_url + "kepegawaian/Absen_shift/TampilShift") {
	 
      e.preventDefault();
      e.stopImmediatePropagation();

      var idkaryawan = [];
      var idabsenshift =   $('#idabsenshift').val(); ;
      var tglperiode1 = $('#tglperiode1').val(); ;
      var tglperiode2 = $('#tglperiode2').val();

      $(".check:checked").each(function(){
        idkaryawan.push($(this).val());
      })
      idkaryawan = idkaryawan.toString();

      $.ajax({
      url: $(this).attr("action"),
      data: {idkaryawan: idkaryawan,idabsenshift:idabsenshift,tglperiode1:tglperiode1,tglperiode2:tglperiode2 },
      type: "POST",
      datatype:"html",
      success: function(respon) {
        console.log(respon);
        document.getElementById("datashift").innerHTML = respon;
      
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

//tampil data shift
function reload_shift() {
  if ($("#absenshift tbody tr .check:checked").length == 0) {
    Swal({
      title: "Gagal",
      text: "Tidak ada data yang dipilih",
      type: "error"
    });
  } else {
	  $("#reloadshift").attr("action", base_url + "kepegawaian/Absen_shift/TampilShift");
    $("#reloadshift").submit();
  }
}

</script>



<script type="text/javascript">
$(document).ready(function(){
	$('#idunitkerja').on('change', function(){
		let id_lembaga = $('#idlembaga_combo').val();
		let id_unit = $('#idunitkerja').val();
		let src = '<?=base_url()?>kepegawaian/Absen_shift/data';
		let url;

	   if(id_lembaga !== 'all'){
			let src2 = src + '/' + id_lembaga + '/' + id_unit ;
			url = $(this).prop('checked') === true ? src : src2;
		}
		else if(id_unit !== 'all')
		{
		    let src3 = src2 + '/' + id_unit ;
			url = $(this).prop('checked') === true ? src : src3;
		}
		else{
			url = src;
		}
		table.ajax.url(url).load();
	});

	$('#idlembaga_combo').on('change', function(){
		let id_lembaga = $('#idlembaga_combo').val();
		let id_unit = $('#idunitkerja').val();
		let src = '<?=base_url()?>kepegawaian/Absen_shift/data';
		let url;

	   if(id_lembaga !== 'all'){
			let src2 = src + '/' + id_lembaga + '/' + id_unit ;
			url = $(this).prop('checked') === true ? src : src2;
		}
		else if(id_unit !== 'all')
		{
		    let src3 = src2 + '/' + id_unit ;
			url = $(this).prop('checked') === true ? src : src3;
		}
		else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});


</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#bulk").on("submit", function(e) {
    ajaxcsrf();
    
    var btn = $('#submit');
    btn.attr('disabled', 'disabled').text('Wait...');

    if ($(this).attr("action") == base_url + "kepegawaian/Absen_shift/SimpanShift") {
	 
      e.preventDefault();
      e.stopImmediatePropagation();

      var idkaryawan = [];
      var idabsenshift =   $('#idabsenshift').val(); ;
      var tglperiode1 = $('#tglperiode1').val(); ;
      var tglperiode2 = $('#tglperiode2').val();

				 $(".check:checked").each(function(){
				  idkaryawan.push($(this).val());
				 })

         idkaryawan = idkaryawan.toString();

      $.ajax({
        url: $(this).attr("action"),
        data: {idkaryawan: idkaryawan,idabsenshift:idabsenshift,tglperiode1:tglperiode1,tglperiode2:tglperiode2 },
        type: "POST",
        success: function(respon) {
          btn.removeAttr('disabled').text('Simpan');
          if (respon.status) {
            Swal({
              title: "Berhasil" ,
              text: "Data berhasil disimpan",
              type: "success"
            });
          } else {
            Swal({
              title: "Gagal" ,
              text: "Data gagal disimpan",
              type: "error"
            });
          }
        },
        error: function() {
          btn . removeAttr('disabled') . text('Simpan');
          Swal({
            title: "Gagal" ,
            text: "Ada data yang sedang digunakan",
            type: "error"
          });
        }
      });
    }
  });
});
</script>


<script>

//simpan data shift
  function bulk_simpan() {
  if ($("#absenshift tbody tr .check:checked").length == 0) {
    Swal({
      title: "Gagal",
      text: "Tidak ada data yang dipilih",
      type: "error"
    });
  } else {

	$("#bulk").attr("action", base_url + "kepegawaian/Absen_shift/SimpanShift");
    $("#bulk").submit();
  }
}

function shift_delete(id) {
    Swal({
      title: "Anda yakin?",
      text: "Data akan dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Hapus!"
    }).then(result => {
      if (result.value) {
        ajaxcsrf();

        $.ajax({
        url: base_url + "kepegawaian/Absen_shift/HapusShift/"+ id,
        type: "POST",
        success: function(respon) {
          if (respon.status) {
            Swal({
              title: "Berhasil",
              text:  "Data berhasil dihapus",
              type: "success"
            }).then(function() {
            window.location.href = base_url + "kepegawaian/Absen_shift";
            console.log('The Ok Button was clicked.');
            });
          } else {
            Swal({
              title: "Gagal",
              text: "Tidak ada data yang dipilih",
              type: "error"
            });
          }
          reload_ajax();
        },
        error: function() {
          Swal({
            title: "Gagal",
            text: "Ada data yang sedang digunakan",
            type: "error"
          });
        }
      });
      }
    });
  }

</script>

