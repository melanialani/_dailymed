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
	
	public function getMRingByIdPelanggan($idPelanggan){
		$this->db->select('id_ring, sisa_quota, jenisbbm, jenislimitasi');
        $this->db->where('id_pelanggan', $idPelanggan);
        return $this->db->get('pelanggan.m_ring')->result_array();
	}
	
	public function getMUnit($idUnit){
        $this->db->where('id_unit', $idUnit);
        return $this->db->get('pelanggan.m_unit')->result_array();
	}
	
	public function getMUnitByIdPelanggan($idPelanggan){
		$this->db->select('id_unit, unit_name');
        $this->db->where('id_pelanggan', $idPelanggan);
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
	
	public function getGroupingUnit($idGrouping){
        $this->db->where('id_grouping', $idGrouping);
        return $this->db->get('pelanggan.grouping_unit')->result_array();
	}
	
	public function getSchedulePlant($idSchedule){
		$this->db->where('id_schedule', $idSchedule);
        return $this->db->get('pelanggan.schedule_plant')->result_array();
	}
	
	// ---> REGION :: GET IN SCHEMA PUBLIC
	
	public function getTTransaksi($idSpbu, $tglJam){
        $this->db->where('id_spbu', $idSpbu);
        $this->db->where('tgl_jam', $tglJam);
        return $this->db->get('public.t_transaksi')->result_array();
	}
	
	public function getTTotalizer($idSpbu, $tglJam, $nozle){
        $this->db->where('totalizer_id_spbu', $idSpbu);
        $this->db->where('tgl_jam', $tglJam);
        $this->db->where('nozle', $nozle);
        return $this->db->get('public.t_totalizer')->result_array();
	}
	
	public function getTTangkiTotalizer($idSpbu, $tangki, $tglJam){
        $this->db->where('tangki_id_spbu', $idSpbu);
        $this->db->where('tangki', $tangki);
        $this->db->where('tgl_jam', $tglJam);
        return $this->db->get('public.t_tangki_totalizer')->result_array();
	}
	
	public function getTTangkiRealtime($idSpbu, $ctr, $tglJam){
        $this->db->where('id_spbu', $idSpbu);
        $this->db->where('nocount', $ctr);
        $this->db->where('tgl_jam', $tglJam);
        return $this->db->get('public.t_tangki_realtime')->result_array();
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
	// USE below SQL syntax example to eliminate same counter appearing twice
	// $sqlSyntax = 'SELECT COUNT(*), nocount FROM t_totalizer GROUP BY nocount HAVING COUNT(*) >= 1 ORDER BY nocount';
	
	public function getCounterTTransaksi($idSpbu){
		$return = 'NOT FOUND'; // default return line
        
        $this->db->select('COUNT(*), nocount');
		$this->db->from('public.t_transaksi');
		$this->db->where('id_spbu', $idSpbu);
		$this->db->group_by('nocount');
		$this->db->having('COUNT(*) >= 1');
		$this->db->order_by('nocount');
		$result = $this->db->get()->result_array();
        
        for ($i=0; $i<sizeof($result); $i++){
        	// counter mulai dari 1, tapi array mulai dari 0
			if (($i + 1) != $result[$i]['nocount']){ 
				$return = $i;
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
	public function getCounterTTotalizer($idSpbu){
		$return = 'NOT FOUND'; // default return line
		
		$this->db->select('COUNT(*), nocount');
		$this->db->from('public.t_totalizer');
		$this->db->where('totalizer_id_spbu', $idSpbu);
		$this->db->group_by('nocount');
		$this->db->having('COUNT(*) >= 1');
		$this->db->order_by('nocount');
		$result = $this->db->get()->result_array();
    	
        for ($i=0; $i<sizeof($result); $i++){
        	// counter mulai dari 1, tapi array mulai dari 0
			if (($i + 1) != $result[$i]['nocount']){
				$return = $i;
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
	public function getCounterTTangkiTotalizer($idSpbu){
		$return = 'NOT FOUND'; // default return line
		
		$this->db->select('COUNT(*), nocount');
		$this->db->from('public.t_tangki_totalizer');
		$this->db->where('tangki_id_spbu', $idSpbu);
		$this->db->group_by('nocount');
		$this->db->having('COUNT(*) >= 1');
		$this->db->order_by('nocount');
		$result = $this->db->get()->result_array();
		
        for ($i=0; $i<sizeof($result); $i++){
        	// counter mulai dari 1, tapi array mulai dari 0
			if (($i + 1) != $result[$i]['nocount']){
				$return = $i;
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
	public function getCounterTTangkiRealtime($idSpbu){
		$return = 'NOT FOUND'; // default return line
		
		$this->db->select('COUNT(*), nocount');
		$this->db->from('public.t_tangki_realtime');
		$this->db->where('id_spbu', $idSpbu);
		$this->db->group_by('nocount');
		$this->db->having('COUNT(*) >= 1');
		$this->db->order_by('nocount');
		$result = $this->db->get()->result_array();
		
	    for ($i=0; $i<sizeof($result); $i++){
        	// counter mulai dari 1, tapi array mulai dari 0
			if (($i + 1) != $result[$i]['nocount']){
				$return = $i;
				break;
			} else $return = $result[$i]['nocount'];
		}
        return $return;
	}
	
}

?>
