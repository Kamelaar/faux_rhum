<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Pages extends BaseController {
	      
	public function __construct(){
		parent::__construct();
	}
	
	public function view($page = 'home'){
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}
		
		$this->maintenance_redirection();


		$data['title'] = 'Accueil';
		$data['totalMembers'] = $this->user_model->getMembersCount();

		$data['top3Members'] = $this->user_model->getMembersActivity();
		$data['ranking'] = 1;
		$data['maintenanceStatus']= $this->page_model->maintenanceStatus();
		$data['lastDiscussions'] = 'Dernières discussions';
		$data['posts'] = $this->post_model->get_last_posts();

		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}
	
	public function maintenance_check(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		//Check if admin	
		} else if (!$this->session->userdata('admin_role')){
			redirect('categories/index'); 
		}
		
		$data['title']= 'Maintenance';
		$data['subtitle']= 'Activation / Désactivation';
		$data['maintenanceStatus']= $this->page_model->maintenanceStatus();

		$this->load->view('templates/header');
		$this->load->view('pages/maintenance', $data);
		$this->load->view('templates/footer');
		
	}


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
	
	public function maintenance_mode(){
        if(file_exists(APPPATH.'config/config.php')){
            include(APPPATH.'config/config.php'); 
			
            if((isset($config['maintenance_mode']) && $config['maintenance_mode'] == MAINTENANCE_ON)){
				
                return 1;
				
			}else{
				
				return 0;
            }
        }
    }
	
	public function about(){
		$data['title']= 'Qui sommes-nous?';
		$data['subtitle']= 'En savoir plus sur le Faux Rhum';

		$this->load->view('templates/header');
		$this->load->view('pages/about', $data);
		$this->load->view('templates/footer');
		
	}
	
	public function contact(){
		$data['title']= 'Contact';
		$data['subtitle']= 'Questions / Suggestions';

		$this->load->view('templates/header');
		$this->load->view('pages/contact', $data);
		$this->load->view('templates/footer');
		
	}
	
	public function user_charter(){
		$data['title']= 'Charte d\'utilisation';
		$data['subtitle']= 'Le code de bonne conduite';

		$this->load->view('templates/header');
		$this->load->view('pages/user_charter', $data);
		$this->load->view('templates/footer');
		
	}
	
}