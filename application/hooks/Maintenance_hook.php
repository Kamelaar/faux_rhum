<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Check whether the site is offline or not.
 *
 */
class Maintenance_hook
{
    public function __construct(){
        log_message('debug','Accessing maintenance hook!');
    }
    
    public function offline_check(){
        if(file_exists(APPPATH.'config/config.php')){
            include(APPPATH.'config/config.php');
            
			//the admin or developper IP adress
			$authorized_ip_address = '127.0.0.1'; 
			
            if((isset($config['maintenance_mode']) && $config['maintenance_mode'] == MAINTENANCE_ON) and (!isset($_SERVER['REMOTE_ADDR']) || $_SERVER['REMOTE_ADDR'] != $authorized_ip_address)){
                include(APPPATH.'views/maintenance.php');
                exit;
            }
        }
    }
}