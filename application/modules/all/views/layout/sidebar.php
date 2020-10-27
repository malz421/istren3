<!-- Left side column. contains the logo and sidebar -->
<?php if ($this->session->userdata('level')<>'ADMINISTRASI'){?>
<aside class="main-sidebar">
<section class="sidebar">
   <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/images/almatuq.png') ?>" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>PESANTREN AL-MA'TUQ</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
   </div>
  <ul class="sidebar-menu" data-widget="tree">
   <?php
		// data main menu
		$idrole=  $this->session->userdata('level');
		$this->db->order_by('menu.parent_id,menu.menu_order');
		$this->db->select('menu.`icon`,menu.`id` as id_menu,menu.`parent_id`,menu_akses.`id_role`,menu.`menu_order`,menu.`nama_menu`, menu.`url`,COALESCE(getnamamenu(menu.parent_id),"< parent >")as parent_menu,
          ,trim(menu_akses.`id`)as id,IF(menu_akses.`id` IS NOT NULL, 1, 0)AS tampil,COALESCE(menu_akses.`flag_tambah`,0,1)AS tambah,COALESCE(menu_akses.`flag_ubah`,0,1)AS ubah,COALESCE(menu_akses.`flag_hapus`,0,1)AS hapus');
		$this->db->from('menu');
		$this->db->where('menu_akses.id_role = "'.$idrole.'"');
		$this->db->where('status=1');
		$this->db->where('menu_akses.`parent_id`=0');
		$this->db->join('menu_akses','menu.id=menu_akses.id_menu');
		$main_menu = $this->db->get();
		foreach ($main_menu->result() as $main) {
			// Query untuk mencari data sub menu
			$this->db->order_by('menu.parent_id,menu.menu_order');
			$this->db->select('menu.`icon`,menu.`id` as id_menu,menu.`parent_id`,menu_akses.`id_role`,menu.`menu_order`,menu.`nama_menu`, menu.`url`,COALESCE(getnamamenu(menu.parent_id),"< parent >")as parent_menu,
			,trim(menu_akses.`id`)as id,IF(menu_akses.`id` IS NOT NULL, 1, 0)AS tampil,COALESCE(menu_akses.`flag_tambah`,0,1)AS tambah,COALESCE(menu_akses.`flag_ubah`,0,1)AS ubah,COALESCE(menu_akses.`flag_hapus`,0,1)AS hapus');
			$this->db->from('menu');
			$this->db->where('menu_akses.id_role ='.$main->id_role.'');
			$this->db->where('status=1');
			$this->db->where('menu_akses.`parent_id` = '.$main->id_menu.'');
			$this->db->join('menu_akses','menu.id=menu_akses.id_menu');
			$sub_menu = $this->db->get();
			// periksa apakah ada sub menu
			if ($sub_menu->num_rows() > 0) {
				// main menu dengan sub menu
				echo "<li class='treeview'>" . anchor($main->url, '<i class="' . $main->icon . '"></i><span>' . $main->nama_menu .'</span>
						<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
						</span>');
				// sub menu nya disini
				echo "<ul class='treeview-menu'>";
				foreach ($sub_menu->result() as $sub) {
					echo "<li>" . anchor($sub->url, '<i class="' . $sub->icon . '"></i>' . $sub->nama_menu) . "</li>";
				}
				echo"</ul></li>";
			} else {
				// main menu tanpa sub menu
				echo "<li>" . anchor($main->url, '<i class="' . $main->icon . '"></i><span>' . $main->nama_menu) . "</span></li>";
			}
		}
	?>
    <!--<?php
		// data main menu
		$this->db->order_by('parent_id,menu_order');
		$main_menu = $this->db->get_where('menu_aplikasi', array('parent_id' => 0,'status' => 1));
		foreach ($main_menu->result() as $main) {
			// Query untuk mencari data sub menu
			$this->db->order_by('menu_order');
			$sub_menu = $this->db->get_where('menu_aplikasi', array('parent_id' => $main->id ));
			// periksa apakah ada sub menu
			if ($sub_menu->num_rows() > 0) {
				// main menu dengan sub menu
				echo "<li class='treeview'>" . anchor($main->url, '<i class="' . $main->icon . '"></i><span>' . $main->nama_menu .'</span>
						<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
						</span>');
				// sub menu nya disini
				echo "<ul class='treeview-menu'>";
				foreach ($sub_menu->result() as $sub) {
					echo "<li>" . anchor($sub->url, '<i class="' . $sub->icon . '"></i>' . $sub->nama_menu) . "</li>";
				}
				echo"</ul></li>";
			} else {
				// main menu tanpa sub menu
				echo "<li>" . anchor($main->url, '<i class="' . $main->icon . '"></i><span>' . $main->nama_menu) . "</span></li>";
			}
		}
	?>-->
  </ul>
</section>
<!-- /.sidebar -->
</aside>
<!-- /.main-sidebar-->
<?php
}?>
  
  
   