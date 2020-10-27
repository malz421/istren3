<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ISTREN | LOGIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/istren-icon.png' ?>">
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/istren-icon.png'); ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bower_components/bootstrap/dist/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bower_components/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/iCheck/square/blue.css' ?>">
<style>
    .login-logo img{
        width: 100%;
        height: 120px;
        object-fit: contain;
    }
    .login-page {

        background-image: url("<?php echo base_url() . 'assets/images/back.png' ?>") !important;
        /*background-position: 50%;*/
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed;
        background-position: center;
    }
    .login-box-body{
        background: transparent;
        border-radius:10px;
        padding: 13px;
        /*box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.25) inset;*/
    }

    .panel-info {
        background: transparent;
        padding: 10px;
    }


    .form-control {
    border-radius: 10px;
    font-size: 15px;
    height: 40px;
    font-weight:bold;
    box-shadow: none;
    border-color: #d2d6de;
    }

    .form-control-feedback{

    color: #999999;
    display: flex;
    align-items: center;
    position: absolute;
    pointer-events: none;

    }
</style>
</head>

<body class="hold-transition login-page">

<div class="login-box">

       <div class="login-logo">
            <img src="<?php echo base_url() . 'assets/images/logo-lengkap.png' ?>" alt="">
        </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <div>
       <p><?php echo $this->session->flashdata('status_login'); ?></p>
    </div>

    <form action="<?php echo base_url() . 'all/login/cek_user' ?>" method="post">
    
     <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
  
 
       <div class="form-group has-feedback">
                 
                  <select class="form-control" name="comborole" id="role">
                    <option value="user">USER</option>
                    <option value="admin">ADMIN</option>
          
                  </select>
                </div>
      <div class="form-group has-feedback">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password"  id="pass" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label style="color:white;">
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat ">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <!-- /.social-auth-links -->
    <hr/>
    <span style="color:white;">
    <p><center>Copyright &copy;<script>document.write(new Date().getFullYear());</script><a href="" target="_blank"></a> ISTREN <br/></center></p>
    </span>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() . 'assets/bower_components/jquery/jquery-3.3.1.min.js' ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() . 'assets/bower_components/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url() . 'assets/plugins/iCheck/icheck.min.js' ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
    $(document).ready(function(){
        $('#username').focus();
        $('#username').attr('placeholder', 'NIP / No Handphone');
         $('#pass').attr('placeholder', 'PIN');
      
       $('#role').on('change', function () {
          var idrole = $('#role').val();
   
         if(idrole == 'admin'){
            $('#username').attr('placeholder', 'Username');
             $('#pass').attr('placeholder', 'Password');
              $('#username').focus();
         }
        else
         {
            $('#username').attr('placeholder', 'NIP / No Handphone');
             $('#pass').attr('placeholder', 'PIN');
              $('#username').focus();
         }
        
         
     });
    });
    
    
    

 </script>

 
</body>
</html>
