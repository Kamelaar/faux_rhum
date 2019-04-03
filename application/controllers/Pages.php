<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';

class Pages extends CI_Controller {
	      
	public function __construct(){
		parent::__construct();
	}

	public function view($page = 'home'){
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}


		$data['title'] = 'Accueil';
		$data['totalMembers'] = $this->user_model->getMembersCount();

		$data['top3Members'] = $this->user_model->getMembersActivity();
		$data['ranking'] = 1;
		$data['maintenanceStatus']= $this->page_model->maintenanceStatus();

		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}

	//This function is used to set or unset the website in maintenance mode usin GET method
//	public function maintenance($action = '') {
//		if ($action == "on") {
//			$this->page_model->updateMaintenance(1);
//		} 
//
//		else if ($action == "off") {
//			$this->page_model->updateMaintenance(0);
//		}
//	}

	//This function is used to set or unset the website in maintenance mode usin POST method
	public function maintenance() {
		if ($this->session->userdata('admin_role')){
		
			if ($this->input->post('action') == 'on'){
				$this->page_model->updateMaintenance(1);		
			}

			else if ($this->input->post('action') == 'off') {
				$this->page_model->updateMaintenance(0);
			}
			
		}
	}
}