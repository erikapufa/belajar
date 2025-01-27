<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md');
        $this->load->helper('actionbtn');
    }

    public function index()
    {

        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/jurusanKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }

    public function table_jurusan()
    {

        $q = $this->md->dataTablesJurusan();

        $data  = array();
        $no    = $_POST['start'];
        foreach ($q['data'] as $da) {
            $no++;
            $row   = array();
            $row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
            $row[] = $no;
            $row[] = $da->nama_tahun_pelajaran;
            $row[] = $da->nama_jurusan;
            $row[] = actbtn($da->id, 'jurusan');
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $q['recordTotal'],
            "recordsFiltered" => $q['recordFiltered'],
            "data" => $data,
        );

        echo json_encode($output);
	
    }

    public function option_tahun_pelajaran()
    {
        $q = $this->md->getAllTahunPelajaranNotDeleted();
        $ret = '<option value="">Pilih Tahun Pelajaran</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
            }
        }
        echo $ret;
    }

    public function edit_jurusan()
    {

        $id = $this->input->post('id');
        $q = $this->md->getJurusanByID($id);

        if ($q->num_rows() > 0) {
            $ret = array(
                'status' => true,
                'data' => $q->row(),
                'message' => '',
            );
        } else {
            $ret = array(
                'status' => false,
                'data' => [],
                'message' => 'Data tidak ditemukan',
                'query' => $this->db->last_query()
            );
        }

        echo json_encode($ret);
    }


    public function delete_jurusan()
    {

        $id = $this->input->post('id');
        $data['deleted_at'] = time();
        $q = $this->md->updateJurusan($id, $data);

        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil dihapus';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal dihapus';
        }

        echo json_encode($ret);
    }
    public function save_jurusan()
    {
        $id = $this->input->post('id');
        $data['nama_jurusan'] = $this->input->post('nama_jurusan');
        $data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = 0;

        // Set validation rules
        $this->form_validation->set_rules('nama_jurusan', 'Jurusan', 'trim|required', array('required' => '%s masih kosong'));

        // Run validation
        if ($this->form_validation->run() == FALSE) {
            $ret['status'] = false;
            foreach ($_POST as $key => $value) {
                $ret['error'][$key] = form_error($key);
            }
        } else {
            if ($id) {
                $update = $this->md->updateJurusan($id, $data);
                if ($update) {
                    $ret = array(
                        'status' => true,
                        'message' => 'Data berhasil diupdate'
                    );
                } else {
                    $ret = array(
                        'status' => false,
                        'message' => 'Data gagal diupdate'
                    );
                }
            } else {
                $insert = $this->md->insertJurusan($data);

                if ($insert) {
                    $ret = array(
                        'status' => true,
                        'message' => 'Data berhasil disimpan'
                    );
                } else {
                    $ret = array(
                        'status' => false,
                        'message' => 'Data gagal disimpan'
                    );
                }
            }
        }

        // Return the response in JSON format
        echo json_encode($ret);
    }
}