<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Drug extends REST_Controller {

	function ndc_get(){
		if(!$this->get('code')){
			$this->response(array( 'status' => "Invalid FDA NDC Code" ), 400);
		} else {
			$this->load->model('Drugs_model');
			$drug_info = $this->Drugs_model->getDrugsWithFdaNdcCodeLike($this->get('code'));
			
			if(!empty($drug_info)){
				$this->response($drug_info, 200);
			} else {
				$this->response(array( 'status' => "Invalid FDA NDC Code" ), 406); // need to change response formate
			}
		}		
	}
	
	function diagnosis_get(){
		if(!$this->get('code')){
			$this->response(array( 'status' => "Invalid ICD9 Diagnosis Code" ), 400);
		} else {
			$this->load->model('Drugs_model');
			$drug_info = $this->Drugs_model->getDrugsWithDiagnosisCodeLike($this->get('code'));
			
			if(!empty($drug_info)){
				$this->response($drug_info, 200);
			} else {
				$this->response(array( 'status' => "Invalid ICD9 Diagnosis Code" ), 406); // need to change response formate
			}
		}		
	}
	
	function procedure_get(){
		if(!$this->get('code')){
			$this->response(array( 'status' => "Invalid Procedure Code" ), 400);
		} else {
			$this->load->model('Drugs_model');
			$drug_info = $this->Drugs_model->getDrugsWithProcedureCodeLike($this->get('code'));
			
			if(!empty($drug_info)){
				$this->response($drug_info, 200);
			} else {
				$this->response(array( 'status' => "Invalid Procedure Code" ), 406); // need to change response formate
			}
		}		
	}
	
	function brand_get(){
		if(!$this->get('name')){ // if param null
			$this->response(array( 'status' => "Invalid Brand Name" ), 400);
		} else {
			$this->load->model('Drugs_model');
			$drug_info = $this->Drugs_model->getDrugsWithBrandLike($this->get('name'));
			
			if(!empty($drug_info)){
				$this->response($drug_info, 200);
			} else { // if results not found
				$this->response(array( 'status' => "Brand Name Not Found" ), 406); // need to change response formate
			}
		}		
	}
	
	function generic_get(){
		if(!$this->get('name')){
			$this->response(array( 'status' => "Invalid Generic Name" ), 400);
		} else {
			$this->load->model('Drugs_model');
			$drug_info = $this->Drugs_model->getDrugsWithGenericNameLike($this->get('name'));
			
			if(!empty($drug_info)){
				$this->response($drug_info, 200);
			} else {
				$this->response(array( 'status' => "Generic Name Not Found" ), 406); // need to change response formate
			}
		}		
	}
}
