<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_log extends CI_Model
  {

    public function save_log($param)
    {
	    $hsl=$this->db->insert('log_user',$param);
		  return $hsl;
    }

}
	
?>
