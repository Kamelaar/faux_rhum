<?php

class Page_model extends CI_Model{
	
	public function maintenanceStatus(){

		$this->db->select('maintenance_mode');
		$this->db->from('maintenance');
		$this->db->where('id', 1); 
		$query = $this->db->get();

	return $query->row();  
	}
				
	
	public function updateMaintenance($boolean){
		
		$this->db->set('maintenance_mode', $boolean);
		$this->db->where('id', 1);
		$this->db->update('maintenance');
				
	}
	
}
