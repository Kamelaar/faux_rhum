<?php
class Comment_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function create_comment($commentInfo){
		$this->db->insert('comments', $commentInfo);
	}

	public function get_comments($post_id){
		$query = $this->db->get_where('comments', array('post_id' 	=> $post_id,
													    'validated' => 1));
		return $query->result_array();
	}

	// Returns the most active members
	function getCommentsToValidate(){
		$this->db->select('id, name, body, created_at, post_id');
		$this->db->from('comments');
		$this->db->where('validated',0);
		$query = $this->db->get();
		
		return $query->result_array();
	}

	public function validateComment($boolean,$id){
		$data = array('validated' => $boolean);
		$this->db->where('id', $id);
		$this->db->update('comments', $data);
	}
	
	public function deleteComment($id){
		$this->db->where('id', $id);
		$this->db->delete('comments');
	}
}