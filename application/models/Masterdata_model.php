<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata_model extends MY_Model
{

	protected $tableTahunPelajaran = 'data_tahun_pelajaran';
	protected $tableKelas = 'data_kelas';
	protected $tableJurusan = 'data_jurusan';
	protected $tableBiaya = 'data_biaya';
	protected $tableHargaBiaya = 'data_harga_biaya';
	protected $tableSeragam = 'data_seragam';
	protected $tableStok = 'data_stok';
	protected $table = 'user';
	protected $tablePendaftaranAwal = 'pendaftaran_awal';
	// protected $tableOrangTua = 'data_orang_tua';
	// protected $tableSiswa = 'data_siswa';
	public function __construct()
	{
		parent::__construct();
	}

	//Data User
	public function getAllUserNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->table);
	}

	public function cekUsernameDuplicate($username, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('username', $username);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->table);
	}

	public function getUsernameByID($id)
	{
		$this->db->where($this->table . '.id', $id);
		return $this->db->get($this->table);
	}

	public function updateUser($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function insertUser($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function getAllTahunPelajaran()
	{
		return  $this->db->get($this->tableTahunPelajaran);
	}

	public function getAllTahunPelajaranNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->tableTahunPelajaran);
	}

	public function dataTablesTahunPelajaran()
	{
		$col_order 	= array($this->tableTahunPelajaran . '.id', $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$col_search = array($this->tableTahunPelajaran . '.id', $this->tableTahunPelajaran . '.nama_tahun_pelajaran', $this->tableTahunPelajaran . '.status_tahun_pelajaran');
		$order 		= array($this->tableTahunPelajaran . '.id' => 'desc');
		$filter 	= array($this->tableTahunPelajaran . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableTahunPelajaran);
		$this->db->select($this->tableTahunPelajaran . '.*');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function getNamaTahunPelajaran($nama_tahun_pelajaran)
	{
		$q = $this->db->where('nama_tahun_pelajaran', $nama_tahun_pelajaran)->get($this->tableTahunPelajaran);
		return $q;
	}

	public function getTahunPelajaranByID($id)
	{

		return $this->db->where('id', $id)->get($this->tableTahunPelajaran);
	}

	public function cekTahunPelajaranDuplicate($nama_tahun_pelajaran, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('nama_tahun_pelajaran', $nama_tahun_pelajaran);
		return $this->db->get($this->tableTahunPelajaran);
	}

	public function deleteTahunPelajaran($id = null)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableTahunPelajaran);
		return $this->db->affected_rows();
	}

	public function updateTahunPelajaran($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableTahunPelajaran, $data);
		return $this->db->affected_rows();
	}

	public function insertTahunPelajaran($data)
	{
		$this->db->insert($this->tableTahunPelajaran, $data);
		return $this->db->insert_id();
	}




	public function getAllJurusan()
	{
		return  $this->db->get($this->tableJurusan);
	}

	public function getJurusanByID($id)
	{

		$this->db->where('id', $id);
		return $this->db->get($this->tableJurusan);
	}

	public function dataTablesJurusan()
	{
		$col_order 	= array($this->tableJurusan . '.id', $this->tableJurusan . '.nama_jurusan');
		$col_search = array($this->tableJurusan . '.id', $this->tableJurusan . '.nama_jurusan', $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$order 		= array($this->tableJurusan . '.id' => 'desc');
		$filter 	= array($this->tableJurusan . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableJurusan);
		$this->db->select($this->tableJurusan . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function getAllJurusanNotDeleted()
	{
		$this->db->select($this->tableJurusan . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$this->db->where($this->tableJurusan . '.deleted_at', 0);
		return $this->db->get($this->tableJurusan);
	}

	public function cekJurusanDuplicate($nama_jurusan, $id_tahun_pelajaran, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('id_tahun_pelajaran =', $id_tahun_pelajaran);
		$this->db->where('nama_jurusan', $nama_jurusan);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableJurusan);
	}

	public function updateJurusan($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableJurusan, $data);
		return $this->db->affected_rows();
	}

	public function insertJurusan($data)
	{
		$this->db->insert($this->tableJurusan, $data);
		return $this->db->insert_id();
	}


	//Data Kelas

	public function getAllKelas()
	{
		return  $this->db->get($this->tableKelas);
	}

	public function getKelasByID($id)
	{;
		$this->db->where($this->tableKelas . '.id', $id);
		return $this->db->get($this->tableKelas);
	}


	public function dataTablesKelas()
	{
		$col_order 	= array($this->tableKelas . '.id', $this->tableKelas . '.nama_kelas');
		$col_search = array($this->tableKelas . '.id', $this->tableKelas . '.nama_kelas', $this->tableTahunPelajaran . '.nama_tahun_pelajaran', $this->tableJurusan . '.id', $this->tableJurusan . '.nama_jurusan');
		$order 		= array($this->tableKelas . '.id' => 'desc');
		$filter 	= array($this->tableKelas . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableKelas);
		$this->db->select($this->tableKelas . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran,' . $this->tableJurusan . '.nama_jurusan');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tableKelas . '.id_jurusan');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function getAllKelasNotDeleted()
	{
		$this->db->select($this->tableKelas . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableJurusan . '.nama_jurusan');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tableKelas . '.id_jurusan');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$this->db->where($this->tableKelas . '.deleted_at', 0);
		return $this->db->get($this->tableKelas);
	}

	public function getJurusanByTahunPelajaranID($id)
	{
		$this->db->where($this->tableJurusan . '.deleted_at', 0);
		$this->db->where('id_tahun_pelajaran', $id);
		return $this->db->get($this->tableJurusan);
	}
	public function getKelasByTahunPelajaranID($id)
	{
		$this->db->where($this->tableKelas . '.deleted_at', 0);
		$this->db->where('id_tahun_pelajaran', $id);
		return $this->db->get($this->tableKelas);
	}
	public function cekKelasDuplicate($nama_kelas,  $id_jurusan, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('id_jurusan', $id_jurusan);
		$this->db->where('nama_kelas', $nama_kelas);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableKelas);
	}


	public function updateKelas($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableKelas, $data);
		return $this->db->affected_rows();
	}

	public function saveKelas($data)
	{
		$this->db->insert($this->tableKelas, $data);
		return $this->db->insert_id();
	}

	// Data Biaya
	public function getAllBiayaNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->tableBiaya);
	}

	public function dataTablesBiaya()
	{
		$col_order 	= array($this->tableBiaya . '.id', $this->tableBiaya . '.nama_biaya');
		$col_search = array($this->tableBiaya . '.id', $this->tableBiaya . '.nama_biaya');
		$order 		= array($this->tableBiaya . '.id' => 'desc');
		$filter 	= array($this->tableBiaya . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableBiaya);
		$this->db->select($this->tableBiaya . '.*, ');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function cekBiayaDuplicate($nama_biaya, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('nama_biaya', $nama_biaya);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableBiaya);
	}

	public function getBiayaByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableBiaya);
	}

	public function updateBiaya($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableBiaya, $data);
		return $this->db->affected_rows();
	}


	public function insertBiaya($data)
	{
		$this->db->insert($this->tableBiaya, $data);
		return $this->db->insert_id();
	}



	// data harga biaya

	public function getAllHargaBiaya()
	{
		$this->db->select($this->tableHargaBiaya . '.*, ' . $this->tableBiaya . '.nama_biaya ,' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$this->db->join($this->tableBiaya, $this->tableBiaya . '.id = ' . $this->tableHargaBiaya . '.id_biaya', 'left');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableHargaBiaya . '.id_tahun_pelajaran', 'left');
		$this->db->where($this->tableHargaBiaya . '.deleted_at', 0);
		return $this->db->get($this->tableHargaBiaya);
	}


	public function dataTablesHargaBiaya()
	{
		$col_order 	= array($this->tableHargaBiaya . '.id', $this->tableHargaBiaya . '.id_biaya');
		$col_search = array($this->tableHargaBiaya . '.id', $this->tableBiaya . '.nama_biaya', $this->tableHargaBiaya . '.harga');
		$order 		= array($this->tableHargaBiaya . '.id' => 'desc');
		$filter 	= array($this->tableHargaBiaya . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableHargaBiaya);
		$this->db->select($this->tableHargaBiaya . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran,' . $this->tableBiaya . '.nama_biaya,');
		$this->db->join($this->tableBiaya, $this->tableBiaya . '.id = ' . $this->tableHargaBiaya . '.id_biaya', 'left');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableHargaBiaya . '.id_tahun_pelajaran', 'left');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function cekHargaBiayaDuplicate($id_biaya, $id_tahun_pelajaran, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('id_biaya', $id_biaya);
		$this->db->where('id_tahun_pelajaran', $id_tahun_pelajaran);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableHargaBiaya);
	}

	public function getBiayaNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableBiaya);
	}

	public function getHargaBiayaByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableHargaBiaya);
	}

	public function insertHargaBiaya($data)
	{
		$this->db->insert($this->tableHargaBiaya, $data);
		return $this->db->insert_id();
	}

	public function updateHargaBiaya($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableHargaBiaya, $data);
		return $this->db->affected_rows();
	}


	// data seragam
	public function getAllSeragamNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->tableSeragam);
	}

	public function getSeragamByID($id)
	{
		return $this->db->where('id', $id)->get($this->tableSeragam);
	}

	public function dataTablesSeragam()
	{
		$col_order 	= array($this->tableSeragam . '.id', $this->tableSeragam . '.nama_seragam');
		$col_search = array($this->tableSeragam . '.id', $this->tableSeragam . '.nama_seragam');
		$order 		= array($this->tableSeragam . '.id' => 'desc');
		$filter 	= array($this->tableSeragam . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableSeragam);
		$this->db->select($this->tableSeragam . '.*, ');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function cekSeragamDuplicate($nama_seragam, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('nama_seragam', $nama_seragam);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableSeragam);
	}

	public function updateSeragam($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableSeragam, $data);
		return $this->db->affected_rows();
	}


	public function insertSeragam($data)
	{
		$this->db->insert($this->tableSeragam, $data);
		return $this->db->insert_id();
	}




	//data stok

	public function getAllStokNotDeleted()
	{
		$this->db->select($this->tableStok . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableSeragam . '.nama_seragam,');
		$this->db->join($this->tableSeragam, $this->tableSeragam . '.id = ' . $this->tableStok . '.id_seragam');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableStok . '.id_tahun_pelajaran');
		$this->db->where($this->tableStok . '.deleted_at', 0);
		return $this->db->get($this->tableStok);
	}

	public function dataTablesStok()
	{
		$col_order 	= array($this->tableStok . '.id', $this->tableStok . '.id_seragam');
		$col_search = array($this->tableStok . '.id', $this->tableSeragam . '.nama_seragam');
		$order 		= array($this->tableStok . '.id' => 'desc');
		$filter 	= array($this->tableStok . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tableStok);
		$this->db->select($this->tableStok . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran,' . $this->tableSeragam . '.nama_seragam');
		$this->db->join($this->tableSeragam, $this->tableSeragam . '.id = ' . $this->tableStok . '.id_seragam');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableStok . '.id_tahun_pelajaran');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function cekStokDuplicate($id_tahun_pelajaran, $ukuran, $id_seragam, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('id_tahun_pelajaran', $id_tahun_pelajaran);
		$this->db->where('id_seragam', $id_seragam);
		$this->db->where('ukuran', $ukuran);
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableStok);
	}

	public function updateStok($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableStok, $data);
		return $this->db->affected_rows();
	}

	public function insertStok($data)
	{
		$this->db->insert($this->tableStok, $data);
		return $this->db->insert_id();
	}

	public function getStokByID($id)
	{
		// $this->db->select($this->tableStok . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableSeragam . '.nama_seragam,');
		// $this->db->join($this->tableSeragam, $this->tableSeragam . '.id = ' . $this->tableStok . '.id_seragam');
		// $this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableStok . '.id_tahun_pelajaran');
		// $this->db->where($this->tableStok . '.deleted_at', 0);
		$this->db->where($this->tableStok . '.id', $id);
		return $this->db->get($this->tableStok);
	}



	//pendaftaran awal
	public function getAllPendaftaranAwalNotDeleted()
	{
		$this->db->select($this->tablePendaftaranAwal . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableJurusan . '.nama_jurusan,' . $this->tableKelas . '.nama_kelas');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tablePendaftaranAwal . '.id_jurusan');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tablePendaftaranAwal . '.id_tahun_pelajaran');
		$this->db->join($this->tableKelas, $this->tableKelas . '.id = ' . $this->tablePendaftaranAwal . '.id_kelas');
		$this->db->where($this->tablePendaftaranAwal . '.deleted_at', 0);
		return $this->db->get($this->tablePendaftaranAwal);
	}

	public function getPendaftaranAwalByID($id)
	{
		$this->db->where($this->tablePendaftaranAwal . '.id', $id);
		return $this->db->get($this->tablePendaftaranAwal);
	}

	public function dataTablesPendaftaranAwal()
	{
		$col_order 	= array($this->tablePendaftaranAwal . '.id', $this->tablePendaftaranAwal . '.no_pendaftaran');
		$col_search = array($this->tablePendaftaranAwal . '.id', $this->tablePendaftaranAwal . '.nama_siswa');
		$order 		= array($this->tablePendaftaranAwal . '.id' => 'desc');
		$filter 	= array($this->tablePendaftaranAwal . '.deleted_at' => 0);
		$group_by 	= null;
		//$query = $this->tableTahunPelajaran;
		$this->db->from($this->tablePendaftaranAwal);
		$this->db->select($this->tablePendaftaranAwal . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableJurusan . '.nama_jurusan,' . $this->tableKelas . '.nama_kelas');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tablePendaftaranAwal . '.id_jurusan');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tablePendaftaranAwal . '.id_tahun_pelajaran');
		$this->db->join($this->tableKelas, $this->tableKelas . '.id = ' . $this->tablePendaftaranAwal . '.id_kelas');
		$query = substr($this->db->get_compiled_select(), 6);
		$data = $this->get_datatables($query, $col_order, $col_search, $order,  $filter, $group_by);

		$recordTotal =  $this->countAllQueryFiltered($query, $filter);
		$recordFiltered =  $this->count_filtered($query, $filter);
		return array('data' => $data, 'recordTotal' => $recordTotal, 'recordFiltered' => $recordFiltered);
	}

	public function updatePendaftaranAwal($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tablePendaftaranAwal, $data);
		return $this->db->affected_rows();
	}

	public function insertPendaftaranAwal($data)
	{
		$this->db->insert($this->tablePendaftaranAwal, $data);
		return $this->db->insert_id();
	}

	public function getKelasByJurusanID($id)
	{
		$this->db->where('deleted_at', 0);
		$this->db->where('id_jurusan', $id);
		return $this->db->get($this->tableKelas);
	}

	public function getAllTahunPelajaranStatusNNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		$this->db->where('status_tahun_pelajaran', 1);
		return $this->db->get($this->tableTahunPelajaran);
	}


	public function getTahunPelajaranNama($id)
	{
		$this->db->select('nama_tahun_pelajaran');
		$this->db->from('data_tahun_pelajaran');  
		$this->db->where('id', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_tahun_pelajaran; 
		} else {
			return null;  
		}
	}

	public function getJurusanNama($id)
	{
		$this->db->select('nama_jurusan');
		$this->db->from('data_jurusan');  
		$this->db->where('id', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_jurusan; 
		} else {
			return null; 
		}
	}


	public function getNamaJurusanByIdJurusan($id_jurusan)
	{
		$this->db->select('nama_jurusan');
		$this->db->from($this->tableJurusan);
		$this->db->where('id', $id_jurusan);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_jurusan; 
		}

		return null;
	}
	public function getNamaTahunPelajaranByIdTahunPelajaran($id_tahun_pelajaran)
	{
		$this->db->select('nama_tahun_pelajaran');
		$this->db->from($this->tableTahunPelajaran);
		$this->db->where('id', $id_tahun_pelajaran);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_tahun_pelajaran; 
		}

		return null; 
	}

	public function formatTahunPelajaran($nama_tahun_pelajaran)
	{
	
		$tahun = explode('-', $nama_tahun_pelajaran);

		if (count($tahun) < 2) {
			return '0000';
		}

		$tahun_awal = substr($tahun[0], -2); 
		$tahun_akhir = substr($tahun[1], -2); 

		return $tahun_awal . $tahun_akhir;
	}


	public function hitungUrutanPendaftaran($id_tahun_pelajaran, $id_jurusan)
	{
		$this->db->select_max('id'); 
		$this->db->where('id_tahun_pelajaran', $id_tahun_pelajaran);
		$this->db->where('id_jurusan', $id_jurusan);
		$query = $this->db->get('pendaftaran_awal');
		$result = $query->row();

		if (empty($result) || empty($result->id)) {
			return 1;
		}

		return $result->id + 1;
	}


	public function generate($id_jurusan, $id_tahun_pelajaran, $id)
	{
		$nama_jurusan = $this->getNamaJurusanByIdJurusan($id_jurusan);
		$nama_tahun_pelajaran = $this->getNamaTahunPelajaranByIdTahunPelajaran($id_tahun_pelajaran);

		$format_tahun = $this->formatTahunPelajaran($nama_tahun_pelajaran);

		$no_pendaftaran = $format_tahun . '-' . $nama_jurusan . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);

		return $no_pendaftaran;
	}

	public function getById($tablePendaftaranAwal, $id)
	{
		$this->db->where('id', $id);  
		$query = $this->db->get($tablePendaftaranAwal); 
		return $query->row();  
	}
}