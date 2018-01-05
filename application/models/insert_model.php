<?php

Class Insert_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
	public function insertTTransaksi($tglJam, $dispenser, $nozle, $bbm, $liter, $harga, $totalHarga, $idKartu, $idRing,
	$odometer, $ctr, $idSpbu, $konsumenIdJenis, $bayarIdJenis, $totalizer, $type_procedure){
        $myArr = array(
        	'tgl_jam' 			=> strtotime($tglJam),
        	'dispenser' 		=> $dispenser,
        	'nozle' 			=> $nozle,
        	'bbm'		 		=> $bbm,
        	'liter' 			=> $liter,
        	'harga' 			=> $harga,
        	'total_harga' 		=> $totalHarga,
        	'no_kartu' 			=> $idKartu,
        	'no_ring' 			=> $idRing,
        	'odometer' 			=> $odometer,
        	'nocount' 			=> $ctr,
        	'id_spbu' 			=> $idSpbu,
        	'konsumen_id_jenis' => $konsumenIdJenis,
        	'bayar_id_jenis' 	=> $bayarIdJenis,
        	'totalizer' 		=> $totalizer,
        	'type_procedure' 	=> $type_procedure,
        );
		
        $this->db->insert('public.t_transaksi', $myArr);
        return $this->db->affected_rows();
	}
	
	public function insertTTotalizer($tglJam, $totalizerIdSpbu, $dispenser, $tp, $nozle, $bbm, $hargaSatuan, $totalizerAwal, $totalizerAkhir,
	$tangki, $operator, $tTera, $tCard, $tVcr, $tRfid, $statusGantiHarga, $status, $shift, $ctr){
        $myArr = array(
        	'tgl_jam' 			=> strtotime($tglJam),
        	'totalizer_id_spbu' => $totalizerIdSpbu,
        	'dispenser' 		=> $dispenser,
        	'tp'		 		=> $tp,
        	'nozle' 			=> $nozle,
        	'bbm' 				=> $bbm,
        	'harga_satuan' 		=> $hargaSatuan,
        	'totalizer_awal' 	=> $totalizerAwal,
        	'totalizer_akhir' 	=> $totalizerAkhir,
        	'tangki' 			=> $tangki,
        	'operator' 			=> $operator,
        	't_tera' 			=> $tTera,
        	't_card'			=> $tCard,
        	't_vcr' 			=> $tVcr,
        	't_rfid' 			=> $tRfid,
        	'status_ganti_harga'=> $statusGantiHarga,
        	'status' 			=> $status,
        	'shift' 			=> $shift,
        	'nocount' 			=> $ctr
        );
		
        $this->db->insert('public.t_totalizer', $myArr);
        return $this->db->affected_rows();
	}
	
	public function insertTTangkiTotalizer($tglJam, $tangki, $tinggiAir, $volumeAir, $tinggiBbm, $volumeBbm, $suhu, $gantiHarga, 
	$statusAtg, $tangkiIdSpbu, $ctr, $idShift){
        $myArr = array(
        	'tgl_jam' 			=> strtotime($tglJam),
        	'tangki' 			=> $tangki,
        	'tinggi_air' 		=> $tinggiAir,
        	'volume_air'		=> $volumeAir,
        	'tinggi_bbm' 		=> $tinggiBbm,
        	'volume_bbm' 		=> $volumeBbm,
        	'suhu' 				=> $suhu,
        	'ganti_harga' 		=> $gantiHarga,
        	'status_atg' 		=> $statusAtg,
        	'tangki_id_spbu'	=> $tangkiIdSpbu,
        	'nocount' 			=> $ctr,
        	'id_shift' 			=> $idShift
        );
		
        $this->db->insert('public.t_tangki_totalizer', $myArr);
        return $this->db->affected_rows();
	}
	
	public function insertMOperator($idCard, $nik, $nama, $phone, $status, $idPelanggan){
		$myArr = array(
        	'id_card'		=> $idCard,
        	'nik'			=> $nik,
			'nama'			=> $nama,
			'phone'			=> $phone,
			'status'		=> $status,
			'id_pelanggan' 	=> $idPelanggan
        );
		
        $this->db->insert('pelanggan.m_operator', $myArr);
        return $this->db->affected_rows();
	}
	
	public function insertMUnit($idPelanggan, $noUrut, $unitName, $nopol, $brand, $statusUnit, $owner, $location, $clusterUnit){
		$myArr = array(
        	'id_unit'		=> "U".$idPelanggan.$noUrut,
			'unit_name'		=> $unitName,
			'nopol'			=> $nopol,
			'brand'			=> $brand,
			'status_unit'	=> $statusUnit,
			'owner'			=> $owner,
			'location'		=> $location,
			'id_pelanggan'	=> $idPelanggan,
			'created'		=> time(date('Y-m-d H:i:s')),
			'cluster_unit'	=> $clusterUnit
        );
		
        $this->db->insert('pelanggan.m_unit', $myArr);
        return $this->db->affected_rows();
	}
	
	public function insertMRing($idRing, $clusterRing, $groupRing, $installationDate, $createdDate, $status, $sisaQuota, $idPelanggan){
		$myArr = array(
        	'id_ring'			=> $idRing,
			'cluster_ring'		=> $clusterRing,
			'group_ring'		=> $groupRing,
			'installation_date'	=> $installationDate,
			'created_date'		=> $createdDate,
			'status'			=> $status,
			'sisa_quota'		=> $sisaQuota,
			'id_pelanggan'		=> $idPelanggan,
			'jenisbbm'			=> '3',
			'jenislimitasi'		=> '1',
			'waktulimitasi'		=> '1'
        );
		
        $this->db->insert('pelanggan.m_ring', $myArr);
        return $this->db->affected_rows();
	}
	
	public function insertGroupingUnit($idUnit, $idRing, $idPelanggan, $idCard, $noUrut){
		$myArr = array(
        	'id_unit'		=> $idUnit,
			'id_ring'		=> $idRing,
			'status'		=> '1',
			'date_created'	=> time(date('Y-m-d H:i:s')),
			'id_grouping'	=> "GRP-".$noUrut."/".date('Y-m-d')."/".$idPelanggan,
			'id_card'		=> $idCard
        );
		
        $this->db->insert('pelanggan.grouping_unit', $myArr);
        return $this->db->affected_rows();
	}
	
}

?>
