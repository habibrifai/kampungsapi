<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TiketModel', 'tiket');
        $this->load->helper('Khan');
        date_default_timezone_set('Asia/Jakarta');
        // if($this->session->role!=0 || $this->session->username==null){
        //     redirect(base_url('logout'), 'refresh');
        // }
    } 

    public function infoTiket()
    {
        $data['header']['title'] = "Info Tiket";
        $input = $this->input->get(NULL, TRUE);
        if ($input) {
            $data['body'] = $this->tiket->getTiket($input);
            $data['type'] = $input;
            return $this->load->view('user/tiket/InfoTiket', $data);
        } else {
            return $this->load->view('user/tiket/Tiket', $data);
        }
    }

    public function detailTiket($id)
    {
        $data = $this->input->post(NULL, TRUE);
        if ($data) {
            if($this->session->has_userdata('tanggal')){
                $data['tgl_pesanan'] = $this->session->userdata('tanggal');
            } else { 
                $data['tgl_pesanan'] = date('Y-m-d H:i:s');
            }
            
            if (isset($this->session->id)) {
                $this->tiket->insertPesanan($data);
                redirect(base_url('pemesanan/') . $this->session->id, 'refresh');
            }
            $this->session->set_userdata('referred_from', base_url('pemesanan/'));
            $this->session->set_userdata('datainput', $data);
            redirect(base_url('login'));
        } else {
            $data['header']['title'] = "Detail Tiket";
            $data['body'] = $this->tiket->getTiketDetail(['id' => $id]);
            $data['stokTiket'] = $this->tiket->getStok();
            if($this->session->has_userdata('tanggal')){
                $data['tgl_pesanan'] = $this->session->userdata('tanggal'); // u reservasi
            } else {
                $data['tgl_pesanan'] = date('Y-m-d H:i:s'); //u go show
            }
            if (!isset($data['body'])) {
                redirect(base_url('tiket'), 'refresh');
            }
            return $this->load->view('user/tiket/DetailTiket', $data);
        }
    }

    public function cekStok($tgl)
    {
        $data = $this->tiket->getTotalPesan($tgl);
        $this->session->set_userdata('tanggal', $tgl);
        $stok = $this->tiket->getStok();
        $stokHariIni = $stok - $data->total;
        echo $stokHariIni;
        return $stokHariIni;
    }

    public function pemesanan($id = NULL)
    {
        $data['header']['title'] = "Pembayaran";
        $data['body'] = $this->tiket->getDetailPemesanan($this->session->id);
        $dataTiket = $this->tiket->getStok() - $data['body']->jumlah_tiket;
        $this->tiket->updateStok($dataTiket);
        if (!isset($data['body'])) {
            redirect(base_url('tiket'), 'refresh');
        }
        $this->session->unset_userdata('tanggal');
        $data['order']=$this->tiket->getTiketone($data['body']->id_tiket);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-jHiRIe0iXX-6GM6owv1hXRYi';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $transaction_details = array(
            'order_id' => $data['body']->id,
            'gross_amount' => $data['body']->harga, 
          );
          
        $item1_details = array(
            'id' => $data['body']->id_tiket,
            'price' => $data['body']->harga,
            'quantity' => $data['body']->jumlah_tiket,
            'name' => $data['order']->nama
            );
        
        $item_details = array ($item1_details);
        $transaction = array(
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            );
        
        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        $data['snapToken']=$snapToken;
        $this->load->view('midtrans/pembayaran', $data);
    }
}