<?php

Class Get_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    // ---> REGION :: GET IN SCHEMA PELANGGAN
    
    public function getMRing($idRing){
        $this->db->where('id_ring', $idRing);
        return $this->db->get('pelanggan.m_ring')->result_array();
	}
	
	public function getMUnit($idUnit){
        $this->db->where('id_unit', $idUnit);
        return $this->db->get('pelanggan.m_unit')->result_array();
	}
	
	public function getMOperatorByCard($idCard){
        $this->db->where('id_card', $idCard);
        return $this->db->get('pelanggan.m_operator')->result_array();
	}
	
	public function getMOperatorByNik($nik){
        $this->db->where('nik', $nik);
        return $this->db->get('pelanggan.m_operator')->result_array();
	}
	
	// ---> REGION :: GET IN SCHEMA PUBLIC
	
	public function getTTransaksi($idSpbu, $ctr, $tglJam){
        $this->db->where('id_spbu', $idSpbu);
        $this->db->where('nocount', $ctr);
        $this->db->where('tgl_jam', $tglJam);
        return $this->db->get('public.t_transaksi')->result_array();
	}
	
	public function getTTotalizer($idSpbu, $ctr, $tglJam){
        $this->db->where('totalizer_id_spbu', $idSpbu);
        $this->db->where('nocount', $ctr);
        $this->db->where('tgl_jam', $tglJam);
        return $this->db->get('public.t_totalizer')->result_array();
	}
	
	public function getTTangkiTotalizer($idSpbu, $ctr, $tglJam){
        $this->db->where('tangki_id_spbu', $idSpbu);
        $this->db->where('nocount', $ctr);
        $this->db->where('tgl_jam', $tglJam);
        return $this->db->get('public.t_tangki_totalizer')->result_array();
	}
	
	public function getTTransaksiByIdSpbu($idSpbu){
        $this->db->where('id_spbu', $idSpbu);
        $this->db->order_by('nocount');
        return $this->db->get('public.t_transaksi')->result_array();
	}
	
	public function getTTotalizerByIdSpbu($idSpbu){
        $this->db->where('totalizer_id_spbu', $idSpbu);
        $this->db->order_by('nocount');
        return $this->db->get('public.t_totalizer')->result_array();
	}
	
	public function getTTangkiTotalizerByIdSpbu($idSpbu){
        $this->db->where('tangki_id_spbu', $idSpbu);
        $this->db->order_by('nocount');
        return $this->db->get('public.t_tangki_totalizer')->result_array();
	}
	
	public function getMTangki($idSpbu){
        $this->db->where('id_spbu', $idSpbu);
        return $this->db->get('public.m_tangki')->result_array();
	}
	
	public function getSSettingHargaBbm($idSpbu){
        $this->db->where('id_spbu', $idSpbu);
        return $this->db->get('public.s_setting_harga_bbm')->result_array();
	}
	
	public function getSSettingDispenser($idSpbu){
        $this->db->where('id_spbu', $idSpbu);
        return $this->db->get('public.s_settingdispenser')->result_array();
	}
	
	public function getMPelanggan($idPelanggan){
        $this->db->where('id_pelanggan', $idPelanggan);
        return $this->db->get('public.m_pelanggan')->result_array();
	}
	
	public function getMArmada($idPelanggan){
        $this->db->where('armada_id_pelanggan', $idPelanggan);
        return $this->db->get('public.m_armada')->result_array();
	}
	
	// ---> REGION :: GET COUNTER
	
	public function getCounterTTransaksi($idSpbu){
		$return = 'No data available for id_spbu '. $idSpbu; // default return line
        $result = $this->getTTransaksiByIdSpbu($idSpbu);
        for ($i=0; $i<sizeof($result); $i++){
			if ($i != $result[$i]['nocount']){
				$return = $i . '..' . $result[$i]['nocount'];
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
	public function getCounterTTotalizer($idSpbu){
		$return = 'NOT FOUND'; // default return line
        $result = $this->getTTotalizerByIdSpbu($idSpbu);
        for ($i=0; $i<sizeof($result); $i++){
			if ($i != $result[$i]['nocount']){
				$return = $i . '..' . $result[$i]['nocount'];
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
	public function getCounterTTangkiTotalizer($idSpbu){
		$return = 'NOT FOUND'; // default return line
		$result = $this->getTTangkiTotalizerByIdSpbu($idSpbu);
        for ($i=0; $i<sizeof($result); $i++){
			if ($i != $result[$i]['nocount']){
				$return = $i . '..' . $result[$i]['nocount'];
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
}

?>
