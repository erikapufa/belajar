<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftran_ulang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md');
    }

    public function index()
    {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/pendaftaranUlangKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }
}
