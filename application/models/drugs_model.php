<?php

Class Drugs_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**
	* Get all drugs from database
	*
	* @return
	*/
    public function getAllDrugs(){
        // what fields to get
		$this->db->select('code_fda_ndc as FDA NDC Code, name_brand as Brand, name_generic as Generic Name, company as Drug Company,
		code_diagnosis as ICD9 Diagnosis Code, desc_dx as Diagnosis Form, code_proc as Procedure Code, desc_proc as Procedure Form');

		// the tables and their nickname
		$this->db->from('drugs');

        return $this->db->get()->result_array();
	}

	/**
	* Get drugs with FDA NDC code like %param%
	*
	* @param String $param
	*
	* @return
	*/
	public function getDrugsWithFdaNdcCodeLike($param){
		// what fields to get
		$this->db->select('code_fda_ndc as FDA NDC Code, name_brand as Brand, name_generic as Generic Name, company as Drug Company,
		code_diagnosis as ICD9 Diagnosis Code, desc_dx as Diagnosis Form, code_proc as Procedure Code, desc_proc as Procedure Form');

		// additional conditions
		$this->db->where('code_fda_ndc', $param);

		// the tables and their nickname
		$this->db->from('drugs');

        return $this->db->get()->result_array();
    }

	/**
	* Get drugs with brand like %param%
	*
	* @param String $param
	*
	* @return
	*/
	public function getDrugsWithBrandLike($param){
		// what fields to get
		$this->db->select('code_fda_ndc as FDA NDC Code, name_brand as Brand, name_generic as Generic Name, company as Drug Company,
		code_diagnosis as ICD9 Diagnosis Code, desc_dx as Diagnosis Form, code_proc as Procedure Code, desc_proc as Procedure Form');

		// additional conditions
		$this->db->where("name_brand LIKE '%$param%'");

		// the tables and their nickname
		$this->db->from('drugs');

        return $this->db->get()->result_array();
    }

    /**
	* Get drugs with generic name like %param%
	*
	* @param String $param
	*
	* @return
	*/
	public function getDrugsWithGenericNameLike($param){
		// what fields to get
		$this->db->select('code_fda_ndc as FDA NDC Code, name_brand as Brand, name_generic as Generic Name, company as Drug Company,
		code_diagnosis as ICD9 Diagnosis Code, desc_dx as Diagnosis Form, code_proc as Procedure Code, desc_proc as Procedure Form');

		// additional conditions
		$this->db->where("name_generic LIKE '%$param%'");

		// the tables and their nickname
		$this->db->from('drugs');

        return $this->db->get()->result_array();
    }

	/**
	* Get drugs with diagnosis code like %param%
	*
	* @param int $param
	*
	* @return
	*/
	public function getDrugsWithDiagnosisCodeLike($param){
		// what fields to get
		$this->db->select('code_fda_ndc as FDA NDC Code, name_brand as Brand, name_generic as Generic Name, company as Drug Company,
		code_diagnosis as ICD9 Diagnosis Code, desc_dx as Diagnosis Form, code_proc as Procedure Code, desc_proc as Procedure Form');

		// additional conditions
		$this->db->where('code_diagnosis', $param);

		// the tables and their nickname
		$this->db->from('drugs');

        return $this->db->get()->result_array();
    }

    /**
	* Get drugs with procedure code like %param%
	*
	* @param int $param
	*
	* @return
	*/
	public function getDrugsWithProcedureCodeLike($param){
		// what fields to get
		$this->db->select('code_fda_ndc as FDA NDC Code, name_brand as Brand, name_generic as Generic Name, company as Drug Company,
		code_diagnosis as ICD9 Diagnosis Code, desc_dx as Diagnosis Form, code_proc as Procedure Code, desc_proc as Procedure Form');

		// additional conditions
		$this->db->where('code_proc', $param);

		// the tables and their nickname
		$this->db->from('drugs');

        return $this->db->get()->result_array();
    }


//	MICHAEL

	public function updateUserRequest($key, $data){
		$this->db->where('user_key', $key);
		$this->db->update('user', $data);
	}

	public function getUserInfo($key){
		$this->db->select('request, r_limit');
		$this->db->where('user_key', $key);
		$this->db->from('user');
        return $this->db->get()->result_array();
	}

}

?>
