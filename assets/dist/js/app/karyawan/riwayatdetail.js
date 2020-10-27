var tableriwayat;
$(document).ready(function () {
  var nipkaryawan = $("#nipkaryawan").val();
  ajaxcsrf();
  tableriwayat = $("#riwayat").DataTable({
    initComplete: function () {
      var api = this.api();
      $("#riwayat_filter input")
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
      url: base_url + "kepegawaian/Riwayat/datajson/" + nipkaryawan,
      type: "POST"
    },
    columns: [{
        data: "id_kerja",
        orderable: false,
        searchable: false
      },
      {
        rowId: "id_kerja",
        data: "id_kerja",
        orderable: false,
        searchable: false
      },
      {
        data: "nama_perusahaan",
        render: function (data, type, row, meta)
        {
          if (data == null) {
            return ``;
          } else {
            return `${data}`;
          }
        }
      },
      {
        data: "jabatan"
      },
      {
        data: "gaji"
      },
      {
        data: "tahun_awal"
      },
      {
        data: "tahun_akhir"
      },
      
    ],
    columnDefs: [{
      targets: 0,
      data: "id_kerja",
      render: function (data, type, row, meta) {
        return `<div class="text-center">
                    <a data-href="${base_url}kepegawaian/Riwayat/lihat/${data}" class="btn btn-xs btn-info modaldetailriwayat">
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
  tableriwayat
    .buttons()
    .container()
    .appendTo("#riwayat_wrapper .col-md-12:eq(0)");

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

  $("#riwayat tbody").on("click", "tr .check", function () {
    var check = $("#riwayat tbody tr .check").length;
    var checked = $("#riwayat tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });
});

// fungsi untuk hapus data
//pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
$("#riwayat").on("click", ".hapus", function () {
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
        url: base_url + "kepegawaian/Riwayat/hapus/" + id,
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
          tableriwayat.ajax.reload(null, false);
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

$("#riwayat").on("click", ".modaleditriwayat", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalriwayat").modal({
      backdrop: 'static'
    });
  });
});

$("#riwayat").on("click", ".modaldetailriwayat", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalriwayat").modal({
      backdrop: 'static'
    });
  });
});

$(".modaladdriwayat").on("click", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalriwayat").modal({
      backdrop: 'static'
    });
  });
});