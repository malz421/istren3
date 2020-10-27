<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar ">
<section class="sidebar">

 <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/images/avatar.jpg') ?>" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('namauser') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
   </div>
<ul class="sidebar-menu tree" data-widget="tree">
	<li><a href="<?php echo base_url() . 'all/user_page'; ?>">
			<i class="fa fa-dashboard active"></i>
			<span>Dashboard</span>
		</a>
	</li>


        <li class="treeview active">
          <a href="#">
            <i class="fa fa-list-alt"></i> <span>Absensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu display: none; ">
            <li><a href="<?php echo base_url() . 'all/user_page'; ?>"><i class="fa fa-circle-o"></i>Data Absensi</a></li>
            <li><a href="<?php echo base_url() . 'all/user_page'; ?>"><i class="fa fa-circle-o"></i>Lembur</a></li>
            <li><a href="<?php echo base_url() . 'all/user_page'; ?>"><i class="fa fa-circle-o"></i>Ijin/Cuti/Tugas</a></li>
          </ul>
		</li>
		
    <li><a href="<?php echo base_url() . 'all/user_page'; ?>">
        <i class="fa fa-file-text-o"></i>
        <span style="padding-right: 50px;white-space: normal;">Informasi Klaim / Reimbursement</span>
      </a>
    </li>

    <li><a href="<?php echo base_url() . 'all/user_page'; ?>">
        <i class="fa fa-edit  "></i>
        <span>Pengajuan</span>
      </a>
    </li>
    
    
    <li><a href="<?php echo base_url() . 'all/user_page'; ?>">
        <i class="fa fa-money"></i>
        <span>Informasi Mukafaah</span>
      </a>
    </li>
       
     

</ul>

</section>
<!-- /.sidebar -->
</aside>
<!-- /.main-sidebar-->

  
  
   