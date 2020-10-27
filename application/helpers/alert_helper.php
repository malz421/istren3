<?php
  function sukses($message = '')
  {
    $CI =& get_instance();
    return $CI->session->set_flashdata("msg", "<div id='notifikasi' class='alert alert-block alert-success fade in'><button data-dismiss='alert' class='close' type='button'>×</button><h4 class='alert-heading'><i class='fa fa-check'></i> Success!</h4><p> $message </p></div>");
  }

  function gagal($message = '')
  {
    $CI =& get_instance();
    return $CI->session->set_flashdata("msg", "<div id='notifikasi' class='alert alert-block alert-danger fade in'><button data-dismiss='alert' class='close' type='button'>×</button><h4 class='alert-heading'><i class='fa fa-times'></i> Error!</h4><p> $message </p></div>");
  }
  
  function warning($message = '')
  {
    $CI =& get_instance();
    return $CI->session->set_flashdata("msg", "<div id='notifikasi' class='alert alert-block alert-warning fade in'><button data-dismiss='alert' class='close' type='button'>×</button><h4 class='alert-heading'><i class='fa fa-times'></i> Warning!</h4><p> $message </p></div>");
  }

  function informasi($message = '')
  {
    $CI =& get_instance();
    return "<div id='notifikasi' class='alert alert-block alert-info fade in'><button data-dismiss='alert' class='close' type='button'>×</button><h4 class='alert-heading'><i class='fa fa-info'></i> Info!</h4><p> $message </p></div>";
  }
