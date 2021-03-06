<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Users extends BaseController{
        
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->maintenance_redirection();
		profile();
	}

	// Register user
	public function register(){
		
		$this->maintenance_redirection();
		
		$data['title'] = 'Inscription';

		$this->form_validation->set_rules('name', 'Nom', 'required', 
										  array('required' => 'Vous n\'avez pas saisi de nom!'));
		
		$this->form_validation->set_rules('username', 'Pseudo', 'required|callback_check_username_exists', 
										  array('required' => 'Vous n\'avez pas saisi de pseudo!'));
		
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists', 
										  array('required' => 'Vous n\'avez pas saisi d\'email!'));
		
		$this->form_validation->set_rules('zipcode', 'Code postal', 'required', 
										  array('required' => 'Vous n\'avez pas saisi de code postal!'));
		
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[8]',
										  array('required' => 'Vous n\'avez pas saisi de mot de passe!',
											   	'min_length' => 'Le mot de passe doit faire au moins 8 caractères!'
											   ));
		
		$this->form_validation->set_rules('password2', 'Confirmation du mot passe', 'matches[password]', 
										  array('required' => 'Vous n\'avez pas confirmé vore mot de passe!'));

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/register', $data);
			$this->load->view('templates/footer');
		} else {
			//Xss clean to avoid script hacks
			$name		= $this->security->xss_clean($this->input->post('name'));
			$username	= $this->security->xss_clean($this->input->post('username')); 
			$email		= $this->security->xss_clean($this->input->post('email'));
			$zipcode	= $this->security->xss_clean($this->input->post('zipcode'));
			$password	= $this->input->post('password');									
			
			//table with user data sent to database
			$userInfo = array('name'		=> $name,
							  'username'	=> $username,
							  'email'		=> $email,
							  'zipcode'		=> $zipcode,
							  //Password hash
							  'password'	=> password_hash($password, PASSWORD_BCRYPT)
							 );
			
			//function with the userInfo table to register user
			$this->user_model->register($userInfo);

			// Set message
			$this->session->set_flashdata('user_registered', 'Vous êtes désormais membre du Faux Rhum, vous pouvez vous connecter!');

			redirect('users/login');
		}
	}
	

	// Log in user
	public function login(){
		
		// Redirecting if already logged
		if($this->session->userdata('logged_in')){

			$this->session->set_flashdata('user_allready_loggedIn', 'Vous êtes déjà connecté!');

			redirect('posts');
		}
		
		$maintenance = $this->page_model->maintenanceStatus();
		
		$data['title'] = 'Loguez-vous!';

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer');
		} else {
			
			// Xss clean to avoid script hacks
			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->input->post('password');

			// Login user
			$userInfo = $this->user_model->login($username, $password);
	

			if($userInfo){
				$user_id	= $userInfo->id;
				$username	= $userInfo->username;

				$row = $this->user_model->getUserRole($user_id);
				$role = $row -> role_id;

				if($role == 1){
					// Create session
					$user_data = array('user_id'	=> $user_id,
									   'username'	=> $username,
									   'logged_in'	=> true,
									   'admin_role'	=> true
									  );
					
					$this->session->set_userdata($user_data);

					//Storing the members login history
					$loginInfo = array("userId"			=> $user_id, 
									   "sessionData"	=> json_encode($user_data), 
									   "machineIp"		=> $_SERVER['REMOTE_ADDR'], 
									   "userAgent"		=> $this->getBrowserAgent(), 
									   "agentString"	=> $this->agent->agent_string(), 
									   "platform"		=> $this->agent->platform()
									  );

					$this->user_model->lastLogin($loginInfo);

					$this->session->set_flashdata('user_loggedin', 'Connexion réussie!');

					redirect('home');

				} else if ($maintenance->maintenance_mode == MAINTENANCE_ON){
						// Set message
						$this->session->set_flashdata('maintenance_mode', 'Le Faux Rhum est en maintenance, nous vous prions de nous excuser pour le désagrément, nous serons de retour très rapidement...');

						redirect('users/login');
					}else {

					// Create session
					$user_data = array('user_id'	=> $user_id,
									   'username'	=> $username,
									   'logged_in'	=> true
									  );

					$this->session->set_userdata($user_data);

					//Storing the members login history
					$loginInfo = array("userId"			=> $user_id, 
									   "sessionData"	=> json_encode($user_data), 
									   "machineIp"		=> $_SERVER['REMOTE_ADDR'], 
									   "userAgent"		=> $this->getBrowserAgent(), 
									   "agentString"	=> $this->agent->agent_string(), 
									   "platform"		=> $this->agent->platform()
									  );

					$this->user_model->lastLogin($loginInfo);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'Connexion réussie!');

					redirect('home');
				}


			} else {
				// Set message
				$this->session->set_flashdata('login_failed', 'Echec de connexion!');

				redirect('users/login');
			}		
		}
	}

	// Log user out
	public function logout(){
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('admin_role');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');

		// Set message
		$this->session->set_flashdata('user_loggedout', 'Déconnexion réussie!');

		redirect('users/login');
	}

	// Check if username exists
	public function check_username_exists($username){
		$this->form_validation->set_message('check_username_exists', 'Ce nom d\'utilisateur est indisponible!');
		if($this->user_model->check_username_exists($username)){
			return true;
		} else {
			return false;
		}
	}

	// Check if email exists
	public function check_email_exists($email){
		$this->form_validation->set_message('check_email_exists', 'Cet email est indisponible!');
		if($this->user_model->check_email_exists($email)){
			return true;
		} else {
			return false;
		}
	}

	public function profile(){
		$data['title'] = 'Mon profil';
		$data['subtitle'] = 'Voir / Editer / Supprimer';
		$data['userInfo'] = $this->user_model->get_profile($this->session->userdata('user_id'));

		$this->load->view('templates/header');
		$this->load->view('users/profile', $data);
		$this->load->view('templates/footer');
	}

	public function editMyProfile(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['title'] = 'Mon profil';
		$data['userInfo'] = $this->user_model->get_profile($this->session->userdata('user_id'));

		$this->load->view('templates/header');
		$this->load->view('users/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update_profile(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->user_model->update_profile();

		// Set message
		$this->session->set_flashdata('profile_updated', 'Votre profil a été mis à jour');

		redirect('users/profile');
	}

	public function deleteMyProfile(){
		$this->user_model->delete_profile($this->session->userdata('user_id'));

		$this->session->unset_userdata('logged_in');

		// Set message
		$this->session->set_flashdata('profile_deleted', 'Votre compte a été supprimé!');

		redirect('home');
	}

	// Display all the members
	public function allMembers(){

		if(!$this->session->userdata('logged_in')){
			redirect('users/login');

		} else if (!$this->session->userdata('admin_role')){
			redirect('home'); 
		}

		$data['title']			= 'Membres';
		$data['subtitle']		= 'Gestion des membres';
		$data['all_members']	= $this->user_model->getMembers();

		$this->load->view('templates/header');
		$this->load->view('users/members', $data);
		$this->load->view('templates/footer');
	}

	// Display the member informations to edit them
	public function editMember($user_id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');

		} else if (!$this->session->userdata('admin_role')){
			redirect('home'); 
		}

		$data['title']		= 'Gestion des membres';
		$data['subtitle']	= 'Modifier';
		$data['userInfo']	= $this->user_model->get_profile($user_id);

		$this->load->view('templates/header');
		$this->load->view('users/adminEdit', $data);
		$this->load->view('templates/footer');
	}

	// Update a member data
	public function updateOneMember(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');

		} else if (!$this->session->userdata('admin_role')){
			redirect('home'); 
		}

		$this->user_model->updateMember();

		// Set message
		$this->session->set_flashdata('member_updated', 'Les informations du membre ont été modifiées!');

		redirect('users/allMembers');
	}

	public function deleteAMember($user_id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');

		} else if (!$this->session->userdata('admin_role')){
			redirect('home'); 
		}    

		$this->user_model->deleteMember($user_id);

		// Set message
		$this->session->set_flashdata('member_deleted', 'Le compte a été supprimé!');

		redirect('users/allMembers');
	}

	function getBrowserAgent(){
		
		$CI = get_instance();

		$agent = '';

		if ($CI->agent->is_browser())
		{
			$agent = $CI->agent->browser().' '.$CI->agent->version();
		}
		else if ($CI->agent->is_robot())
		{
			$agent = $CI->agent->robot();
		}
		else if ($CI->agent->is_mobile())
		{
			$agent = $CI->agent->mobile();
		}
		else
		{
			$agent = 'User Agent non identifié!';
		}

		return $agent;
	}

	public function loginHistory($user_id){

		if(!$this->session->userdata('logged_in')){
			redirect('users/login');

		} else if (!$this->session->userdata('admin_role')){
			redirect('home'); 
		}

		$data['userInfo']       = $this->user_model->get_profile($user_id);
		$data['title']          = 'Profil de '. $data['userInfo']->username;

		$data['subtitle']       = 'Historique de connexion';

		$data['login_history']  = $this->user_model->getLoginHistory($user_id);

		$this->load->view('templates/header');
		$this->load->view('users/login_history', $data);
		$this->load->view('templates/footer');
	}
		
	public function dashboard(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');	
		}
		
		$data['title']		= 'Mon activité';
		$data['subtitle']	= 'Tableau de bord';
		$data['h2']			= 'Toutes mes discussions';
		$data['user_posts']	= $this->post_model->get_user_posts($this->session->userdata('user_id'));
			
		$this->load->view('templates/header');
		$this->load->view('users/dashboard', $data);
		$this->load->view('templates/footer');
		
	}
}
