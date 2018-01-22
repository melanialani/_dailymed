<?php

Class Update_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function updateKuotaRing($idRing, $kuota){
		$myArr = array( 'sisa_quota' => $kuota );
		$this->db->where('id_ring', $idRing);
        $this->db->update('pelanggan.m_ring', $myArr);
        return $this->db->affected_rows();
	}
    
	public function updateStatusKalibrasi($idTangki, $statusKalibrasi){
        $myArr = array( 'status_kalibrasi' => $statusKalibrasi );
		$this->db->where('id_tangki', $idTangki);
        $this->db->update('public.m_tangki', $myArr);
        return $this->db->affected_rows();
	}
	
	public function updateStatusTangki($idTangki, $statusTangki){
        $myArr = array( 'status' => $statusTangki );
		$this->db->where('id_tangki', $idTangki);
        $this->db->update('public.m_tangki', $myArr);
        return $this->db->affected_rows();
	}
	
	public function updateStatusRealtime($idSetting, $statusRealtime){
        $myArr = array( 's_realtime' => $statusRealtime );
		$this->db->where('id_setting', $idTangki);
        $this->db->update('public.s_settingdispenser', $myArr);
        return $this->db->affected_rows();
	}
	
	public function updateStatusLock($idSetting, $statusLock){
        $myArr = array( 's_lock' => $statusLock );
		$this->db->where('id_setting', $idSetting);
        $this->db->update('s_settingdispenser', $myArr);
        return $this->db->affected_rows();
	}
	
	public function updateStatusHargaBbm($idSetting, $statusHargaBbm){
        $myArr = array( 'status' => $statusHargaBbm );
		$this->db->where('id_setting', $idSetting);
        $this->db->update('public.s_setting_harga_bbm', $myArr);
        return $this->db->affected_rows();
	}
	
	public function updateMGeneral($idClusterPelanggan, $hargaLama, $hargaBaru){
		$myArr = array(
        	'fuel_price'			=> $hargaLama,
			'request_update_price'	=> $hargaBaru,
			'status'				=> 1
        );
		$this->db->where('id_cluster_pelanggan', $idClusterPelanggan);
        $this->db->update('pelanggan.m_general', $myArr);
        return $this->db->affected_rows();
	}
	
}

?>
