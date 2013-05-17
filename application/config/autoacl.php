<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Maximum number of segments that Ar-acl should check
$config['segment_max']	= 3;

// variable session role id
$config['sess_role_var'] = "level";

// default role: this role will applied if there is no role found
$config['default_role'] = "User";

// Page that need to be controlled
$config['page_control'] = array(
    'config/' => array(             //==== config section           
        'allowed'    => array(1, 2),                
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'config/rule/edit_config_rule_modal/' => array( 
        'allowed'    => array(1),                
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/rule/hapus_rule/' => array(          
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/rule/config_rule_modal/' => array(          
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/user/' => array(                     
        'allowed'    => array(1, 2),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/user/add_user/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/user/hapus_user/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/user/edit_user/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/user/add_user_modal/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/user/edit_user_modal/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/modem/edit_config_modem_modal/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/modem/add_modem/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'config/modem/config_modem_modal/' => array(                     
        'allowed'    => array(1),             
        'error_uri'  => base_url().'dashboard',  
        'error_msg'  => "config_view_fail",
    ),
	'filter/' => array(  //==== filter section
        'allowed'    => array(1, 2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'filter/add_filter_modal/' => array(  
        'allowed'    => array(1),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'filter/add_filter/' => array(  
        'allowed'    => array(1),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'filter/hapus_filter/' => array(  
        'allowed'    => array(1),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'filter/switch_status/' => array(  
        'allowed'    => array(1),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/edit_system_label/' => array( // =========  label section  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/edit_additional_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/edit_additional_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/add_additional_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/add_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/edit_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'label/hapus_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'dashboard_data/hapus_label/' => array(  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/tambah_address/' => array( // address section  
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/update_address/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/hapus_address/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/tambah_address/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/add_address/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/set_blacklist/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'address/un_blacklist/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),

	'dashboard_data/mark_spam/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),
	'dashboard_data/compose_sms/' => array(   
        'allowed'    => array(1,2),            
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    ),

);

// Page that need The Very Private Page (VPP) access control
$config['vpp_control'] = array(
    'confog/' => array(                       
        'allowed'    => array(1, 2),          
        'vpp_sess_name'        => 'user_id',  
        'vpp_key'        => 4,          
        'error_uri'  => base_url().'dashboard', 
        'error_msg'  => "config_view_fail",
    )
    //'test/profile/edit/' => array(                       // the "module/controller/method/" to protect
        //'allowed'    => array(0, 1),                    // the allowed user role_id array (e.g. user role is 0, Admin role is 1)
        //'vpp_sess_name'        => 'user_id',          // variable session key for Very Private Page (VPP)
        //'vpp_key'        => 4,          // number of segment in the uri that contain the information about vpp_sess_name (e.g. user_id)
        //'error_uri'  => '/staticpage/error_auth',  // the url to redirect to on failure
        //'error_msg'  => "acl_view_profile_denied",
    //),
    //'salary/personal/' => array(                       // the "module/controller/method/" to protect
        //'allowed'    => array(0, 1),                    // the allowed user role_id array (e.g. user role is 0, Admin role is 1)
        //'vpp_sess_name'        => 'user_id',          // variable session key for Very Private Page (VPP)
        //'vpp_key'        => 3,          // number of segment in the uri that contain the information about vpp_sess_name (e.g. user_id)
        //'error_uri'  => '/staticpage/error_auth',  // the url to redirect to on failure
        //'error_msg'  => "acl_view_salary_denied",
    //),
    //'profile/edit/' => array(                       // the "module/controller/method/" to protect
        //'allowed'    => array(0, 1),                    // the allowed user role_id array (e.g. user role is 0, Admin role is 1)
        //'vpp_sess_name'        => 'user_id',          // variable session key for Very Private Page (VPP)
        //'vpp_key'        => 3,          // number of segment in the uri that contain the information about vpp_sess_name (e.g. user_id)
        //'error_uri'  => '/staticpage/error_auth',  // the url to redirect to on failure
        //'error_msg'  => "acl_view_profile_denied",
    //),
);


/* End of file autoacl.php */
/* Location: ./system/application/config/autoacl.php */
