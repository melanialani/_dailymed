<?php

Class Rest_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('get_model');
    }

    public function getAll($idSpbu){
    	// ctr: transaksi, totalizer, report
    	// status: nozle, tangki, totalizer, auto kalibrasi, ganti harga
    	$from_db['m_tangki'] = $this->get_model->getMTangki($idSpbu);
    	$from_db['s_setting_harga_bbm'] = $this->get_model->getSSettingHargaBbm($idSpbu);
    	$from_db['s_settingdispenser'] = $this->get_model->getSSettingDispenser($idSpbu);
    	
    	$return['counter_realtime_tangki'] = strval($this->get_model->getCounterTTangkiRealtime($idSpbu));
    	$return['counter_totalizer_tangki'] = strval($this->get_model->getCounterTTangkiTotalizer($idSpbu));
    	$return['counter_totalizer'] = strval($this->get_model->getCounterTTotalizer($idSpbu));
    	$return['counter_transaksi'] = strval($this->get_model->getCounterTTransaksi($idSpbu));
    	
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
    	
    	$result = $this->db->query($sqlSyntax)->row_array();
        return $result;
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
				
				if (isset($pelanggan) && $pelanggan != NULL){
					//$response['pelanggan'] = $pelanggan;
					if ($pelanggan[0]['jenis_konsumen'] == 0){ // pelanggan biasa
						$response = $this->getCardBiasa($idSpbu, $param['id_pelanggan']);
					} else if ($pelanggan[0]['jenis_konsumen'] == 3){ // pelanggan khusus
						if (isset($param['id_card']) && isset($param['nik'])){
							if ($param['id_card'] == '0' && $param['nik'] != '0'){ // enter pakai nik
								$response = $this->getCardKhususByNikSeeGroupingUnit($param['nik']);
							} else if ($param['id_card'] != '0' && $param['nik'] == '0'){ // enter pakai id_card
								$response = $this->getCardKhususByIdCardSeeGroupingUnit($param['id_card']);
							} else if ($param['id_card'] == '0' && $param['nik'] == '0'){ // id_card dan nik kosong (0)
								$response['status'] = 'BOTH ID CARD AND NIK ARE 0';
							}
						} else $response['status'] = 'ID CARD OR NIK NOT FOUND';
					} else $response['status'] = 'JENIS KONSUMEN NOT DEFINED';
				} else $response['status'] = 'PELANGGAN NULL'; 
			} else $response['status'] = 'ID PELANGGAN NULL'; 
		} else {
			$response['status'] = 'ID PELANGGAN NOT FOUND';
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
			
		$result = $this->db->query($sql)->row_array();
		return $result;
	}
	
	// v1 - look into table m_unit, m_ring, and m_operator, doesnt see table grouping_unit
	public function getCardKhususByNik($nik){
		$sql = "
		SELECT op.status, op.id_card AS id_kartu, op.nik, ring.id_ring, unit.unit_name, ring.sisa_quota AS saldo, 
			ring.jenislimitasi AS limitasi, ring.jenisbbm
		FROM pelanggan.m_operator op, pelanggan.m_unit unit, pelanggan.m_ring ring
		WHERE op.nik = '".$nik."'
			AND op.id_pelanggan = unit.id_pelanggan
			AND op.id_pelanggan = ring.id_pelanggan";
			
		$result = $this->db->query($sql)->row_array();
		if ($result != NULL){
			// convert any int to string 'cuz comserver vb6 split by " "
	    	$result['limitasi'] = strval($result['limitasi']);
	    	$result['jenisbbm'] = strval($result['jenisbbm']);
		}
    	
		return $result;
	}
	
	// v1 - look into table m_unit, m_ring, and m_operator, doesnt see table grouping_unit
	public function getCardKhususByIdCard($idCard){
		$sql = "
		SELECT op.status, op.id_card AS id_kartu, op.nik, ring.id_ring, unit.unit_name, ring.sisa_quota AS saldo, 
			ring.jenislimitasi AS limitasi, ring.jenisbbm
		FROM pelanggan.m_operator op, pelanggan.m_unit unit, pelanggan.m_ring ring
		WHERE op.id_card = '".$idCard."'
			AND op.id_pelanggan = unit.id_pelanggan
			AND op.id_pelanggan = ring.id_pelanggan";
			
		$result = $this->db->query($sql)->row_array();
		if ($result != NULL){
			// convert any int to string 'cuz comserver vb6 split by " "
	    	$result['limitasi'] = strval($result['limitasi']);
	    	$result['jenisbbm'] = strval($result['jenisbbm']);
		}
		
		return $result;
	}
	
	// v2 - look into table grouping_unit, m_unit, m_ring, and m_operator
	public function getCardKhususByNikSeeGroupingUnit($nik){
		$sql = "
		SELECT op.status, op.id_card AS id_kartu, op.nik, ring.id_ring, unit.unit_name, ring.sisa_quota AS saldo, 
			ring.jenislimitasi AS limitasi, ring.jenisbbm
		FROM pelanggan.m_operator op, pelanggan.m_unit unit, pelanggan.m_ring ring, pelanggan.grouping_unit gp
		WHERE op.nik = '".$nik."'
			AND gp.id_card = op.id_card
			AND ring.id_ring = gp.id_ring
			AND unit.id_unit = gp.id_unit";
			
		$result = $this->db->query($sql)->row_array();
		if ($result != NULL){
			// convert any int to string 'cuz comserver vb6 split by " "
	    	$result['limitasi'] = strval($result['limitasi']);
	    	$result['jenisbbm'] = strval($result['jenisbbm']);
		}
    	
		return $result;
	}
	
	// v2 - look into table grouping_unit, m_unit, m_ring, and m_operator
	public function getCardKhususByIdCardSeeGroupingUnit($idCard){
		$sql = "
		SELECT op.status, op.id_card AS id_kartu, op.nik, ring.id_ring, unit.unit_name, ring.sisa_quota AS saldo, 
			ring.jenislimitasi AS limitasi, ring.jenisbbm
		FROM pelanggan.m_operator op, pelanggan.m_unit unit, pelanggan.m_ring ring, pelanggan.grouping_unit gp
		WHERE op.id_card = '".$idCard."'
			AND gp.id_card = op.id_card
			AND ring.id_ring = gp.id_ring
			AND unit.id_unit = gp.id_unit";
			
		$result = $this->db->query($sql)->row_array();
		if ($result != NULL){
			// convert any int to string 'cuz comserver vb6 split by " "
	    	$result['limitasi'] = strval($result['limitasi']);
	    	$result['jenisbbm'] = strval($result['jenisbbm']);
		}
    	
		return $result;
	}
	
	// v3 - look into table schedule_plant,, grouping_unit, m_unit, m_ring, and m_operator
	public function getCardKhususByNikSeeSchedulePlant($nik){
		$sql = "
		SELECT op.status, op.id_card AS id_kartu, op.nik, ring.id_ring, unit.unit_name, ring.sisa_quota AS saldo, 
			ring.jenislimitasi AS limitasi, ring.jenisbbm
		FROM pelanggan.m_operator op, pelanggan.m_unit unit, pelanggan.m_ring ring, pelanggan.grouping_unit gp, schedule_plant sp
		WHERE op.nik = '".$nik."'
			AND op.id_card = sp.id_card
			AND sp.id_grouping = gp.id_grouping
			AND gp.id_ring = ring.id_ring
			AND gp.id_unit = unit.id_unit";
			
		$result = $this->db->query($sql)->row_array();
		if ($result != NULL){
			// convert any int to string 'cuz comserver vb6 split by " "
	    	$result['limitasi'] = strval($result['limitasi']);
	    	$result['jenisbbm'] = strval($result['jenisbbm']);
		}
    	
		return $result;
	}
	
	// v3 - look into table schedule_plant,, grouping_unit, m_unit, m_ring, and m_operator
	public function getCardKhususByIdCardSeeSchedulePlant($idCard){
		$sql = "
		SELECT op.status, op.id_card AS id_kartu, op.nik, ring.id_ring, unit.unit_name, ring.sisa_quota AS saldo, 
			ring.jenislimitasi AS limitasi, ring.jenisbbm
		FROM pelanggan.m_operator op, pelanggan.m_unit unit, pelanggan.m_ring ring, pelanggan.grouping_unit gp, schedule_plant sp
		WHERE op.id_card = '".$idCard."'
			AND op.id_card = sp.id_card
			AND sp.id_grouping = gp.id_grouping
			AND gp.id_ring = ring.id_ring
			AND gp.id_unit = unit.id_unit";
			
		$result = $this->db->query($sql)->row_array();
		if ($result != NULL){
			// convert any int to string 'cuz comserver vb6 split by " "
	    	$result['limitasi'] = strval($result['limitasi']);
	    	$result['jenisbbm'] = strval($result['jenisbbm']);
		}
    	
		return $result;
	}
	
	// v3 - look into schedule plant -> then grouping_unit -> then m_ring and m_unit
	public function getCardWithSchedulePlant($idSpbu, $param){
		if (array_key_exists('id_pelanggan', $param)){
			if (isset($param['id_pelanggan'])){ 
				$pelanggan = $this->get_model->getMPelanggan($param['id_pelanggan']);
				
				if (isset($pelanggan) && $pelanggan != NULL){
					//$response['pelanggan'] = $pelanggan;
					if ($pelanggan[0]['jenis_konsumen'] == 0){ // pelanggan biasa
						$response = $this->getCardBiasa($idSpbu, $param['id_pelanggan']);
					} else if ($pelanggan[0]['jenis_konsumen'] == 3){ // pelanggan khusus
						if (isset($param['id_card']) && isset($param['nik'])){
							if ($param['id_card'] == '0' && $param['nik'] != '0'){ // enter pakai nik
								$response = $this->getCardKhususByNikSeeGroupingUnit($param['nik']);
							} else if ($param['id_card'] != '0' && $param['nik'] == '0'){ // enter pakai id_card
								$response = $this->getCardKhususByIdCardSeeGroupingUnit($param['id_card']);
							} else if ($param['id_card'] == '0' && $param['nik'] == '0'){ // id_card dan nik kosong (0)
								$response['status'] = 'BOTH ID CARD AND NIK ARE 0';
							}
						} else $response['status'] = 'ID CARD OR NIK NOT FOUND';
					} else $response['status'] = 'JENIS KONSUMEN NOT DEFINED';
				} else $response['status'] = 'PELANGGAN NULL'; 
			} else $response['status'] = 'ID PELANGGAN NULL'; 
		} else {
			$response['status'] = 'ID PELANGGAN NOT FOUND';
		}
		
		return $response;
	}
	
	public function postTransaksi(){
		// berlaku juga untuk postTotalizer dan postReport (kecuali idKartu karena tidak ada)
		// cek dulu: apakah ctr != & tglJam != & harga != & nozle != & idKartu !=
		// kalo lolos 5 rule (&&) maka baru insert ke db
	}

}

?>
