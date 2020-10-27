<?php
function helper_log($tipe = "", $str = ""){
    $CI =& get_instance();
 
    if (strtolower($tipe) == "login"){
        $log_tipe   = 0;
    }
    elseif(strtolower($tipe) == "logout")
    {
        $log_tipe   = 1;
    }
    elseif(strtolower($tipe) == "add"){
        $log_tipe   = 2;
    }
    elseif(strtolower($tipe) == "edit"){
        $log_tipe  = 3;
    }
	 elseif(strtolower($tipe) == "delete"){
        $log_tipe  = 4;
    }
    else{
        $log_tipe  =5;
    }
 
    // paramter
    $param['log_user']      = $CI->session->userdata('usrname');
	$param['log_app'] 		= $CI->session->userdata('app');
	$param['log_os']		= $CI->session->userdata('osuser');
	$param['log_ip']		= $CI->session->userdata('ipuser');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;
 
    //load model log
    $CI->load->model('m_log');
 
    //save to database
    $CI->m_log->save_log($param);
 }
 ?>