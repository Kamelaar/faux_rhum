<?php
	class User_model extends CI_Model{
		public function register($userInfo){
			$this->db->insert('users', $userInfo);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			
			$this->db->select('*');
        	$this->db->from('users');
        	$this->db->where('username', $username);
			$query = $this->db->get();
			
			$userInfo = $query->row();
        
			if(!empty($userInfo)){
				if(password_verify($password, $userInfo->password)){
					return $userInfo;
				} else {
					return array();
				}
			} else {
				return array();
			}
			
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
            
			if(empty($query->row_array())){
                
				return true;
                
			} else {
                
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
            
			if(empty($query->row_array())){
                
				return true;
                
			} else {
                
				return false;
                
			}
		}
        
        // Getting a user profile
        public function get_profile($user_id){
            $this->db->select('id, name, zipcode, email, username, register_date');
            $this->db->from('users');
            $this->db->where('id', $user_id);
            $query = $this->db->get();
        
        return $query->row();
		}
        
        // Update a user profile
        public function update_profile(){
			$data = array(
				'name' => $this->input->post('name'),
				'zipcode' => $this->input->post('zipcode'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username')
			);

			$this->db->where('id', $this->input->post('id'));
            
        return $this->db->update('users', $data);
		}
		
		// Delete a user profile
        public function delete_profile($user_id){
            
        return $this->db->delete('users', array('id' => $user_id));
		}
        
        
        /**
        * This function is used to get the user roles information
        * @return array $result : This is result of the query
        */
        function getUserRole($user_id){
            $this->db->select('role_id');
            $this->db->from('users');
            $this->db->where('id', $user_id); 
            $query = $this->db->get();

        return $query->row();  
        }
        
        // Returns the number of members
        function getMembersCount(){
            $this->db->select('*');
            $this->db->from('users'); 
            $query = $this->db->get();

        return $query->num_rows();
        }
        
        // Returns the most active members
        function getMembersActivity(){
            $this->db->select('COUNT(user_id), author');
            $this->db->from('posts');
            $this->db->group_by('author');
            $this->db->limit(3);
            $this->db->order_by('COUNT(user_id) DESC');
            $query = $this->db->get();

        return $query->result_array();
        }
        
        // Getting the data of all the members
        public function getMembers(){
            $this->db->select('*');
            $this->db->from('users');
            $query = $this->db->get();
        
        return $query->result_array();
		}
        
        public function updateMember(){

			$data = array(
				'name' => $this->input->post('name'),
				'zipcode' => $this->input->post('zipcode'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username')
			);

			$this->db->where('id', $this->input->post('id'));
            
        return $this->db->update('users', $data);
		}
		
		public function deleteMember($user_id){

		return $this->db->delete('users', array('id' => $user_id));
		}
        
        /**
         * This function used to save login information of user
         * @param array $loginInfo : This is users login information
         */
        function lastLogin($loginInfo){
            $this->db->trans_start();
            $this->db->insert('login_history', $loginInfo);
            $this->db->trans_complete();
        }

        /**
         * This function is used to get last login info by user id
         * @param number $userId : This is user id
         * @return number $result : This is query result
         */
        function lastLoginInfo($userId){
            $this->db->select('createdDtm');
            $this->db->where('userId', $userId);
            $this->db->order_by('id', 'desc');
            $this->db->limit(1);
            $query = $this->db->get();

            return $query->row();
        }
        
        // Getting the login history of all members
        public function getLoginHistory($userId){
            $this->db->select('*');
            $this->db->from('login_history');
            $this->db->where('userId', $userId);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
        
        return $query->result_array();
		}

        
	}