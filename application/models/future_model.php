<?php
Class Future_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getCardKhusus($idSpbu, $idCardOrNik, $isUsingCard){
		if ($isUsingCard){
			$sql = "
			SELECT schedule_plant.id_card, schedule_plant.id_pelanggan, schedule_plant.id_grouping,
				schedule_plant.date_exp, schedule_plant.date_created, schedule_plant.status AS status_schedule,
				m_operator.nik, m_operator.nama, m_operator.phone, m_operator.status AS status_operator
			FROM pelanggan.schedule_plant, pelanggan.m_operator
			WHERE schedule_plant.id_pelanggan = m_operator.id_pelanggan
				AND schedule_plant.id_card = m_operator.id_card
				AND schedule_plant.id_card = '".$idCardOrNik."'";
		} else if (!$isUsingCard){
			$sql = "
			SELECT schedule_plant.id_card, schedule_plant.id_pelanggan, schedule_plant.id_grouping,
				schedule_plant.date_exp, schedule_plant.date_created, schedule_plant.status AS status_schedule,
				m_operator.nik, m_operator.nama, m_operator.phone, m_operator.status AS status_operator
			FROM pelanggan.schedule_plant, pelanggan.m_operator
			WHERE schedule_plant.id_pelanggan = m_operator.id_pelanggan
				AND schedule_plant.id_card = m_operator.id_card
				AND m_operator.nik = '".$idCardOrNik."'";
		} else {
			return $return['message'] = 'ID CARD OR NIK NOT FOUND';
		}
			
		$return = $this->db->query($sql)->result_array();
		return $return;
	}
	
	public function getGroupingUnitWithSchedule($idCard, $idPelanggan, $idRing){
		$sql = '
		SELECT grouping_unit.id_card, m_ring.id_pelanggan, grouping_unit.id_unit, grouping_unit.id_ring, 
			grouping_unit.status AS status_group, m_ring.status AS status_ring, m_unit.status_unit,
			m_ring.sisa_quota, m_ring.jenisbbm AS jenis_bbm, m_ring.jenislimitasi AS jenis_limitasi, 
			m_ring.waktulimitasi AS waktu_limitasi,
			m_unit.unit_name, m_unit.nopol, m_unit.brand, m_unit."owner"';
		$sql .= "
		FROM pelanggan.grouping_unit, pelanggan.m_unit, pelanggan.m_ring
		WHERE grouping_unit.id_ring = m_ring.id_ring
			AND grouping_unit.id_unit = m_unit.id_unit
			AND m_unit.id_pelanggan = m_ring.id_pelanggan
			AND m_unit.id_pelanggan = '".$idPelanggan."'
			AND grouping_unit.id_card = '".$idCard."'
			AND grouping_unit.id_ring = '".$idRing."'";
			
		$return = $this->db->query($sql)->result_array();
		return $return;
	}
	
	public function getGroupingUnitWithoutSchedule($idSpbu, $idCard, $idPelanggan, $idRing){
		$sql = '
		SELECT grouping_unit.id_card, m_ring.id_pelanggan, grouping_unit.id_unit, grouping_unit.id_ring, 
			grouping_unit.status AS status_group, m_ring.status AS status_ring, m_unit.status_unit,
			m_ring.sisa_quota, m_ring.jenisbbm AS jenis_bbm, m_ring.jenislimitasi AS jenis_limitasi, 
			m_ring.waktulimitasi AS waktu_limitasi,
			m_unit.unit_name, m_unit.nopol, m_unit.brand, m_unit."owner"';
		$sql .= "
		FROM pelanggan.grouping_unit, pelanggan.m_unit, pelanggan.m_ring
		WHERE grouping_unit.id_ring = m_ring.id_ring
			AND grouping_unit.id_unit = m_unit.id_unit
			AND m_unit.id_pelanggan = m_ring.id_pelanggan
			AND m_unit.id_pelanggan = '".$idPelanggan."'
			AND grouping_unit.id_card = '".$idCard."'
			AND grouping_unit.id_ring = '".$idRing."'";
			
		$return = $this->db->query($sql)->result_array();
		return $return;
	}
	
}
?>