<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_menu extends CI_Model{
 
    function carousel_list (){
        $hasil=$this->db->query("SELECT * FROM carousel");
        if($hasil->num_rows()>0){
			foreach($hasil->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
    }

    function carousel_count (){
        $hasil=$this->db->query("SELECT COUNT(*) jml FROM carousel");       
        if($hasil->num_rows()>0){
            foreach ($hasil->result() as $data) {
                $hasil=array(
                    'jmlgambar' => $data->jml,
                    );
            }
        }
        return $hasil;
    }
 

   
}