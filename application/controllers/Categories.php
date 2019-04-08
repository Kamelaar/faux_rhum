<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Categories extends BaseController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
		$this->maintenance_redirection();
		
		$data['title'] = 'Catégories';
		$data['subtitle'] = 'Toutes les catégories';

		$data['categories'] = $this->category_model->get_categories();

		$this->load->view('templates/header');
		$this->load->view('categories/index', $data);
		$this->load->view('templates/footer');
	}

	public function create(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		//Check if admin	
		} else if (!$this->session->userdata('admin_role')){
			redirect('categories/index'); 
		}

		$data['title'] = 'Catégories';
		$data['subtitle'] = 'Création / Suppression';

		$data['categories'] = $this->category_model->get_categories();

		$this->form_validation->set_rules('category_name', 'Name', 'required|is_unique[categories.name]',
										  array('is_unique' => 'Catégorie déjà existante!'));

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('categories/create', $data);
			$this->load->view('templates/footer');

		} else {
			
			$category_name		= $this->security->xss_clean($this->input->post('category_name'));
			$creator 			= $this->session->userdata('username');
			$creator_user_id 	= $this->session->userdata('user_id');
			
			// Table with category sent to the database
			$categoryInfo = array('name'		=> $category_name,
								  'user_id'		=> $creator_user_id,
								  'created_by'	=> $creator);
			
			$this->category_model->create_category($categoryInfo);

			// Set message
			$this->session->set_flashdata('category_created', 'Nouvelle catégorie créée!');

			redirect('categories/create');
		}
	}

	public function posts($id){
		$data['title'] = $this->category_model->get_category($id)->name;
		$data['subtitle'] = 'Les discussions de la catégorie';
		$data['posts'] = $this->post_model->get_posts_by_category($id);

		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->category_model->delete_category($id);

		// Set message
		$this->session->set_flashdata('category_deleted', 'Catégorie supprimée');

		redirect('categories/create');
	}
}