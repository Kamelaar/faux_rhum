<?php
class Post_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
		if($limit){
			$this->db->limit($limit, $offset);
		}
		if($slug === FALSE){
			$this->db->order_by('posts.created_at', 'DESC');
			$this->db->where('validated', 1);
			$this->db->join('categories', 'categories.id = posts.category_id');
			$query = $this->db->get('posts');
			return $query->result_array();
		}

		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->row_array();
	}
	
	//Get the 3 last posts to display on the homepage
	public function get_last_posts(){
		$this->db->order_by('posts.created_at', 'DESC');
		$this->db->where('validated', 1);
		$this->db->join('categories', 'categories.id = posts.category_id');
		$this->db->limit(3);
		$query = $this->db->get('posts');
		return $query->result_array();
	}

	public function create_post($postInfo){
		$this->db->insert('posts', $postInfo);
	}

	public function delete_post($id){
		$image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
		
		// save the current working directory
		$cwd = getcwd(); 
		
		$image_file_path = $cwd."\\assets\\images\\posts\\";
		chdir($image_file_path);
		unlink($image_file_name);
		
		// Restore the previous working directory
		chdir($cwd);
		
		$this->db->where('id', $id);
		$this->db->delete('posts');
		return true;
	}

	public function update_post(){
		$slug = convert_accented_characters(url_title($this->input->post('title')));

		$data = array(	'title'			=> $this->input->post('title'),
						'slug'			=> $slug,
						'body'			=> $this->input->post('body'),
						'category_id'	=> $this->input->post('category_id'));

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('posts', $data);
	}

	public function get_categories(){
		$this->db->order_by('name');
		$query = $this->db->get('categories');
		return $query->result_array();
	}

	public function get_posts_by_category($category_id){
		$this->db->order_by('posts.id', 'DESC');
		$this->db->join('categories', 'categories.id = posts.category_id');
		$query = $this->db->get_where('posts', array('category_id' => $category_id));
		return $query->result_array();
	}
	
	//Get all the posts of the user to display on activity page
	public function get_user_posts($user_id){
		$this->db->order_by('posts.id', 'DESC');
		$this->db->where('posts.user_id', $user_id);
		$this->db->join('categories', 'categories.id = posts.category_id');
		$query = $this->db->get('posts');
		return $query->result_array();
	}
	
	//Get posts waiting for moderation
	public function get_posts_to_validate($limit = FALSE, $offset = FALSE){
		if($limit){
			$this->db->limit($limit, $offset);
		}
		$this->db->select('posts.id 			as id, 
						  posts.category_id 	as category_id, 
						  posts.author 			as author, 
						  posts.title 			as title,
						  posts.slug			as slug,
						  posts.body 			as body, 
						  posts.post_image 		as post_image, 
						  posts.created_at 		as created_at, 
						  categories.id 		as id_category,
						  categories.name		as name');
		$this->db->order_by('posts.id', 'ASC');
		$this->db->where('posts.validated', 0);
		$this->db->join('categories', 'categories.id = posts.category_id');
		$query = $this->db->get('posts');
		return $query->result_array();
	}
	
	public function validatePost($boolean,$id){
		$data = array('validated' => $boolean);
		$this->db->where('id', $id);
		$this->db->update('posts', $data);
	}
}