<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
            'content' => 'backend/kelasKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
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

    public function option_jurusan()
    {
        $q = $this->md->getJurusanByTahunPelajaranID();
        $ret = '<option value="">Pilih Tahun Pelajaran</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
            }
        }
        echo $ret;
    }

    

    public function table_kelas()
    {

        $q = $this->md->dataTablesKelas();

        $data  = array();
        $no    = $_POST['start'];
        foreach ($q['data'] as $da) {
            $no++;
            $row   = array();
            $row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
            $row[] = $no;
            $row[] = $da->nama_tahun_pelajaran;
            $row[] = $da->nama_jurusan;
            $row[] = $da->nama_kelas;
            $row[] = actbtn($da->id, 'kelas');
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $q['recordTotal'],
            "recordsFiltered" => $q['recordFiltered'],
            "data" => $data,
        );

        echo json_encode($output);
        // $q = $this->md->getAllKelasNotDeleted();
        // $dt = [];
        // if ($q->num_rows() > 0) {
        //     foreach ($q->result() as $row) {
        //         $dt[] = $row;
        //     }

        //     $ret['status'] = true;
        //     $ret['data'] = $dt;
        //     $ret['message'] = '';
        // } else {
        //     $ret['status'] = false;
        //     $ret['data'] = [];
        //     $ret['message'] = 'Data tidak tersedia';
        // }


        // echo json_encode($ret);
    }

    public function save_kelas()
    {
        $id = $this->input->post('id');
        $data = [
            'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
            'nama_kelas' => $this->input->post('nama_kelas'),
            'id_jurusan' => $this->input->post('id_jurusan'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => 0
        ];

        if (!$id) {
            // Tambahkan created_at hanya jika data baru
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        // Atur validasi
        $this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'trim|required', ['required' => '%s masih kosong']);
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'trim|required', ['required' => '%s masih kosong']);
        $this->form_validation->set_rules('nama_kelas', 'Kelas', 'trim|required', ['required' => '%s masih kosong']);

        // Proses validasi
        if ($this->form_validation->run() == FALSE) {
            $ret['status'] = false;
            $ret['message'] = 'Validasi gagal';
            foreach ($_POST as $key => $value) {
                $ret['error'][$key] = form_error($key);
            }
        } else {
            // Periksa duplikasi nama kelas
            $cek = $this->md->cekKelasDuplicate($data['nama_kelas'], $data['id_jurusan'], $id);
            if ($cek->num_rows() > 0) {
                $ret['status'] = false;
                $ret['message'] = 'Kelas sudah ada';
            } else {
                // Simpan atau update data
                if ($id) {
                    $update = $this->md->updateKelas($id, $data);
                    if ($update) {
                        $ret['status'] = true;
                        $ret['message'] = 'Data berhasil diupdate';
                    } else {
                        $ret['status'] = false;
                        $ret['message'] = 'Data gagal diupdate';
                    }
                } else {
                    $insert = $this->md->saveKelas($data);
                    if ($insert) {
                        $ret['status'] = true;
                        $ret['message'] = 'Data berhasil disimpan';
                    } else {
                        $ret['status'] = false;
                        $ret['message'] = 'Data gagal disimpan';
                    }
                }
            }
        }

        // Kembalikan respons dalam format JSON
        echo json_encode($ret);
    }


    public function edit_kelas()
    {
        $id = $this->input->post('id');
        $q = $this->md->getKelasByID($id);
        if ($q->num_rows() > 0) {
            $ret['status'] = true;
            $ret['data'] = $q->row();
            $ret['message'] = '';
            $ret['query'] = $this->db->last_query();
        } else {
            $ret['status'] = false;
            $ret['data'] = [];
            $ret['message'] = 'Data tidak tersedia';
        }
        echo json_encode($ret);
    }

    public function delete_kelas()
    {
        $id = $this->input->post('id');
        $data['deleted_at'] = time();
        $q = $this->md->updateKelas($id, $data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil dihapus';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal dihapus';
        }
        echo json_encode($ret);
    }
}
