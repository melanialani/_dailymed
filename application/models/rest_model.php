<?php

Class Rest_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('get_model');
        $this->load->model('update_model');
    }

    public function getAll($idSpbu){
    	// ctr: transaksi, totalizer, report
    	// status: nozle, tangki, totalizer, auto kalibrasi, ganti harga
    	$from_db['m_tangki'] = $this->get_model->getMTangki($idSpbu);
    	$from_db['s_setting_harga_bbm'] = $this->get_model->getSSettingHargaBbm($idSpbu);
    	$from_db['s_settingdispenser'] = $this->get_model->getSSettingDispenser($idSpbu);
    	
    	$return['counter_totalizer_tangki'] = $this->get_model->getCounterTTangkiTotalizer($idSpbu);
    	$return['counter_totalizer'] = $this->get_model->getCounterTTotalizer($idSpbu);
    	$return['counter_transaksi'] = $this->get_model->getCounterTTransaksi($idSpbu);
    	
    	if ($from_db['m_tangki'] != NULL){
			if ($from_db['m_tangki'][0]['status_kalibrasi'] != NULL) 
				$return['status_kalibrasi'] = $from_db['m_tangki'][0]['status_kalibrasi']; 
			else $return['status_kalibrasi'] = 'NULL';
			
			if ($from_db['m_tangki'][0]['status'] != NULL) 
				$return['status_tangki'] = $from_db['m_tangki'][0]['status']; 
			else $return['status_tangki'] = 'NULL';
		} else {
			$return['status_kalibrasi'] = 'NOT FOUND';
			$return['status_tangki'] = 'NOT FOUND';
    	}
    	
    	if ($from_db['s_settingdispenser'] != NULL){
			if ($from_db['s_settingdispenser'][0]['s_lock'] != NULL) 
				$return['status_lock'] = $from_db['s_settingdispenser'][0]['s_lock']; 
			else $return['status_lock'] = 'NULL';
			
			if ($from_db['s_settingdispenser'][0]['s_realtime'] != NULL) 
				$return['status_realtime'] = $from_db['s_settingdispenser'][0]['s_realtime']; 
			else $return['status_realtime'] = 'NULL';
		} else {
			$return['status_lock'] = 'NOT FOUND';
			$return['status_realtime'] = 'NOT FOUND';
    	}
    	
    	if ($from_db['s_setting_harga_bbm'] != NULL) {
			if ($from_db['s_setting_harga_bbm'][0]['status'] != NULL) 
				$return['status_ganti_harga'] = $from_db['s_setting_harga_bbm'][0]['status']; 
			else $return['status_ganti_harga'] = 'NULL'; 
		} else $return['status_ganti_harga'] = 'NOT FOUND';
    	
        return $return;
	}
	
	public function getSettingTp($idSpbu){
    	// ambil setting TP berdasarkan spbu
    	// lihat 3 table setting, digabungkan dengan lihat id_spbu dan TP
    	$sqlSyntax = '
		SELECT
			s_setting_bbm.id_setting AS id_setting_bbm, s_setting_bbm.id_bbm, s_setting_bbm.id_tangki, s_setting_bbm.id_spbu,
			s_setting_harga_bbm.shift, s_setting_harga_bbm.harga, s_setting_harga_bbm.update_harga, s_setting_harga_bbm.update_tgl,
			s_setting_harga_bbm.status AS status_harga, s_settingdispenser.s_lock, s_settingdispenser.s_realtime,
			s_settingdispenser.id_setting AS id_setting_dispenser, s_settingdispenser.id_tp, 
			s_settingdispenser.id_tangki AS id_tangki_setting_dispenser, s_settingdispenser.id_nozle, 
			s_settingdispenser.id_dispenser, s_settingdispenser.id_cnt_pompa, 
			s_settingdispenser.id_cnt_nozle, s_settingdispenser.id_problem
		FROM  public.s_setting_bbm, public.s_setting_harga_bbm, public.s_settingdispenser
		WHERE s_setting_bbm.id_spbu = s_setting_harga_bbm.id_spbu
			AND s_setting_bbm.id_spbu = s_settingdispenser.id_spbu
			AND s_setting_bbm.id_bbm = s_setting_harga_bbm.id_bbm
			AND s_setting_bbm.id_setting = s_setting_harga_bbm.id_setting
			AND s_setting_bbm.id_spbu = '.$idSpbu.'
		ORDER BY s_settingdispenser.id_tp';
    	
        return $this->db->query($sqlSyntax)->result_array();
	}
	
	public function getCard($idSpbu, $param){
		// (mifare) bawa saldo, id card, tgl jam saldo terakhir, jenis langganan, jenis bbm
		// (biasa) bawa id kartu, id spbu
		// kalo pelanggan boleh isi, kurangi debit, tapi sebelumnya harus:
		// cek status jadwal (khusus), debit/kredit, kuota, dll
		// (mifare khusus) cek juga id ring, unit name / kendaraan, nik supir
		
		if (array_key_exists('id_pelanggan', $param)){
			if (isset($param['id_pelanggan'])){ 
				$pelanggan = $this->get_model->getMPelanggan($param['id_pelanggan']);
				
				if (isset($pelanggan)){
					//$response['pelanggan'] = $pelanggan;
					if ($pelanggan[0]['jenis_konsumen'] == 0){ // pelanggan biasa
						$response['result'] = $this->getCardBiasa($idSpbu, $param['id_pelanggan']);
					} else if ($pelanggan[0]['jenis_konsumen'] == 3){ // pelanggan khusus
						if (isset($param['id_card']) && isset($param['nik'])){
							if ($param['id_card'] == '0' && $param['nik'] != '0'){ // enter pakai nik
								$response['result'] = $this->getCardKhususNoScheduleNoFixedOperator($idSpbu, $param['nik'], false, $param['id_ring'], $param['id_unit']);
							} else if ($param['id_card'] != '0' && $param['nik'] == '0'){ // enter pakai id_card
								$response['result'] = $this->getCardKhususNoScheduleNoFixedOperator($idSpbu, $param['id_card'], true, $param['id_ring'], $param['id_unit']);
							} else if ($param['id_card'] == '0' && $param['nik'] == '0'){ // enter pakai id_card
								$response['message'] = 'BOTH ID CARD AND NIK ARE 0';
							}
						} else $response['message'] = 'ID CARD OR NIK NOT FOUND';
					} else $response['message'] = 'JENIS KONSUMEN NOT DEFINED';
				} else $response['message'] = 'PELANGGAN NULL'; 
			} else $response['message'] = 'ID PELANGGAN NULL'; 
		} else {
			$response['message'] = 'ID PELANGGAN NOT FOUND';
		}
		
		return $response;
	}
	
	public function getCardBiasa($idSpbu, $idPelanggan){
		$sql = "
		SELECT m_pelanggan.id_pelanggan, m_armada.id_kartu, m_armada.id_ring, m_pelanggan.id_cluster_pelanggan, m_armada.nopol,
			m_armada.j_limit_liter AS limit_liter_armada, m_armada.j_limit_rupiah AS limit_rupiah_armada,
			m_pelanggan.j_limit_liter AS limit_liter_pelanggan, m_pelanggan.j_limit_rupiah AS limit_rupiah_pelanggan,
			m_armada.sisa_liter AS sisa_liter_armada, m_armada.sisa_rupiah AS sisa_rupiah_armada,
			m_pelanggan.sisa_liter AS sisa_liter_pelanggan, m_pelanggan.sisa_rupiah AS sisa_rupiah_pelanggan,
			m_armada.total_penggunaan AS total_penggunaan_armada, m_pelanggan.total_penggunaan AS total_penggunaan_pelanggan,
			m_armada.kode_bbm, m_armada.tgl_jam_saldo, 
			m_pelanggan.jenis_konsumen,
			m_pelanggan.contact_person, m_pelanggan.nama_pelanggan, m_pelanggan.alamat, m_pelanggan.telp, m_pelanggan.email,
			m_pelanggan.created AS created_pelanggan, m_armada.created AS created_armada,
			m_pelanggan.exp_date, m_pelanggan.tgl_aktif, m_pelanggan.tgl_tagih, m_pelanggan.last_tgl_tagih,
			m_armada.status AS status_armada, m_pelanggan.status AS status_pelanggan
		FROM public.m_pelanggan, public.m_armada
		WHERE m_pelanggan.id_pelanggan = m_armada.armada_id_pelanggan
			AND m_pelanggan.id_pelanggan = '".$idPelanggan."'";
			
		$return = $this->db->query($sql)->result_array();
		return $return;
	}
	
	public function getCardKhususNoScheduleNoFixedOperator($idSpbu, $idCardOrNik, $isUsingCard, $idRing, $idUnit){
		if ($isUsingCard){
			$operator = $this->get_model->getMOperatorByCard($idCardOrNik);
		} else if (!$isUsingCard){
			$operator = $this->get_model->getMOperatorByNik($idCardOrNik);
		} else return $return['message'] = 'ID CARD OR NIK NOT FOUND';
		
		$ring = $this->get_model->getMRing($idRing);
		$unit = $this->get_model->getMUnit($idUnit);
		
		if ($operator == NULL) return $return['message'] = 'OPERATOR IS NOT FOUND';
		else if ($ring == NULL) return $return['message'] = 'RING IS NOT FOUND';
		else if ($unit == NULL) return $return['message'] = 'UNIT IS NOT FOUND';
		else { // if no null values, return result from 3 table
			$return['operator'] = $operator;
			$return['ring'] = $ring;
			$return['unit'] = $unit;
			
			return $return;
		}
	}
	
	public function postTransaksi(){
		// berlaku juga untuk postTotalizer dan postReport (kecuali idKartu karena tidak ada)
		// cek dulu: apakah ctr != & tglJam != & harga != & nozle != & idKartu !=
		// kalo lolos 5 rule (&&) maka baru insert ke db
	}

}

?>
