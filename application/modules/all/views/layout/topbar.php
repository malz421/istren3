<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('all/admin_page') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-lg" style="height:65px;"><img src="<?php echo base_url('assets/images/logo-text.png') ?>" style="height:100%" alt="Brand Logo">
	  </span>
      <span class="logo-mini" style="height:40px;">
          <img src="<?php echo base_url('assets/images/istren-icon.png') ?>"  style="height:100%" alt="User Image">
	  </span>


    </a>


    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
				  <img src="<?php echo base_url('assets/images/avatar.jpg') ?>"class="user-image" alt="User Image">
				  <span class="hidden-xs"><?php echo $this->session->userdata('namauser') ?></span>
				</a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                   <a href="<?php echo base_url().'all/pengguna/edit_profile/'.$this->session->userdata('idpengguna'); ?>" class="btn btn-default btn-flat">Profile</a>

                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url().'all/login/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
</header>





