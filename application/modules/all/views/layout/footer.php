  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1
    </div>
    <strong>Copyright &copy; 2019 <a href="http://istren.com">ISTREN</a>.</strong> All rights
    reserved.<strong>Powered by IT Development AL-MA'TUQ</strong>.
  </footer>
</div>
<!-- ./wrapper -->
<?php
$this->load->view($js);
$this->load->view($jscontent);
?>

<script type="text/javascript">
  $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
    return {
      "iStart": oSettings._iDisplayStart,
      "iEnd": oSettings.fnDisplayEnd(),
      "iLength": oSettings._iDisplayLength,
      "iTotal": oSettings.fnRecordsTotal(),
      "iFilteredTotal": oSettings.fnRecordsDisplay(),
      "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
  };

  function ajaxcsrf() {
    var csrfname = '<?=$this->security->get_csrf_token_name()?>';
    var csrfhash = '<?=$this->security->get_csrf_hash()?>';
    var csrf = {};
    csrf[csrfname] = csrfhash;
    $.ajaxSetup({
      "data": csrf
    });
  }

  function reload_ajax() {
    table.ajax.reload(null, false);
  }
</script>


</body>
</html>
