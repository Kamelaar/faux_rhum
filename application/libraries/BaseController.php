<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kamel SERKA
 * @version : 1.1
 * @since : 22 october 2018
 */
class BaseController extends CI_Controller {
	protected $role = '';

    /**
    * This function is used to check the access
    */
    function isAdmin() {
        $this->role = $this->session->userdata('role');
        if ($this->role = ROLE_ADMIN) {
            return true;
        } else {
            return false;
        }
    }
	
	public function maintenance_redirection(){
		
		$maintenance = $this->page_model->maintenanceStatus();
		
		if((!$this->session->userdata('logged_in')) and ($maintenance->maintenance_mode == MAINTENANCE_ON)){
			redirect('users/login');
		}
    
	}
	
}
	
