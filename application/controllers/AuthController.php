<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel','authM');
    }
    
    /*
    role
    0 -> user
    1 -> admin
    */

    public function register()
	{  
        $data=$this->input->post(NULL, TRUE);
        if($data){
            $data['password']=hash('sha512', $data['password']);
            $data['kode']=substr(md5(mt_rand()), 0, 7);
            $result=$this->authM->register($data);
            if ($result['stat']) {
                $this->sendMail($data['username'],$data['email'],$data['kode']);
                $this->session->set_flashdata('message', 'Link Verifikasi Sudah Dikirim Ke Email '.$data['email']);
                redirect(base_url('login'), 'refresh');
            }else{
                $this->session->set_flashdata('message', 'Register Gagal, Silahkan Ulangi Lagi');
                redirect(base_url('register'), 'refresh');
            }
        }else{
            $data['header']['title'] = "Register";
            return $this->load->view('auth/register', $data);
        }
    }
    
    function sendMail($username,$email,$kode) 
    {
        $ci = get_instance();
        $this->email->initialize($this->configMail());
        $ci->email->from(NAMEORG,NAMEORG);
        $list = array($email);
        $ci->email->to($list);
        $data=base64_encode(base64_encode(json_encode(array($username,$email,$kode))));
        $ci->email->subject('Verifikasi Pendaftaran');
        $ci->email->message('Silahkan Buka Tautan Berikut Untuk Melakukan Verifikasi Pendaftaran <a href="'.base_url('ver?q=').$data.'">Disini</a>');
        $this->email->set_newline("\r\n");
        if ($this->email->send()) {
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function configMail(){
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'foneazmi0@gmail.com';
        $config['smtp_auth'] = TRUE;
        $config['smtp_pass'] = 'fone azmi';
        $config['smtp_crypto'] = 'ssl';
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['send_multipart'] = FALSE;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        return $config;
    }
    

    public function ver()
    {
        $q=$this->input->get('q');
        $q=json_decode(base64_decode(base64_decode($q)));
        $stat=$this->authM->ver($q);
        if ($stat['stat']) {
            $this->session->set_flashdata('message', 'Akun Berhasil Diverifikasi!');
            redirect(base_url('login'));
        }else{
            $this->session->set_flashdata('message', 'Akun Gagal Diverifikasi!');
            redirect(base_url('register'));
        }
    }

	public function login()
	{
        $data=$this->input->post(NULL, TRUE);
        if($this->session->role!=0 || $this->session->username==null){
            if($data){
                $data['password']=hash('sha512', $data['password']);
                $result=$this->authM->login($data);
                if ($result['stat']) {
                    $this->session->set_userdata([
                        "id"=>$result['data']->id,    
                        "username"=>$result['data']->username,
                        "role"=>$result['role']
                    ]);
                    $this->session->set_flashdata('message', 'Login Berhasil');
                    $referred_from = $this->session->userdata('referred_from');
                    if($referred_from != null){
                        redirect($referred_from, 'refresh');
                    }else{
                        redirect(base_url(), 'refresh');
                    }
                }else{
                    $this->session->set_flashdata('message', 'Login Gagal');
                    redirect(base_url('login'), 'refresh');
                }
            }else{
                $data['header']['title'] = "Login";
                return $this->load->view('auth/login', $data);
            }
        }else{
            redirect(base_url(), 'refresh');
        }  
    }
    

    public function logout()
    {
        $this->session->sess_destroy(); // destroy all session
        redirect(base_url('GuestController')); // redirect to home
    }
}