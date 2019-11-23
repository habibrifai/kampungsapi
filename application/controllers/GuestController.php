<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuestController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KegiatanModel', 'kegiatan');
        $this->load->model('TiketModel', 'tiket');
        if ($this->session->role == 1) {
            redirect(base_url('admin'), 'refresh');
        }
    }

    public function index()
    {
        $data['header']['title'] = "Dashboard";
        return $this->load->view('user/dashboard/Dashboard', $data);
    }

    public function kegiatan()
    {
        $data['header']['title'] = "Kegiatan";
        $data['body'] = $this->kegiatan->getKegiatan();
        return $this->load->view('user/kegiatan/Kegiatan', $data);
    }
}
