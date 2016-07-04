<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Med extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Drugs_model');
        $this->load->model('User_model');
	}
	
	public function index(){
		if ($this->input->cookie('_dailymed') != NULL || $this->input->cookie('_dailymed') != "") {
			$data['email'] = $this->input->cookie('_dailymed');
			
			// get user's status
			$result = $this->User_model->getUser($data['email']);
			$data['key'] = $result[0]['user_key'];
			$data['req'] = $result[0]['request'];
		} else {
			$data['email'] = ""; 
			$data['key'] = ""; 
			$data['req'] = "";
		}
		
		$data['message'] = "";
		
		$this->load->view('index', $data);
	}
	
	public function register(){
		if ($this->input->cookie('_dailymed') != NULL || $this->input->cookie('_dailymed') != "") {
			$data['email'] = $this->input->cookie('_dailymed');
			
			// get user's status
			$result = $this->User_model->getUser($data['email']);
			$data['key'] = $result[0]['user_key'];
			$data['req'] = $result[0]['request'];
		} else {
			$data['email'] = ""; 
			$data['key'] = ""; 
			$data['req'] = "";
		}
		
		$data['message'] = "";
		
		// register button on click
		if ($this->input->post('register')){
			// get information from form view
			$data['new_email'] = $this->input->post('new_email');
			$data['new_password'] = $this->input->post('new_password');
		
			if ($this->User_model->isEmailExist($this->input->post('new_email'))){
				// email exist already, please enter different email
				
				$data['message'] = "<script>alert('Oops, email already registered. Perhaps you want to login?');</script>";
				$this->load->view('index', $data);
			} else {
				// okay, trying to insert new user
				
				if ($this->User_Model->insertUser($this->input->post('new_email'), $this->input->post('new_password'))){
					
					// yay!! insert is successful
					
					$data['message'] = "<script>alert('Register successed');</script>";
					
					// set session
					$cookie = array('name' => '_dailymed', 'value' => $data['new_email'], 'expire' => 0 ); // expire when browser closed
					set_cookie($cookie);
					
					// get user's status
					$data['email'] = $data['new_email'];
					$result = $this->User_model->getUser($data['email']);
					$data['key'] = $result[0]['user_key'];
					$data['req'] = $result[0]['request'];
				} else {
					// nope, no, no, insert failed
					
					$data['email'] = "";
					$data['message'] = "<script>alert('Register failed');</script>";
				}	
			}
		}
		
		$this->load->view('index', $data);
	}
	
	public function login(){
		if ($this->input->cookie('_dailymed') != NULL || $this->input->cookie('_dailymed') != "") {
			$data['email'] = $this->input->cookie('_dailymed');
			
			// get user's status
			$result = $this->User_model->getUser($data['email']);
			$data['key'] = $result[0]['user_key'];
			$data['req'] = $result[0]['request'];
		} else {
			$data['email'] = ""; 
			$data['key'] = ""; 
			$data['req'] = "";
		}
		
		$data['message'] = "";
		
		// if button LOGIN is pressed
		if ($this->input->post('login', TRUE)) {
			// clear cookies automatically if you clicks login button
			delete_cookie('_dailymed'); 
			
			// take user's input from form
			$data['email'] = $this->input->post('email', TRUE);
			$data['password'] = $this->input->post('password', TRUE);
			
			// cek kesesuaian email dan password
			
			$result = $this->User_model->getAllUser();
			
			$adaDiDatabase = 0;
			
			for ($i = 0; $i < count($result); $i++){
				
				// if email found in database
				if ($data['email'] == $result[$i]['email']) {
					
					// if password is correct
					if ($data['password'] == $result[$i]['password']) $adaDiDatabase = 1;
					
					// nope, password incorrect
					else {
						$data['message'] = "<script>alert('Incorrect password');</script>";
					}
					
					break;
				} 
				
				// email not found in database, sorry!
				else {
					$data['message'] = "<script>alert('Matching email not found');</script>";
				}
			}
			
			if ($adaDiDatabase){
				// set session
				$cookie = array('name' => '_dailymed', 'value' => $data['email'], 'expire' => 0 ); // expire when browser closed
				set_cookie($cookie);
				
				// logged in successfully
				$data['message'] = "";
				
				// get user's status
				$result = $this->User_model->getUser($data['email']);
				$data['key'] = $result[0]['user_key'];
				$data['req'] = $result[0]['request'];
			} else {
				$data['email'] = "";
			}
		}
		
		$this->load->view('index', $data);
	}
}
