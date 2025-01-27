<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_awal extends CI_Controller
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
            'content' => 'backend/pendaftaranAwalKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }


    public function table_pendaftaran_awal()
    {
        $q = $this->md->dataTablesPendaftaranAwal();

        $data  = array();
        $no    = $_POST['start'];
        foreach ($q['data'] as $da) {
            $no++;
            $row   = array();
            $row[] = '<input type="checkbox" class="data-check" value="' . htmlspecialchars($da->id) . '">';
            $row[] = $no;
            $row[] = htmlspecialchars($da->no_pendaftaran);
            $row[] = htmlspecialchars($da->nama_siswa);
            $row[] = htmlspecialchars($da->jenis_kelamin);
            $row[] = htmlspecialchars($da->asal_sekolah);
            $row[] = htmlspecialchars($da->email);
            $row[] = htmlspecialchars($da->no_telepon);
            $row[] = htmlspecialchars($da->nama_ayah);
            $row[] = htmlspecialchars($da->no_telepon_ayah);
            $row[] = htmlspecialchars(actbtn($da->id, 'pendaftaran_awal'));
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $q['recordTotal'],
            "recordsFiltered" => $q['recordFiltered'],
            "data" => $data,
        );

        // Tambahkan header JSON dan debugging error
        header('Content-Type: application/json');
        echo json_encode($output);

        // Debug jika JSON error
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('JSON Error: ' . json_last_error_msg());
        }
    }



    public function save_pendaftaran_awal()
    {


        $id = $this->input->post('id');

        // data pendaftaran
        $data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
        $data['id_jurusan'] = $this->input->post('id_jurusan');
        $urutan = $this->md->hitungUrutanPendaftaran($data['id_tahun_pelajaran'], $data['id_jurusan']);
        $no_pendaftaran = $this->md->generate($data['id_jurusan'], $data['id_tahun_pelajaran'], $urutan);
        $data['no_pendaftaran'] = $no_pendaftaran;
        $data['id_kelas'] = $this->input->post('id_kelas');


        // data siswa
        $data['nama_siswa'] = $this->input->post('nama_siswa');
        $data['nik'] = $this->input->post('nik');
        $data['agama'] = $this->input->post('agama');
        $data['nisn'] = $this->input->post('nisn');
        $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
        $data['tempat_lahir'] = $this->input->post('tempat_lahir');
        $data['tanggal_lahir'] = $this->input->post('tanggal_lahir');
        $data['alamat_siswa'] = $this->input->post('alamat_siswa');
        $data['no_telepon_siswa'] = $this->input->post('no_telepon_siswa');
        $data['email'] = $this->input->post('email');
        $data['asal_sekolah'] = $this->input->post('asal_sekolah');

        // data orang tua
        $data['nama_ayah'] = $this->input->post('nama_ayah');
        $data['nama_ibu'] = $this->input->post('nama_ibu');
        $data['no_telepon_ayah'] = $this->input->post('no_telepon_ayah');
        $data['no_telepon_ibu'] = $this->input->post('no_telepon_ibu');
        $data['pekerjaan_ayah'] = $this->input->post('pekerjaan_ayah');
        $data['pekerjaan_ibu'] = $this->input->post('pekerjaan_ibu');
        $data['nama_wali'] = $this->input->post('nama_wali');
        $data['no_telepon_wali'] = $this->input->post('no_telepon_wali');
        $data['pekerjaan_wali'] = $this->input->post('pekerjaan_wali');
        $data['alamat_wali'] = $this->input->post('alamat_wali');
        $data['sumber_informasi'] = $this->input->post('sumber_informasi');
        $data['alamat_orang_tua'] = $this->input->post('alamat_orang_tua');

        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = 0;

        $this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required', array('required' => '%s harus diisi'));

        $this->form_validation->set_rules('nama_siswa', 'Nama', 'trim|required|max_length[40]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 40 karakter'));
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|min_length[16]|max_length[16]', array('required' => '%s harus diisi', 'min_length' => 'Tidak boleh kurang dari 16 angka', 'max_length' => 'Tidak boleh lebih dari 16 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('agama', 'Agama', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('nisn', 'NISN', 'trim|required|numeric|max_length[10]|min_length[10]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 10 angka', 'min_length' => 'Tidak boleh kurang dari 10 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required|exact_length[10]', array('required' => '%s harus diisi', 'exact_length' => 'Format Salah'));
        $this->form_validation->set_rules('alamat_siswa', 'Alamat', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('no_telepon_siswa', 'No Telepon', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => '%s harus diisi', 'valid_email' => 'format email salah'));
        $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'trim|required', array('required' => '%s harus diisi'));

        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required|max_length[40]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 40 karakter'));
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required|max_length[40]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 40 karakter'));
        $this->form_validation->set_rules('no_telepon_ayah', 'No Telepon Ayan', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('no_telepon_ibu', 'No Telepon Ibu', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('no_telepon_wali', 'No Telepon Wali', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('alamat_orang_tua', 'Alamat Orang Tua', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('sumber_informasi', 'Sumber Informasi', 'trim|required', array('required' => '%s harus diisi'));

        if ($this->form_validation->run() == FALSE) {
            $ret['status'] = false;
            foreach ($_POST as $key => $value) {
                $ret['error'][$key] = form_error($key);
            }
        } else {
            if ($id) {
                $update = $this->md->updatePendaftaranAwal($id, $data);
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
                $data['created_at'] = date('Y-m-d H:i:s');
                $insert = $this->md->insertPendaftaranAwal($data);

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
        echo json_encode($ret);
    }


    public function edit_pendaftaran_awal()
    {
        $id = $this->input->post('id');
        $q = $this->md->getPendaftaranAwalByID($id);

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


    public function delete_pendaftaran_awal()
    {
        $id = $this->input->post('id');
        $data['deleted_at'] = time();
        $q = $this->md->updatePendaftaranAwal($id, $data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil dihapus';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal dihapus';
        }
        echo json_encode($ret);
    }


    public function option_tahun_pelajaran()
    {
        $q = $this->md->getAllTahunPelajaranStatusNNotDeleted();
        $ret = '<option value="">Pilih Tahun Pelajaran</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
            }
        }
        echo $ret;
    }

    public function option_jurusan($id)
    {

        $q = $this->md->getJurusanByTahunPelajaranID($id);
        $ret = '<option value="">Pilih Jurusan</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
            }
        }
        echo $ret;
    }
    public function option_kelas($id)
    {

        $q = $this->md->getKelasByJurusanID($id);
        $ret = '<option value="">Pilih Kelas</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_kelas . '</option>';
            }
        }
        echo $ret;
    }

    public function get_detail_pendaftaran_awal($id)
    {
        // Mengambil data dari database berdasarkan ID
        $q = $this->md->getPendaftaranAwalByID($id);

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
}
