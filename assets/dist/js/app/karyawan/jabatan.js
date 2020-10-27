var tablejabatan;
$(document).ready(function () {
  var nipkaryawan = $("#nipkaryawan").val();
  ajaxcsrf();
  tablejabatan = $("#jabatan").DataTable({
    initComplete: function () {
      var api = this.api();
      $("#jabatan_filter input")
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
      url: base_url + "kepegawaian/Jabatan/datajson/" + nipkaryawan,
      type: "POST"
    },
    columns: [{
        data: "id_jabatan_karyawan",
        orderable: false,
        searchable: false
      },
      {
        rowId: "id_jabatan_karyawan",
        data: "id_jabatan_karyawan",
        orderable: false,
        searchable: false
      },
      {
        data: "namajabatan",
        render: function (data, type, row, meta) {
          if (data == null) {
            return ``;
          } else {
            return `${data}`;
          }
        }
      },
      {
        data: "no_sk"
      },
      {
        data: "tgl_sk"
      },
      {
        data: "tmt_jabatan"
      },
      
    ],
    columnDefs: [{
      targets: 0,
      data: "id_jabatan_karyawan",
      render: function (data, type, row, meta) {
        return `<div class="text-center">
                                  <a data-href="${base_url}kepegawaian/Jabatan/lihat/${data}" class="btn btn-xs btn-info modaldetailjabatan">
                                      <i class="fa fa-eye "></i>
                                  </a>
                                  <a data-href="${base_url}kepegawaian/Jabatan/ubah/${data}"class="btn btn-xs btn-warning modaleditjabatan">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  <a  data-id=${data} data-toggle="tooltip" class="btn btn-xs btn-danger hapus">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </div>`;
      }
    }],

    order: [
      [4, "asc"]
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
  tablejabatan
    .buttons()
    .container()
    .appendTo("#jabatan_wrapper .col-md-12:eq(0)");

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

  $("#jabatan tbody").on("click", "tr .check", function () {
    var check = $("#jabatan tbody tr .check").length;
    var checked = $("#jabatan tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });
  });

// fungsi untuk hapus data
//pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
$("#jabatan").on("click", ".hapus", function () {
  let id = $(this).data("id");
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
        url: base_url + "kepegawaian/Jabatan/hapus/" + id,
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
          id: id
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
          tablejabatan.ajax.reload(null, false);
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

$("#jabatan").on("click", ".modaleditjabatan", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modaljabatan").modal({
      backdrop: 'static'
    });
  });
});

$("#jabatan").on("click", ".modaldetailjabatan", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modaljabatan").modal({
      backdrop: 'static'
    });
  });
});

$(".modaladdjabatan").on("click", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modaljabatan").modal({
      backdrop: 'static'
    });
  });
});