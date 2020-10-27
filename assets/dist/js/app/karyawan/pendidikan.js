var tablependidikan;
$(document).ready(function () {
  var nipkaryawan = $("#nipkaryawan").val();
  ajaxcsrf();
  tablependidikan = $("#pendidikan").DataTable({
    initComplete: function () {
      var api = this.api();
      $("#pendidikan_filter input")
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
      url: base_url + "kepegawaian/Pendidikan/datajsonpendidikan/" + nipkaryawan,
      type: "POST"
    },
    columns: [{
        data: "id_sekolah",
        orderable: false,
        searchable: false
      },
      {
        data: "id_sekolah",
        orderable: false,
        searchable: false
      },
      {
        data: "namapendidikan",
        render: function (data, type, row, meta) {
          if (data == null) {
            return ``;
          } else {
            return `${data}`;
          }
        }
      },
      {
        data: "jurusan"
      },
      {
        data: "nama_sekolah"
      },
      {
        data: "tahun_masuk"
      },
      {
        data: "tahun_lulus"
      },
      {
        data: "keterangan_sekolah"
      },
    ],
    columnDefs: [{
      targets: 0,
      data: "id_sekolah",
      render: function (data, type, row, meta) {
        return `<div class="text-center">
                                  <a data-href="${base_url}kepegawaian/Pendidikan/lihat_pendidikan/${data}" class="btn btn-xs btn-info modaldetailpendidikan">
                                      <i class="fa fa-eye "></i>
                                  </a>
                                  <a data-href="${base_url}kepegawaian/Pendidikan/ubah_pendidikan/${data}"class="btn btn-xs btn-warning modaleditpendidikan">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  <a  data-id=${data} data-toggle="tooltip" class="btn btn-xs btn-danger hapus-pendidikan">
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
  tablependidikan
    .buttons()
    .container()
    .appendTo("#pendidikan_wrapper .col-md-12:eq(0)");

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

  $("#pendidikan tbody").on("click", "tr .check", function () {
    var check = $("#pendidikan tbody tr .check").length;
    var checked = $("#pendidikan tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });
});

// fungsi untuk hapus data
//pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
$("#pendidikan").on("click", ".hapus-pendidikan", function () {
  let idpend = $(this).data("id");
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
        url: base_url + "kepegawaian/Pendidikan/hapus_pendidikan/" + idpend,
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
          idpend: idpend
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
          tablependidikan.ajax.reload(null, false);
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

$("#pendidikan").on("click", ".modaleditpendidikan", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalpendidikan").modal({
      show: true
    });
  });
});

$("#pendidikan").on("click", ".modaldetailpendidikan", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalpendidikan").modal({
      backdrop: 'static'
    });
  });
});

$(".modaladdpendidikan").on("click", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalpendidikan").modal({
      backdrop: 'static'
    });
  });
});