
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ISTREN | INFORMASI SISTEM PESANTREN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
	<link rel="icon" type="image/png" href="<?php echo base_url('login/images/icons/favicon.ico'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login/vendor/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login/vendor/animate/animate.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/util.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login/css/main.css'); ?>">

</head>
<body>


	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url('assets/images/bg.jpg'); ?>');">
			<div class="wrap-login100 p-t-100 p-b-30">
				<form action="<?php echo base_url('kepegawaian/login/cek_user') ?>" method="post" class="login100-form validate-form">
					<!--<div class="login100-form-avatar">
						<img src="<?php echo base_url('assets/images/almatuq.png'); ?>" alt="AVATAR">
					</div>-->

					<div class="login100-form-avatar">
						<img src="<?php echo base_url('assets/images/almatuq.png'); ?>" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						SISTEM INFORMASI KEPEGAWAIAN
					</span>

					<span align="center"><?php echo $this->session->flashdata('status_login'); ?></span>

					<div class="wrap-input100 validate-input m-b-10">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10">
						<input class="input100" type="password" name="password" placeholder="Password"  required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">

						<p style+><center>Copyright <?php echo '2019' ?> by IT AL-MA'TUQ <br/> All Right Reserved. Version 1.1</center></p>
					</div>

				</form>
			</div>
		</div>
	</div>

    <script src="<?php echo base_url('login/vendor/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('login/vendor/bootstrap/js/popper.js'); ?>"></script>
    <script src="<?php echo base_url('login/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('login/js/main.js'); ?>"></script>

</body>
</html>

