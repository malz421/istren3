

<script>
function goBack() {
  window.history.go(-1);
}
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

</script>

<!---REKAP ABSEN PER KARYAWAN END -->







