<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Comments extends BaseController{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->maintenance_redirection();
	}

	public function create($post_id){
		$slug			= $this->input->post('slug');
		$data['post']	= $this->post_model->get_posts($slug);

		$this->form_validation->set_rules('body', 'Body', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		} else {
			
			$author			= $this->session->userdata('username');
			$comment		= $this->security->xss_clean($this->input->post('body'));
			
			$commentInfo	= array('post_id'	=> $post_id,
								    'name'		=> $author,
								    'body'		=> $comment
								   );
			
			$this->comment_model->create_comment($commentInfo);
			
			// Set message
			$this->session->set_flashdata('comment_sent', 'Votre commentaire à été envoyé et sera validé dans les plus brefs délais!');
			redirect('posts/'.$slug);
		}
	}
	
	public function moderation(){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		//Check if admin	
		} else if (!$this->session->userdata('admin_role')){
			redirect('categories/index'); 
		}
		
		$data['title']		= 'Commentaires';
		$data['subtitle']	= 'Modération';
		$data['comment']	= $this->comment_model->getCommentsToValidate();


		$this->load->view('templates/header');
		$this->load->view('comments/moderation', $data);
		$this->load->view('templates/footer');
	}
	
	public function validate($id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}
		
		$this->comment_model->validateComment(1,$id);	
		// Set message
		$this->session->set_flashdata('comment_validated', 'Commentaire validé et publié!');
		redirect('comments/moderation');
	}
	
	public function unvalidate($id){
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}
		
		$this->comment_model->deleteComment($id);	
		// Set message
		$this->session->set_flashdata('comment_unvalidated', 'Commentaire invalidé et supprimé!');
		redirect('comments/moderation');
	}
	
		
}