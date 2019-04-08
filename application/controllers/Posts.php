<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Posts extends BaseController{

	public function __construct(){
		parent::__construct();
	}

	public function index($offset = 0){	

		$this->maintenance_redirection();

		// Pagination Config	
		$config['base_url'] = base_url() . 'posts/index/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');

		// Init Pagination
		$this->pagination->initialize($config);

		$data['title']		= 'Discussions';
		$data['subtitle']	= 'Toutes les discussions';

		$data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug = NULL){
		$data['post'] = $this->post_model->get_posts($slug);
		$post_id = $data['post']['id'];
		$data['comments'] = $this->comment_model->get_comments($post_id);

		if(empty($data['post'])){
			show_404();
		}

		$data['title'] = $data['post']['title'];

		$this->load->view('templates/header');
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}

	public function create(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['title'] = 'Nouvelle discussion';
		$data['subtitle'] = 'Rédaction';
		$data['categories'] = $this->post_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('posts/create', $data);
			$this->load->view('templates/footer');
		} else {
			
			// Upload Image
			$config['upload_path']		= './assets/images/posts';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= '2048';
			$config['max_width']		= '2000';
			$config['max_height']		= '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload()){
				$errors	= array('error'	=> $this->upload->display_errors()
							   );
				
				$post_image = 'noimage.jpg';
				
			} else {
				
				$data = array('upload_data'	=> $this->upload->data()
							 );
				
				$post_image = $_FILES['userfile']['name'];
			}

			// Xss clean to avoid script hacks
			$title 			= $this->security->xss_clean($this->input->post('title'));
			$author			= $this->session->userdata('username');
			$slug			= convert_accented_characters(url_title($this->security->xss_clean($this->input->post('title'))));
			$body			= $this->security->xss_clean($this->input->post('body'));
			$category_id	= $this->security->xss_clean($this->input->post('category_id'));
			$user_id		= $this->session->userdata('user_id');

			// Table with the post data sent to database
			$postInfo = array('title'		=> $title,
                		  	  'author'		=> $author,
						  	  'slug'		=> convert_accented_characters(url_title($slug)),
						  	  'body'		=> $body,
						  	  'category_id'	=> $category_id,
						  	  'user_id'		=> $user_id,
						  	  'post_image'	=> $post_image
						 	 );
			
			$this->post_model->create_post($postInfo);

			// Set message
			$this->session->set_flashdata('post_created', 'Votre nouvelle discussion est lancée!');

			redirect('posts');
		}
	}

	public function delete($id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->post_model->delete_post($id);

		// Set message
		$this->session->set_flashdata('post_deleted', 'Votre discussion a été supprimée!');

		redirect('posts');
	}

	public function edit($slug){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['post'] = $this->post_model->get_posts($slug);

		// Check user
		if(($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']) and (!$this->session->userdata('admin_role'))){

			redirect('posts');

		}

		$data['categories'] = $this->post_model->get_categories();

		if(empty($data['post'])){
			show_404();
		}

		$data['title'] = 'Modifier une discussion';

		$this->load->view('templates/header');
		$this->load->view('posts/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->post_model->update_post();

		// Set message
		$this->session->set_flashdata('post_updated', 'Votre discussion a été mise à jour!');

		redirect('posts');
	}
	
	public function moderation($offset = 0){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		//Check if admin	
		} else if (!$this->session->userdata('admin_role')){
			redirect('categories/index'); 
		}
		
		$data['title']		= 'Discussions';
		$data['subtitle']	= 'Modération';
		
		
		// Pagination Config	
		$config['base_url'] = base_url() . 'posts/index/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');

		// Init Pagination
		$this->pagination->initialize($config);

		$data['posts'] = $this->post_model->get_posts_to_validate(FALSE, $config['per_page'], $offset);

		$this->load->view('templates/header');
		$this->load->view('posts/moderation', $data);
		$this->load->view('templates/footer');
	}
	
	public function validate($id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}
		
		$this->post_model->validatePost(1,$id);	
		// Set message
		$this->session->set_flashdata('post_validated', 'Discussion validée et publiée!');
		redirect('posts/moderation');
	}

}