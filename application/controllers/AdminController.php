<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KegiatanModel', 'kegiatan');
        $this->load->model('TiketModel', 'tiket');
        $this->load->model('PenggunaModel', 'pengguna');
        $this->load->helper('Khan');
        if ($this->session->role != 1 || $this->session->username == null) {
            redirect(base_url('logout'), 'refresh');
        }
    }

    public function index()
    {
        $tahun = (isset($_GET['thn']) && $_GET['thn'] != "") ? $_GET['thn'] : date("Y"); //default tahun saat ini
        $data['header']['title'] = "Pendapatan Penjualan Tiket";
        $data['body']['tahun'] = [];
        for ($i=1; $i <= 12; $i++) { // perulangan bulan 1-12
            $data['body']['tahun'][$i][] = $this->tiket->laporanTahun($i, $tahun); // isi data pemesanan di tanggal i
            $data['body']['thn'][$i][] = date("F", mktime(0, 0, 0, $i, 10));
        }
        return $this->load->view('admin/dashboard/Dashboard', $data);
    }

    //tiket
    public function tiket()
    {
        $data['header']['title'] = "Tiket";
        $data['body'] = $this->tiket->getTiket();
        return $this->load->view('admin/tiket/Tiket', $data);
    }

    public function dellTiket($id)
    {
        $this->tiket->dellTiket($id);
        redirect(base_url('admin/tiket'), 'refresh');
    }

    public function editTiket($id)
    {
        $data = $this->input->post(NULL, TRUE);
        if ($data) {
            $this->tiket->editTiket($id, $data);
            redirect(base_url('admin/tiket'), 'refresh');
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    
    public function addTiket()
    {
        $data = $this->input->post(NULL, TRUE);
        if ($data) {
            $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $config['file_name'] = time() . ".$ext";
            $config['upload_path']          = './assets/img/tiket/';
            $config['allowed_types']        = 'gif|jpg|png';
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $data = array_merge($data, array("img" => $config['file_name']));
                $data = $this->tiket->addTiket($data);
                redirect(base_url('admin/tiket'), 'refresh');
            } else {
                $error = array('message' => $this->upload->display_errors());
                var_dump($error);
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function updateStok(){
        $data = $this->input->post(NULL, TRUE);
        if ($data) {
            $this->tiket->updateStok($data['stok']);
            redirect(base_url('admin/tiket'), 'refresh');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    //kegiatan
    public function kegiatan()
    {
        $data['header']['title'] = "Kegiatan";
        $data['body'] = $this->kegiatan->getKegiatan();
        return $this->load->view('admin/kegiatan/Kegiatan', $data);
    }

    public function deleteKegiatan($id)
    {
        $this->kegiatan->dellKegiatan($id);
        redirect(base_url('admin/kegiatan'), 'refresh');
    }

    public function editKegiatan($id)
    {
        $data = $this->input->post(NULL, TRUE);
        if ($data) {
            $this->kegiatan->editKegiatan($id, $data);
            redirect(base_url('admin/kegiatan'), 'refresh');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function tambahKegiatan()
    {
        $data = $this->input->post(NULL, TRUE);
        if ($data) {
            $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $config['file_name'] = time() . ".$ext";
            $config['upload_path']          = './assets/img/kegiatan/';
            $config['allowed_types']        = 'gif|jpg|png';
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $data = array_merge($data, array("foto" => $config['file_name']));
                $data = $this->kegiatan->addKegiatan($data);
                redirect(base_url('admin/kegiatan'), 'refresh');
            } else {
                $error = array('message' => $this->upload->display_errors());
                var_dump($error);
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    //Pengguna
    public function pengguna()
    {
        $data['header']['title'] = "Pengguna";
        $data['body'] = $this->pengguna->getPengguna();
        return $this->load->view('admin/pengguna/Pengguna', $data);
    }

    public function deletePengguna($id)
    {
        $this->pengguna->dellPengguna($id);
        redirect(base_url('admin/pengguna'), 'refresh');
    }

    //Pemesanan
    public function pemesanan()
    {

        $data['header']['title'] = "Pemesanan";
        $data['body'] = $this->tiket->getPemesanan();

        \Midtrans\Config::$serverKey = 'SB-Mid-server-jHiRIe0iXX-6GM6owv1hXRYi';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        for ($i = 0; $i < count($data['body']); $i++){
            $status = \Midtrans\Transaction::status($data['body'][$i]->id);
            
            $data['status'][] = array(
                'id' => $data['body'][$i]->id,
                'status' => $status->transaction_status,
                'type' => $status->payment_type
            );

        }
        return $this->load->view('admin/pemesanan/Pemesanan', $data);
    }

    //Cetak Laporan Pada Excel
    public function cetaklaporan($thn)
    {
        $data = $this->tiket->testLaporanTahun($thn);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle("Tahun");
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Bulan');
        $sheet->setCellValue('C1', 'Tipe Paket');
        $sheet->setCellValue('D1', 'Nama Paket');
        $sheet->setCellValue('E1', 'Total Tiket');
        $sheet->setCellValue('F1', 'Harga Total Tiket');
        $no = 2;
        $jumlahHargaTotal = 0;
        foreach($data as $dt){
            $sheet->setCellValue('A'.$no, $no-1);
            $sheet->setCellValue('B'.$no, date("F", mktime(0, 0, 0, $dt['bulanPemesanan'], 10)));
            $sheet->setCellValue('C'.$no, $dt['nama']);
            $sheet->setCellValue('D'.$no, $dt['namaPaket']);
            $sheet->setCellValue('E'.$no, $dt['total']);
            $sheet->setCellValue('F'.$no, rupiah($dt['totalHarga']));
            $jumlahHargaTotal = $jumlahHargaTotal + $dt['totalHarga'];          
            $no++;
        }

        $sheet->setCellValue('E'.($no+2), "Jumlah");
        $sheet->setCellValue('F'.($no+2), rupiah($jumlahHargaTotal));  
        for($i = 1; $i <=12; $i++){
            $sheet = $spreadsheet->createSheet()->setTitle(date("F", mktime(0, 0, 0, $i, 10)));
            $data = $this->tiket->laporanTahun($i, $thn);
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Tanggal Pemesanan');
            $sheet->setCellValue('C1', 'Tipe Paket');
            $sheet->setCellValue('D1', 'Nama Paket');
            $sheet->setCellValue('E1', 'Total Tiket');
            $sheet->setCellValue('F1', 'Harga Total Tiket');
            $no = 2;
            $jumlahHargaTotal = 0;
            foreach($data as $dt){
                $sheet->setCellValue('A'.$no, $no-1);
                $sheet->setCellValue('B'.$no, $dt['tanggalPemesanan']);
                $sheet->setCellValue('C'.$no, $dt['nama']);
                $sheet->setCellValue('D'.$no, $dt['namaPaket']);
                $sheet->setCellValue('E'.$no, $dt['total']);
                $sheet->setCellValue('F'.$no, rupiah($dt['totalHarga']));
                $jumlahHargaTotal = $jumlahHargaTotal + $dt['totalHarga'];          
                $no++;
            }
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan Tahun '.$thn;
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function lapkeuangan()
    {
        $tahun = (isset($_GET['thn']) && $_GET['thn'] != "") ? $_GET['thn'] : date("Y"); //default tahun saat ini
        $bulan = (isset($_GET['bln']) && $_GET['bln'] != "") ? $_GET['bln'] : date("m"); //default bulan saat ini
        $data['bulan'] = date("F", mktime(0, 0, 0, $bulan, 10));
        $data['bln'] = $bulan;
        $data['thn'] = $tahun;
        $data['header']['title'] = "Laporan Keuangan";
        $data['body']['bulan'] = [];
        $data['body']['tgl'] = [];
        $data['body']['tahun'] = [];
        for ($i=1; $i <= 31; $i++) { // perulangan tanggal 1-31
            $tgl = $tahun . "-$bulan-$i"; // bikin format tanggal untuk jadi argument ke model
            $data['body']['bulan'][$i][] = $this->tiket->laporanBulan($tgl); // isi data pemesanan di tanggal i
            $data['body']['tgl'][$i][] = date("Y") . "-$bulan-$i";
        }
        for ($i=1; $i <= 12; $i++) { // perulangan bulan 1-12
            $data['body']['tahun'][$i][] = $this->tiket->laporanTahun($i, $tahun); // isi data pemesanan di tanggal i
            $data['body']['thn'][$i][] = date("F", mktime(0, 0, 0, $i, 10));
        }
        return $this->load->view('admin/lapkeuangan/LapKeuangan', $data);
    }
}