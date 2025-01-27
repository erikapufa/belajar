<?php
defined('BASEPATH') or exit('Akses langsung tidak diperbolehkan');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();  // Memanggil konstruktor parent dengan benar
    }

    public function index()
    {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/adminKonten',
            'title' => 'Admin',
        );
        $this->load->view('template', $data);  // Memuat tampilan 'template'
    }

    public function save()
    {
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        $insert = $this->User_model->insertUser($data);

        if ($insert) {
            redirect('Admin');  // Arahkan ke halaman dashboard setelah data berhasil disimpan
        } else {
            echo 'Data gagal disimpan';
        }
    }
}
