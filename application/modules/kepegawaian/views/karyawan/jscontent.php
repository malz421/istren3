

<!--load select2-->
<script>
  $(function () {
    $(".select2").select2();
  });
</script>

<script>
    $('#datepicker').datepicker({
      autoclose: true
    });
	$('#datepicker2').datepicker({
      autoclose: true

    });

	$('#datepickeluarga').datepicker({
      autoclose: true
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

<script type="text/javascript">
var table;
$(document).ready(function() {
  ajaxcsrf();

  table = $("#karyawan").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#karyawan_filter input")
        .off(".DT")
        .on("keyup.DT", function(e) {
          api.search(this.value).draw();
        });
    },
    dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: "copy",
        exportOptions: { columns: [1,2,3] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1,2,3] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1,2,3] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1,2,3] }
      }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "kepegawaian/Karyawan/data",
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
      {data: "photo_profile",
        "searchable": false,
        "orderable":false,
        "render": function(data, type, row, meta)
        {

             return `<img src="${base_url}storage/photo/karyawan/avatar.jpg" style='align:center' height="60px" width="60px"">`
        }
      },
      { data: "nip_karyawan"},
      { data: "nik_karyawan",
        "render": function(data, type, row, meta) {
          if ( data == null){
             return ``
          }
          else
          {
            return  `${data}`
          }
        }
      },
      { data: "nama_karyawan"},
      { data: "nama_lembaga"},
       { data: "unit_kerja",
        "render": function(data, type, row, meta) {
          if ( data == null){
             return ``
          }
          else
          {
            return  `${data}`
          }
        }
      },
      { data: "jenis_kelamin",
        "render": function(data, type, row, meta) {
          if ( data =='P'){
             return `Perempuan`
          }
          else
          {
            return  `Laki-laki`
          }
        }
      },
      { data: "id_karyawan",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                                <a href="${base_url}kepegawaian/karyawan/detail_karyawan/${data}" class="btn btn-xs btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="${base_url}kepegawaian/karyawan/ubah_karyawan/${data}" class="btn btn-xs btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#modalHapus${data}" data-toggle="modal"  data-toggle="tooltip" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>`;
        }
      }

    ],
    columnDefs: [
      {
        targets:0,
        data: "id_karyawan",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								  </div>`;
        }
      }
    ],
    order: [[3, "asc"]],
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
table
    .buttons()
    .container()
    .appendTo("#karyawan_wrapper .col-md-6:eq(0)");

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

  $("#karyawan tbody").on("click", "tr .check", function() {
    var check = $("#karyawan tbody tr .check").length;
    var checked = $("#karyawan tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });
});
</script>

<script type="text/javascript">
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
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

<!-- FUNGSI UMUR -->
<script>
function getAge() {
	var date = document.getElementById('birthday').value;
	if(date === ""){
		alert("Please complete the required field!");
    }else{
		var today = new Date();
		var birthday = new Date(date);
		var year = 0;
		if (today.getMonth() < birthday.getMonth()) {
			year = 1;
		} else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
			year = 1;
		}
		var age = today.getFullYear() - birthday.getFullYear() - year;

		if(age < 0){
			age = 0;
		}
		document.getElementById('result').innerHTML = age;
	}
}
</script>

<script>
  $(function () { 
    var idkaryawan = document.getElementById('idkaryawan').value;
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month'
      },
      buttonText: {
        today: 'today',
        month: 'month'
      },
      //Random default events
      events: base_url + "kepegawaian/Karyawan/datajsonabsen/"+ idkaryawan,
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
    })

    $('.fc-next-button').click(function(){
    var get_month= $('#calendar').fullCalendar('getDate');
    alert(get_month.format('YMM'));
    })

    $('.fc-prev-button').click(function(){
      var get_month= $('#calendar').fullCalendar('getDate');
      alert(get_month.format('YMM'));
      })

  })

  $(function () { 
    var idkaryawan = document.getElementById('idkaryawan').value;
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendarpola').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month'
      },
      buttonText: {
        today: 'today',
        month: 'month'
      },
      //Random default events
      events: base_url + "kepegawaian/Karyawan/datajsonabsenpola/"+ idkaryawan  ,
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
    })



  })

  function reload_ajax()
{
    table.ajax.reload(null, false);
    tablekeluarga.ajax.reload(null, false);
    tablependidikan.ajax.reload(null, false);
    tablejabatan.ajax.reload(null, false);
    tableriwayat.ajax.reload(null, false);
    tablediklat.ajax.reload(null, false);
    tableseminar.ajax.reload(null, false);

}

function reloadkeluarga_ajax()
{
    tablekeluarga.ajax.reload(null, false);
}

function reloadpendidikan_ajax()
{
    tablependidikan.ajax.reload(null, false);
}

function reloadjabatan_ajax()
{
    tablejabatan.ajax.reload(null, false);
}

function reloadriwayat_ajax()
{
    tableriwayat.ajax.reload(null, false);
}

function reloaddiklat_ajax()
{
    tablediklat.ajax.reload(null, false);
}

function reloadseminar_ajax()
{
    tableseminar.ajax.reload(null, false);
}

</script>


<script type="text/javascript">
  $('.printBtn').on('click', function (){
    window.print();
  });
</script>

<script type="text/javascript">
	function Angkasaja(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	return true;
	}
</script>






<script>
  var openFile = function(event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('output');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>

<!-- dropzone -->

<script type="text/javascript">
Dropzone.autoDiscover = false;

var id_karyawan=$('#id_karyawan').val();
var foto_upload= new Dropzone(".dropzone",{
sending: function (file, xhr, formData) {
    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
},
url: "<?php echo base_url('kepegawaian/karyawan/proses_upload') ?>",
params: {'idkaryawan':id_karyawan},
maxFiles: 2,
maxFilesize: 2,
method:"post",
acceptedFiles:"image/*",
paramName:"userfile",
dictInvalidFileType:"Type file ini tidak dizinkan",
addRemoveLinks:true,
});


//Event ketika Memulai mengupload
foto_upload.on("sending",function(a,b,c){
  a.token=Math.random();
  c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
});


//Event ketika foto dihapus
foto_upload.on("removedfile",function(a){
  var token=a.token;
  $.ajax({
    type:"post",
    data:{token:token},
    url:"<?php echo base_url('index.php/upload/remove_foto') ?>",
    cache:false,
    dataType: 'json',
    success: function(){
      console.log("Foto terhapus");
    },
    error: function(){
      console.log("Error");

    }
  });
});
</script>