<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_client extends CI_Model
{

	function __construct() {
		parent::__construct();
		$this->load->library('datatables');
	}


	public function json() {
		$user        = $this->session->userdata('user_rinci');
		// dump($user[0]['type_user']);
		$requestData = $_REQUEST;
		$this->datatables->select('id_user,username,password,nama,phone,active');
		$this->datatables->from('usys.m_user');
		$this->datatables->add_column('view', '<a id="hapus_user" onclick="hapus($1)" href="#">Hapus</a> | <a onclick="blokir($1)" href="#" data-toggle="tooltip" title="Blokir"><i class="fa fa-minus-square" aria-hidden="true"></i></a> | <a onclick="edit($1)" href="#" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>','id_user');

		// filtering user berdasarkan cluster spbu
		if($user[0]['type_user'] == '3') {
			$this->datatables->where("id_cluster='".$user[0]['id_cluster']."' and type_user='".$user[0]['type_user']."'");
		}

		// filtering user berdasarkan username
		if( !empty($requestData['columns'][1]['search']['value'])) {
			$this->datatables->where("nama LIKE '".$requestData['columns'][1]['search']['value']."%'");
		}
		
		// filtering user berdasarkan nama
		if( !empty($requestData['columns'][0]['search']['value'])) {
			$this->datatables->where("username LIKE '%".$requestData['columns'][0]['search']['value']."%'");
		}
		
		return $this->datatables->generate('json','');
	}
	
	public function getdepartemen() {
		return $this->db->get('usys.m_departemen');
	}
	
	public function getcountuser() {
		return $this->db->count_all('usys.m_user');
	}

	public function getclinetfromcluster($id_cluster) {
		$this->db->where(array('id_cluster_pelanggan'=>"$id_cluster"));
		$i = $this->db->get('public.m_pelanggan');
		return $i->result();
	}

	public function getclinetfromcluster_level($id_cluster,$id_user) {
		$this->db->SELECT('c.*');
		$this->db->from('usys.m_user a');
		$this->db->join('pelanggan.s_hakuser_pelanggan b','cast(a.id_cluster as text)=b.id_cluster_pelanggan','INNER',FALSE);
		//$this->db->join('pelanggan.s_hakuser_pelanggan b','cast(a.id_user as text) = b.id_user','INNER',FALSE);
		$this->db->join('public.m_pelanggan c','b.id_pelanggan = c.id_pelanggan','INNER',FALSE);
		$this->db->where(array('a.id_cluster'=>"$id_cluster",'a.id_user'   =>"$id_user"));
		$i = $this->db->get();
		//dump($i);
		return $i->result();
	}

	public function checkinventory($id_client) {
		$sql = "SELECT a.* FROM pelanggan.m_inventory_spbu a
		WHERE a.id_pelanggan='$id_client'";
		return rst2Array($sql);
	}

	public function checkgeneral($id_cluster_pelanggan) {
		$sql = "SELECT * from pelanggan.m_general where id_cluster_pelanggan='$id_cluster_pelanggan'";
		return rst2Array($sql);
	}

	public function get_general($id_cluster_pelanggan) {
		$sql = "select * from pelanggan.m_general where id_cluster_pelanggan=cast($id_cluster_pelanggan as text)";
		return rst2Array($sql);
	}

	public function getunit($id_pelanggan) {
		$sql = "SELECT * from pelanggan.m_unit where id_pelanggan='$id_pelanggan'";
		return rst2Array($sql);
	}

	public function getring($id_pelanggan) {
		$sql = "SELECT * from pelanggan.m_ring where id_pelanggan='$id_pelanggan'";
		return rst2Array($sql);
	}

	public function getoperator($id_pelanggan) {
		$sql = "SELECT * from pelanggan.m_operator where id_pelanggan='$id_pelanggan'";
		return rst2Array($sql);
	}

	public function getcount($table,$condition = '') {
		if($condition != null) {
			$this->db->where($condition);
			return $this->db->count_all($table);
		} else {
			return $this->db->count_all($table);
		}
	}

	public function listgroup($id_pelanggan) { 
		$this->datatables->select('*,id_grouping');
		$this->datatables->from('pelanggan.grouping_unit');
		$this->datatables->join('pelanggan.m_unit','pelanggan.grouping_unit.id_unit=pelanggan.m_unit.id_unit');
		$this->datatables->join('pelanggan.m_ring','pelanggan.grouping_unit.id_ring=pelanggan.m_ring.id_ring');
		$this->datatables->where("pelanggan.grouping_unit.id_grouping Like '%/".$id_pelanggan."%'" );
		$this->datatables->add_column('view', '<a id="hapus_user" onclick="hapus(\'$1\')" href="#">Hapus</a> | <a onclick="blokir(\'$1\')" href="#" data-toggle="tooltip" title="Blokir"><i class="fa fa-minus-square" aria-hidden="true"></i></a> | <a onclick="edit(\'$1\')" href="#" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>','id_grouping');
		return $this->datatables->generate('json','');
	}


	public function listunit($id_pelanggan) { 
		$this->datatables->select('*,id_unit');
		$this->datatables->from('pelanggan.m_unit');
		$this->datatables->join('public.m_pelanggan','public.m_pelanggan.id_pelanggan=pelanggan.m_unit.id_pelanggan');
		$this->datatables->join('pelanggan.m_divisi','pelanggan.m_divisi.id_divisi=pelanggan.m_unit.owner');
		$this->datatables->where("pelanggan.m_unit.id_pelanggan = '".$id_pelanggan."'" );
		$this->datatables->add_column('view', '<a id="hapus_user" onclick="hapus(\'$1\')" href="#">Hapus</a> | <a onclick="blokir(\'$1\');" href="#" data-toggle="tooltip" title="Blokir"><i class="fa fa-minus-square" aria-hidden="true"></i></a>','id_unit');
		return $this->datatables->generate('json','');
	}

	public function listoperator($id_pelanggan) {
		$this->datatables->select('*,id_card');
		$this->datatables->from('pelanggan.m_operator');
		$this->datatables->where("pelanggan.m_operator.id_pelanggan = '".$id_pelanggan."'" );
		$this->datatables->add_column('view', '<a id="hapus_user" onclick="hapus(\'$1\')" href="#">Hapus</a> | <a onclick="blokir(\'$1\');" href="#" data-toggle="tooltip" title="Blokir"><i class="fa fa-minus-square" aria-hidden="true"></i></a>','id_card');
		return $this->datatables->generate('json','');
	}

	public function listgroupdetail($id_pelanggan) {
		$sql = "SELECT * FROM pelanggan.grouping_unit a
		INNER JOIN pelanggan.m_unit b on a.id_unit=b.id_unit
		WHERE a.id_grouping like'%/$id_pelanggan%'";
		return rst2Array($sql);
	}

	public function cari_data($id) {
		$sql = "SELECT * FROM pelanggan.grouping_unit a
		INNER JOIN pelanggan.m_ring b on a.id_ring=b.id_ring
		INNER JOIN pelanggan.m_unit c on a.id_unit=c.id_unit
		INNER JOIN pelanggan.m_cluster_unit d on c.cluster_unit=d.id_cluster
		inner join pelanggan.m_brand e on c.brand=e.id_brand
		inner join pelanggan.m_divisi f on c.owner=f.id_divisi
		INNER JOIN (SELECT g.odometer ,g.no_ring FROM public.t_transaksi g WHERE g.no_ring='$id' order by g.tgl_jam DESC LIMIT 1) h on h.no_ring=b.id_ring
		WHERE a.id_ring='$id'";
		return rst2Array($sql);
	}


	public function daftar_transaksi($id_pelanggan) {
		// dump($id_pelanggan);
		$this->datatables->select('*,to_timestamp(cast(tgl_jam as double precision)) as waktu');
		$this->datatables->from('public.t_transaksi a');
		/*  $this->datatables->join('pelanggan.grouping_unit b','a.no_ring=b.id_ring');
		$this->datatables->join('pelanggan.m_unit c','b.id_unit=c.id_unit');
		$this->datatables->join('public.m_pelanggan d','d.id_pelanggan=a.id_spbu');
		$this->datatables->join('pelanggan.m_ring e','e.id_ring=b.id_ring');*/
		$this->datatables->where("a.id_spbu = '".$id_pelanggan."'" );
		return $this->datatables->generate('json',''); 
	}

	public function daftar_ring($id_pelanggan) {
		$this->datatables->select('*,to_timestamp(a.installation_date) as instal,to_timestamp(a.created_date) as created,id_ring');
		$this->datatables->from('pelanggan.m_ring a');
		$this->datatables->join('pelanggan.m_cluster_unit b','a.cluster_ring=b.id_cluster');
		$this->datatables->join('pelanggan.m_group_limit c','a.group_ring=c.id_group');
		$this->datatables->where("a.id_pelanggan = '".$id_pelanggan."'" );
		$this->datatables->add_column('view', '<a id="hapus_user" onclick="hapus(\'$1\')" href="#">Hapus</a> | <a onclick="blokir(\'$1\');" href="#" data-toggle="tooltip" title="Blokir"><i class="fa fa-minus-square" aria-hidden="true"></i></a>','id_ring');
		return $this->datatables->generate('json',''); 
	}

}
