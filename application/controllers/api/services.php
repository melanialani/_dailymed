<?php defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Services extends REST_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->model('rest_model');
        $this->load->model('get_model');
        $this->load->model('insert_model');
    }
    
	// localhost/_webservice/index.php/api/services/all?format=xml&idspbu=01
	function all_get(){
		$response = $this->rest_model->getAll($this->get('idspbu'));
		if(!empty($response)){
			$this->response($response, 200);
		} else {
			$this->response(array( 'status' => "ID not found" ), 406);
		}
	}
	
	// localhost/_webservice/index.php/api/services/settingtp?format=xml&idspbu=02
	function settingTp_get(){
		$response['result'] = $this->rest_model->getSettingTp($this->get('idspbu'));
		if(!empty($response)){
			$this->response($response, 200);
		} else {
			$this->response(array( 'status' => "ID not found" ), 406);
		}
	}
	
	// localhost/_webservice/index.php/api/services/card?format=xml&idspbu=01&idpelanggan=03&idcard=0&nik=0&idring=0&idunit=0 -> biasa
	// localhost/_webservice/index.php/api/services/card?format=xml&idspbu=01&idpelanggan=03&idcard=CB1D5FAA01&nik=0&idring=CB1D5FAB01&idunit=U04 -> kartu
	// localhost/_webservice/index.php/api/services/card?format=xml&idspbu=01&idpelanggan=03&idcard=0&nik=UNK348&idring=CB1D5FAB01&idunit=U04 -> nik
	function card_get(){
		if ($this->get('idspbu') == NULL){
			$this->response(array( 'status' => "ID SPBU not found" ), 408);
		} else {
			$param['id_spbu'] = $this->get('idspbu');
			$param['id_pelanggan'] = $this->get('idpelanggan');
			$param['id_card'] = $this->get('idcard');
			$param['nik'] = $this->get('nik');
			$param['id_ring'] = $this->get('idring');
			$param['id_unit'] = $this->get('idunit');
			
			$response['id_spbu'] = $this->get('idspbu');
			$response = $this->rest_model->getCard($this->get('idspbu'), $param);
			
			if(!empty($response)){
				$this->response($response, 200);
			} else {
				$this->response(array( 'status' => "NULL" ), 406);
			}
		}
	}
	
	// localhost/_webservice/index.php/api/services/transaksi
	// content type :: application/x-www-form-urlencoded
	// raw body :: tgl_jam=2017-12-21&dispenser=1&nozle=2&bbm=3&liter=3&harga=7000&total_harga=21000&id_kartu=CB1D5FAA02&id_ring=CB1D5FAB06&odometer=20000&ctr=11&idspbu=01&konsumen_id_jenis=3&bayar_id_jenis=2&totalizer=6000&type_procedure=02
    function transaksi_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$tglJam = $this->post('tgl_jam');
	        $dispenser = $this->post('dispenser');
	        $nozle = $this->post('nozle');
	        $bbm = $this->post('bbm');
	        $liter = $this->post('liter');
	        $harga = $this->post('harga');
	        $totalHarga = $this->post('total_harga');
	        $idKartu = $this->post('id_kartu');
	        $idRing = $this->post('id_ring');
	        $odometer = $this->post('odometer');
	        $ctr = $this->post('ctr');
	        $idSpbu = $this->post('idspbu');
	        $konsumenIdJenis = $this->post('konsumen_id_jenis');
	        $bayarIdJenis = $this->post('bayar_id_jenis');
	        $totalizer = $this->post('totalizer');
	        $type_procedure = $this->post('type_procedure');
	        
	        $transaksi = $this->get_model->getTTransaksi($idSpbu, $ctr, $tglJam);
	        if ($transaksi == NULL || $transaksi[0] == NULL){
				$response['insert_result'] = $this->insert_model->insertTTransaksi($tglJam, $dispenser, $nozle, $bbm, $liter, $harga, $totalHarga, 
					$idKartu, $idRing, $odometer, $ctr, $idSpbu, $konsumenIdJenis, $bayarIdJenis, $totalizer, $type_procedure);
					
				$this->response($response, 200);
			} else {
				$this->response(array( 'status' => "ERROR INSERT :: Record with the same spbu, counter, and datetime already existed" ), 406);
			}
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
    // localhost/_webservice/index.php/api/services/totalizer
    // content type :: application/x-www-form-urlencoded
    // raw body :: tgl_jam=2017-12-21&totalizer_id_spbu=01&dispenser=3&tp=2&nozle=4&bbm=7&harga_satuan=6000&totalizer_awal=12000&totalizer_akhir=12500&tangki=1&operator=CB1D5FAA01&t_tera=1&t_card=2&t_vcr=3&t_rfid=4&status_ganti_harga=0&status=1&shift=3&ctr=12
    function totalizer_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$tglJam = $this->post('tgl_jam');
			$totalizerIdSpbu = $this->post('totalizer_id_spbu');
	        $dispenser = $this->post('dispenser');
	        $tp = $this->post('tp');
	        $nozle = $this->post('nozle');
	        $bbm = $this->post('bbm');
	        $hargaSatuan = $this->post('harga_satuan');
	        $totalizerAwal = $this->post('totalizer_awal');
	        $totalizerAkhir = $this->post('totalizer_akhir');
	        $tangki = $this->post('tangki');
	        $operator = $this->post('operator');
	        $tTera = $this->post('t_tera');
	        $tCard = $this->post('t_card');
	        $tVcr = $this->post('t_vcr');
	        $tRfid = $this->post('t_rfid');
	        $statusGantiHarga = $this->post('status_ganti_harga');
	        $status = $this->post('status');
	        $shift = $this->post('shift');
	        $ctr = $this->post('ctr');
	        
	        $konsumenIdJenis = $this->post('konsumenidjenis');
	        $bayarIdJenis = $this->post('bayaridjenis');
	        $totalizer = $this->post('totalizer');
	        $type_procedure = $this->post('typeprocedure');
	        
	        $transaksi = $this->get_model->getTTransaksi($totalizerIdSpbu, $ctr, $tglJam);
	        if ($transaksi == NULL || $transaksi[0] == NULL){
				$response['insert_result'] = $this->insert_model->insertTTotalizer($tglJam, $totalizerIdSpbu, $dispenser, $tp, $nozle, $bbm, 
					$hargaSatuan, $totalizerAwal, $totalizerAkhir, $tangki, $operator, $tTera, $tCard, $tVcr, $tRfid, $statusGantiHarga, $status, 
					$shift, $ctr);
					
				$this->response($response, 200);
			} else {
				$this->response(array( 'status' => "ERROR INSERT :: Record with the same spbu, counter, and datetime already existed" ), 406);
			}
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
    // localhost/_webservice/index.php/api/services/tangki_totalizer
    // content type :: application/x-www-form-urlencoded
    // raw body :: tgl_jam=2017-12-21&tangki=1&tinggi_air=18&volume_air=122&tinggi_bbm=28&volume_bbm=322&suhu=27&ganti_harga=0&status_atg=1&tangki_id_spbu=01&ctr=12&id_shift=3
    function tangki_totalizer_post() {
    	$response['post'] = $this->post();
    	
    	try {
			$tglJam = $this->post('tgl_jam');
	        $tangki = $this->post('tangki');
	        $tinggiAir = $this->post('tinggi_air');
	        $volumeAir = $this->post('volume_air');
	        $tinggiBbm = $this->post('tinggi_bbm');
	        $volumeBbm = $this->post('volume_bbm');
	        $suhu = $this->post('suhu');
	        $gantiHarga = $this->post('ganti_harga');
	        $statusAtg = $this->post('status_atg');
	        $tangkiIdSpbu = $this->post('tangki_id_spbu');
	        $ctr = $this->post('ctr');
	        $idShift = $this->post('id_shift');
	        
	        $transaksi = $this->get_model->getTTransaksi($tangkiIdSpbu, $ctr, $tglJam);
	        if ($transaksi == NULL || $transaksi[0] == NULL){
				$response['insert_result'] = $this->insert_model->insertTTangkiTotalizer($tglJam, $tangki, $tinggiAir, $volumeAir, 
					$tinggiBbm, $volumeBbm, $suhu, $gantiHarga, $statusAtg, $tangkiIdSpbu, $ctr, $idShift);
					
				$this->response($response, 200);
			} else {
				$this->response(array( 'status' => "ERROR INSERT :: Record with the same spbu, counter, and datetime already existed" ), 406);
			}
		} catch (Exception $ex) {
			$this->response(array( 'status' => "Caught in exception :: " . $ex->getMessage() ), 406);
		}
    }
    
}
