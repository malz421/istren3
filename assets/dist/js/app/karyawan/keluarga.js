var tablekeluarga;
$(document).ready(function () {
  var nipkaryawan = $("#nipkaryawan").val();
  ajaxcsrf();
  tablekeluarga = $("#keluarga").DataTable({
    initComplete: function () {
      var api = this.api();
      $("#keluarga_filter input")
        .off(".DT")
        .on("keyup.DT", function (e) {
          api.search(this.value).draw();
        });
    },
    searching: false,
    lengthChange: false,
    dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        extend: "copy",
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: "print",
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: "excel",
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: "pdf",
        exportOptions: {
          columns: [1, 2, 3]
        }
      }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "kepegawaian/Karyawan/datajsonkeluarga/" + nipkaryawan,
      type: "POST"
    },
    columns: [{
        data: "id_keluarga",
        orderable: false,
        searchable: false
      },
      {
        data: "id_keluarga",
        orderable: false,
        searchable: false
      },
      {
        data: "nik_hubungan",
        render: function (data, type, row, meta) {
          if (data == null) {
            return ``;
          } else {
            return `${data}`;
          }
        }
      },
      {
        data: "nama_keluarga"
      },
      {
        data: "tgl_lahir"
      },
      {
        data: "tgl_lahir",
        render: function (data, type, row, meta) {
          var today = new Date();
          var birthday = new Date(data);
          var year = 0;
          if (today.getMonth() < birthday.getMonth()) {
            year = 1;
          } else if (
            today.getMonth() == birthday.getMonth() &&
            today.getDate() < birthday.getDate()
          ) {
            year = 1;
          }
          var age = today.getFullYear() - birthday.getFullYear() - year;

          if (age < 0) {
            age = 0;
          }
          return age + " Tahun";
        }
      },
      {
        data: "jenis_kelamin",
        render: function (data, type, row, meta) {
          if (data == "P") {
            return `Perempuan`;
          } else {
            return `Laki-laki`;
          }
        }
      },
      {
        data: "namahubungan"
      },
      {
        data: "namapendidikan"
      },
      {
        data: "namapekerjaan"
      }
    ],
    columnDefs: [{
      targets: 0,
      data: "id_keluarga",
      render: function (data, type, row, meta) {
        return `<div class="text-center">
                                  <a data-href="${base_url}kepegawaian/karyawan/lihat_keluarga/${data}" class="btn btn-xs btn-info modaldetailkeluarga">
                                      <i class="fa fa-eye "></i>
                                  </a>
                                  <a data-href="${base_url}kepegawaian/karyawan/ubah_keluarga/${data}"class="btn btn-xs btn-warning modaleditkeluarga">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  <a  data-id=${data} data-toggle="tooltip" class="btn btn-xs btn-danger hapus-keluarga">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </div>`;
      }
    }],

    order: [
      [3, "asc"]
    ],
    rowId: function (a) {
      return a;
    },
    rowCallback: function (row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(1)", row).html(index);
    }
  });
  tablekeluarga
    .buttons()
    .container()
    .appendTo("#karyawan_wrapper .col-md-12:eq(0)");

  $(".select_all").on("click", function () {
    if (this.checked) {
      $(".check").each(function () {
        this.checked = true;
        $(".select_all").prop("checked", true);
      });
    } else {
      $(".check").each(function () {
        this.checked = false;
        $(".select_all").prop("checked", false);
      });
    }
  });

  $("#keluarga tbody").on("click", "tr .check", function () {
    var check = $("#keluarga tbody tr .check").length;
    var checked = $("#keluarga tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });
});

// fungsi untuk hapus data
//pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
$("#keluarga").on("click", ".hapus-keluarga", function () {
  let idkel = $(this).data("id");
  swal({
    title: "Konfirmasi",
    text: "Anda ingin menghapus ",
    type: "question",

    showCancelButton: true,
    cancelButtonText: "Tidak",
    confirmButtonText: "Hapus",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33"
  }).then(result => {
    if (result.value) {
      $.ajax({
        url: base_url + "kepegawaian/karyawan/hapus_keluarga/" + idkel,
        method: "get",
        beforeSend: function () {
          swal({
            title: "Menunggu",
            html: "Memproses data",
            onOpen: () => {
              swal.showLoading();
            }
          });
        },
        data: {
          idkel: idkel
        },
        success: function (respon) {
          if (respon.status) {
            Swal({
              title: "Berhasil",
              text: "Data berhasil dihapus",
              type: "success"
            });
          } else {
            Swal({
              title: "Gagal",
              text: "Data gagal dihapus",
              type: "error"
            });
          }
          tablekeluarga.ajax.reload(null, false);
        },
        error: function () {
          Swal({
            title: "Gagal",
            text: "Kesalahan Sistem",
            type: "error"
          });
        }
      });
    }
  });
});

$("#keluarga").on("click", ".modaleditkeluarga", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalkeluarga").modal({
      backdrop: 'static'
    });
  });
});

$("#keluarga").on("click", ".modaldetailkeluarga", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalkeluarga").modal({
       backdrop: 'static'
    });
  });
});

$(".modaladdkeluarga").on("click", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalkeluarga").modal({
       backdrop: 'static'
    });
  });
});

