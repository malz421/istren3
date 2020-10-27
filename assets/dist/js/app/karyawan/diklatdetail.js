var tablediklat;
$(document).ready(function () {
  var nipkaryawan = $("#nipkaryawan").val();
  ajaxcsrf();
  tablediklat = $("#diklat").DataTable({
    initComplete: function () {
      var api = this.api();
      $("#diklat_filter input")
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
      url: base_url + "kepegawaian/Diklat/datajson/" + nipkaryawan,
      type: "POST"
    },
    columns: [{
        data: "id_diklat",
        orderable: false,
        searchable: false
      },
      {
        rowId: "id_diklat",
        data: "id_diklat",
        orderable: false,
        searchable: false
      },
      {
        data: "nama_diklat",
        render: function (data, type, row, meta) {
          if (data == null) {
            return ``;
          } else {
            return `${data}`;
          }
        }
      },
      {
        data: "penyelenggara_diklat"
      },
      {
        data: "tempat_diklat"
      },
      {
        data: "tahun_diklat"
      },
      
    ],
    columnDefs: [{
      targets: 0,
      data: "id_diklat",
      render: function (data, type, row, meta) {
        return `<div class="text-center">
                                  <a data-href="${base_url}kepegawaian/Diklat/lihat/${data}" class="btn btn-xs btn-info modaldetaildiklat">
                                      <i class="fa fa-eye "></i>
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
  tablediklat
    .buttons()
    .container()
    .appendTo("#diklat_wrapper .col-md-12:eq(0)");

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

  $("#diklat tbody").on("click", "tr .check", function () {
    var check = $("#diklat tbody tr .check").length;
    var checked = $("#diklat tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });
});

// fungsi untuk hapus data
//pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
$("#diklat").on("click", ".hapus", function () {
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
        url: base_url + "kepegawaian/Diklat/hapus/" + id,
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
          tablediklat.ajax.reload(null, false);
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

$("#diklat").on("click", ".modaleditdiklat", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modaldiklat").modal({
      backdrop: 'static'
    });
  });
});

$("#diklat").on("click", ".modaldetaildiklat", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modaldiklat").modal({
      backdrop: 'static'
    });
  });
});

$(".modaladddiklat").on("click", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modaldiklat").modal({
      backdrop: 'static'
    });
  });
});