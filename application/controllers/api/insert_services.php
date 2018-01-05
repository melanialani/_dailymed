<?php defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Insert_Services extends REST_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->model('insert_model');
    }
    
	// localhost/_webservice/index.php/api/insert_services/operator
	// content type :: application/x-www-form-urlencoded
	// raw body :: id_card=ID001&nik=UK201&nama=test&phone=08123456789&status=1&id_pelanggan=P01
    function operator_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$idCard = $this->post('id_card');
			$nik = $this->post('nik');
			$nama = $this->post('nama');
			$phone = $this->post('phone');
			$status = $this->post('status');
			$idPelanggan = $this->post('id_pelanggan');
	        
	        $response['insert_result'] = $this->insert_model->insertMOperator($idCard, $nik, $nama, $phone, $status, $idPelanggan);
			$this->response($response, 200);
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
    // localhost/_webservice/index.php/api/insert_services/ring
	// content type :: application/x-www-form-urlencoded
	// raw body :: id_ring=R02&cluster_ring=03&group_ring=C&installation_date=2017-12-25&created_date=2017-12-24&status=1&sisa_quota=15000&id_pelanggan=P01
    function ring_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$idRing = $this->post('id_ring');
			$clusterRing = $this->post('cluster_ring');
			$groupRing = $this->post('group_ring');
			$installationDate = strtotime($this->post('installation_date'));
			$createdDate = strtotime($this->post('created_date'));
			$status = $this->post('status');
			$sisaQuota = $this->post('sisa_quota');
			$idPelanggan = $this->post('id_pelanggan');
	        
	        $response['insert_result'] = $this->insert_model->insertMRing($idRing, $clusterRing, $groupRing, $installationDate, 
	        	$createdDate, $status, $sisaQuota, $idPelanggan);
			$this->response($response, 200);
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
    // localhost/_webservice/index.php/api/insert_services/unit
	// content type :: application/x-www-form-urlencoded
	// raw body :: id_pelanggan=P01&urutan=12&nama=avanza putih&nopol=L 1024 AW&brand=avanza&status=1&owner=bejo&location=surabaya&cluster_unit=03
    function unit_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$idPelanggan = $this->post('id_pelanggan');
			$noUrut = $this->post('urutan');
			$unitName = $this->post('nama');
			$nopol = $this->post('nopol');
			$brand = $this->post('brand');
			$statusUnit = $this->post('status');
			$owner = $this->post('owner');
			$location = $this->post('location');
			$clusterUnit = $this->post('cluster_unit');
	        
	        $response['insert_result'] = $this->insert_model->insertMUnit($idPelanggan, $noUrut, $unitName, $nopol, $brand, $statusUnit, 
	        	$owner, $location, $clusterUnit);
			$this->response($response, 200);
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
    // localhost/_webservice/index.php/api/insert_services/groupingunit
	// content type :: application/x-www-form-urlencoded
	// raw body :: id_unit=UP0112&id_ring=R02&id_pelanggan=P01&id_card=ID001&urutan=3
    function groupingunit_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$idUnit = $this->post('id_unit');
			$idRing = $this->post('id_ring');
			$idPelanggan = $this->post('id_pelanggan');
			$idCard = $this->post('id_card');
			$noUrut = $this->post('urutan');
	        
	        $response['insert_result'] = $this->insert_model->insertGroupingUnit($idUnit, $idRing, $idPelanggan, $idCard, $noUrut);
			$this->response($response, 200);
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
}
