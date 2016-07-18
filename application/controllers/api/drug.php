<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Drug extends REST_Controller {

	function tes(){
		$user_info = $this->Drugs_model->getUserInfo($this->get('key'));
		$qwe = $user_info[0]['r_limit'];
		echo($qwe);
	}

	function ndc_get(){
		if(!$this->get('code')){
			$this->response(array( 'status' => "Invalid FDA NDC Code" ), 400);
		}
		elseif (!$this->get('key')) {
			$this->response(array( 'status' => "Invalid User Key" ), 400);
		}
		else {
			$this->load->model('Drugs_model');
			$user_info = $this->Drugs_model->getUserInfo($this->get('key'));
			$drug_info = $this->Drugs_model->getDrugsWithFdaNdcCodeLike($this->get('code'));
			$get_request = $user_info[0]['request'];
			$get_limit = $user_info[0]['r_limit'];
			if($get_request < $get_limit){
				if(!empty($drug_info)){
					$data['request'] = $get_request + 1;
					$this->Drugs_model->updateUserRequest($this->get('key'), $data);
					$this->response($drug_info, 200);
				} else {
					$this->response(array( 'status' => "Invalid FDA NDC Code" ), 406); // need to change response formate
				}
			}
			else{
				$this->response(array( 'status' => "Invalid Request Limit" ), 400);
			}
		}
	}

	function diagnosis_get(){
		if(!$this->get('code')){
			$this->response(array( 'status' => "Invalid ICD9 Diagnosis Code" ), 400);
		}
		elseif (!$this->get('key')) {
			$this->response(array( 'status' => "Invalid User Key" ), 400);
		}
		else {
			$this->load->model('Drugs_model');
			$user_info = $this->Drugs_model->getUserInfo($this->get('key'));
			$drug_info = $this->Drugs_model->getDrugsWithDiagnosisCodeLike($this->get('code'));
			$get_request = $user_info[0]['request'];
			$get_limit = $user_info[0]['r_limit'];
			if($get_request < $get_limit){
				if(!empty($drug_info)){
					$data['request'] = $get_request + 1;
					$this->Drugs_model->updateUserRequest($this->get('key'), $data);
					$this->response($drug_info, 200);
				} else {
					$this->response(array( 'status' => "Invalid ICD9 Diagnosis Code" ), 406); // need to change response formate
				}
			}
			else{
				$this->response(array( 'status' => "Invalid Request Limit" ), 400);
			}
		}
	}

	function procedure_get(){
		if(!$this->get('code')){
			$this->response(array( 'status' => "Invalid Procedure Code" ), 400);
		}
		elseif (!$this->get('key')) {
			$this->response(array( 'status' => "Invalid User Key" ), 400);
		}
		else {
			$this->load->model('Drugs_model');
			$user_info = $this->Drugs_model->getUserInfo($this->get('key'));
			$drug_info = $this->Drugs_model->getDrugsWithProcedureCodeLike($this->get('code'));
			$get_request = $user_info[0]['request'];
			$get_limit = $user_info[0]['r_limit'];
			if($get_request < $get_limit){
				if(!empty($drug_info)){
					$data['request'] = $get_request + 1;
					$this->Drugs_model->updateUserRequest($this->get('key'), $data);
					$this->response($drug_info, 200);
				} else {
					$this->response(array( 'status' => "Invalid Procedure Code" ), 406); // need to change response formate
				}
			}
			else{
				$this->response(array( 'status' => "Invalid Request Limit" ), 400);
			}
		}
	}

	function brand_get(){
		if(!$this->get('name')){ // if param null
			$this->response(array( 'status' => "Invalid Brand Name" ), 400);
		}
		elseif (!$this->get('key')) {
			$this->response(array( 'status' => "Invalid User Key" ), 400);
		}
		else {
			$this->load->model('Drugs_model');
			$user_info = $this->Drugs_model->getUserInfo($this->get('key'));
			$drug_info = $this->Drugs_model->getDrugsWithBrandLike($this->get('name'));
			$get_request = $user_info[0]['request'];
			$get_limit = $user_info[0]['r_limit'];
			if($get_request < $get_limit){
				if(!empty($drug_info)){
					$data['request'] = $get_request + 1;
					$this->Drugs_model->updateUserRequest($this->get('key'), $data);
					$this->response($drug_info, 200);
				} else {
					$this->response(array( 'status' => "Brand Name Not Found" ), 406); // need to change response formate
				}
			}
			else{
				$this->response(array( 'status' => "Invalid Request Limit" ), 400);
			}
		}
	}

	function generic_get(){
		if(!$this->get('name')){
			$this->response(array( 'status' => "Invalid Generic Name" ), 400);
		}
		elseif (!$this->get('key')) {
			$this->response(array( 'status' => "Invalid User Key" ), 400);
		}
		else {
			$this->load->model('Drugs_model');
			$user_info = $this->Drugs_model->getUserInfo($this->get('key'));
			$drug_info = $this->Drugs_model->getDrugsWithGenericNameLike($this->get('name'));
			$get_request = $user_info[0]['request'];
			$get_limit = $user_info[0]['r_limit'];
			if($get_request < $get_limit){
				if(!empty($drug_info)){
					$data['request'] = $get_request + 1;
					$this->Drugs_model->updateUserRequest($this->get('key'), $data);
					$this->response($drug_info, 200);
				} else {
					$this->response(array( 'status' => "Generic Name Not Found" ), 406); // need to change response formate
				}
			}
			else{
				$this->response(array( 'status' => "Invalid Request Limit" ), 400);
			}
		}
	}
}
