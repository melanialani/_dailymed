<?php

Class User_Model extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    /**
	* Get all user from database
	* 
	* @return
	*/
    public function getAllUser(){
        return $this->db->get('user')->result_array();
	}
	
	public function getUser($email){
        // what fields to get
		$this->db->select('user_key, request');
		
		// additional conditions
		$this->db->where('email', $email);
		
		// the tables and their nickname
		$this->db->from('user');
		
        return $this->db->get()->result_array();
	}
	
	/**
	* Is email exist already
	* 
	* @param string $email
	* 
	* @return
	*/
	public function isEmailExist($email){
		
		$isExist = FALSE;
		
		$allUser = $this->getAllUser();
		
		for ($i = 0; $i < count($allUser); $i++){
			if ($allUser[$i]['email'] == $email){
				$isExist = TRUE;
				break;
			}
		}
		
		return $isExist;
	}
	
	/**
	* Insert User
	* 
	* @param string $email
	* @param string $password
	* 
	* @return
	*/
	public function insertUser($email, $password){
		$key = md5($email);
		
        $myArr = array(
        	'email' => $email,
        	'password' => $password,
        	'user_key' => $key
        );
        
        $this->db->insert('user', $myArr);
        
        return $this->db->affected_rows();
	}
}
?>