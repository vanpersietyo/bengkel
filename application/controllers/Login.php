<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 23/10/2018
 * Time: 9:53
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data=array(
            'page'=>'pages/login/login',
            'title'=>'Login Si Bengkel');
        $this->load->view('pages/login/template/form',$data);
    }

    public function cek_login(){
        $username   = $this->input->post('username');
        $password   = md5($this->input->post('password'));
        $data       = array('username'=> $username,'password'=>$password);
        $tabel      = 'user';
        $result     = $this->login_model->cek_login($data,$tabel);
        if($result->num_rows()==1){
            $session = array(
             'username'  => $result->row()->username,
             'kode_user' => $result->row()->kode_user,
             'email'     => $result->row()->email,
             'level'     => $result->row()->id_level,
             'logged_in' => TRUE
            );
            $this->session->set_userdata($session);
            $this->load->view('pages/login/notif_login',array('notif' =>'login_sukses'));
        } else {
            $this->load->view('pages/login/notif_login',array('notif' =>'login_gagal'));
        }
    }

    public function register(){
        $data=array(
            'page'=>'pages/login/register',
            'title'=>'Daftar Si Bengkel');
        $this->load->view('pages/login/template/form',$data);
    }

    public function cek_register(){
        $username           = $this->input->post('username');
        $email              = $this->input->post('email');
        $password           = $this->input->post('password');
        $confirm_password   = $this->input->post('password');
        $data               = array('username'=> $username,'email'=>$email);
        $tabel              = 'user';
        $token              = md5($username.'/'.session_id().'/'.time());

        //validasi
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|max_length[15]|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');

        //cek validasi
        if ($this->form_validation->run() == FALSE){

            //cek apabila ada email yang sudah teradftar tapi gagal kirim email
            $where=array('email'=>$email,'username'=>$username,'is_active'=>0,'request_token'=>1);
            $cek_aktif=$this->login_model->cek_data($where,'user')->num_rows();
            if ($cek_aktif==1){
                //kirim email kembali
                $data = array(
                    'to'				=> $email,
                    'from'				=> 'support@buspariwisatasidoarjo.com',
                    'from_nama'			=> 'Aktivasi Pendaftaran Si Bengkel',
                    'subject'			=> 'Pendaftaran Akun Baru Si Bengkel',
                    'header_content'	=> '<h3>Aktivasi Akun</h3>',
                    'detail_content'	=> "Selamat Datang di SI Bengkel. Akun anda adalah <br> 
                                        Username : $username <br> Password = $password
                                        <p>Klik <a href='".site_url('aktivasi/').$token."' target='_blank'>link ini</a> untuk aktivasi akun.</p>"
                );
                $result=$this->send_email($data);//kirim email dengan panggil funsi send_email
                $this->load->view('pages/login/notif_login',array('notif' =>'register_sukses','result' =>$result));

            } else {//jika gagal semua
                $this->load->view('pages/login/notif_login',array('notif' =>'register_gagal'));
            }

        }
        else {
            $data=array(
                'kode_user' => $this->login_model->kode_auto('user','kode_user','USR'),
                'username'  => $username,
                'password'  => md5($password),
                'email'     => $email,
                'token'     => $token,
                'request_token' => 1,
            );
            $this->login_model->insert_data('user',$data);
            $data = array(
                'to'				=> $email,
                'from'				=> 'support@buspariwisatasidoarjo.com',
                'from_nama'			=> 'Aktivasi Pendaftaran Si Bengkel',
                'subject'			=> 'Pendaftaran Akun Baru Si Bengkel',
                'header_content'	=> '<h3>Aktivasi Akun</h3>',
                'detail_content'	=> "Selamat Datang di SI Bengkel. Akun anda adalah <br> 
                                        Username : $username <br> Password = $password
                                        <p>Klik <a href='".site_url('aktivasi/').$token."' target='_blank'>link ini</a> untuk aktivasi akun.</p>"
            );
            $result=$this->send_email($data);//kirim email dengan panggil funsi send_email
            $this->load->view('pages/login/notif_login',array('notif' =>'register_sukses','result' =>$result));

        }

    }

    public function aktivasi($token){
        //cek token di database
        $where  =array('token'=>$token,
            'is_active'=>0,
            'request_token'=>1);
        $ada    =$this->login_model->cek_data($where,'user');

        if ($ada->num_rows()==0){
            //munculkan notif
            $notif 	= $this->load->view('pages/login/notif_login',array('notif' =>'aktivasi_gagal'), TRUE);
            $this->session->set_flashdata("register", $notif);
            redirect('register');
        }else{
            $id_user    = $ada->row()->id_user;
            $data=array(
                'request_token' => 0,
                'is_active'     => 1,
                'token'         => '',
            );
            $this->login_model->update_data('id_user',$id_user,'user',$data);
            $notif 	= $this->load->view('pages/login/notif_login',array('notif' =>'aktivasi_sukses'), TRUE);
            $this->session->set_flashdata("login", $notif);
            redirect('login');
        }
    }

    public function forgot_password(){
        $data=array(
            'page'=>'pages/login/forgot_password',
            'title'=>'Lupa Password Si Bengkel');
        $this->load->view('pages/login/template/form',$data);
    }

    public function proses_forgot_password(){ //route -> forgot.do
        $username   = $this->input->post('username');
        $password   = $this->login_model->cek_forgot_password(array('username'=>$username),'user');
        if ($password->num_rows()==0){
            $this->load->view('pages/login/notif_login',array('notif' =>'forgot_password_gagal'));
        } else{
            $id_user    = $password->row()->id_user;
            $token      = md5($id_user.'/'.session_id().'/'.time());

            $data = array(
                'to'				=> $password->row()->email,
                'from'				=> 'support@buspariwisatasidoarjo.com',
                'from_nama'			=> 'Admin Si Bengkel',
                'subject'			=> 'Reset Password Akun Si Bengkel',
                'header_content'	=> '<h3>Reset Password Akun</h3>',
                'detail_content'	=> "Selamat Datang di SI Bengkel. Akun anda adalah <br> 
                                        Username : $username <br>
                                        <p>Klik <a href='".site_url('reset/').$token."' target='_blank'>link ini</a> untuk reset password.</p>"
            );
            if ($this->send_email($data)==1){//kirim email dengan panggil funsi send_email
                $data=array(
                    'request_password' => 1,
                    'token'            => $token,
                );
                $this->login_model->update_data('id_user',$id_user,'user',$data);
                $this->load->view('pages/login/notif_login',array('notif' =>'forgot_password_sukses'));
            } else {
                $this->load->view('pages/login/notif_login',array('notif' =>'kirim_forgot_password_gagal'));
            }

        }
    }


    public function reset_password($token){
        //cek token di database
        $where  =array(
            'token'             =>$token,
            'is_active'         =>1,
            'request_password'  =>1
        );
        $ada    =$this->login_model->cek_data($where,'user');

        if ($ada->num_rows()==0){
            //munculkan notif
            $notif 	= $this->load->view('pages/login/notif_login',array('notif' =>'reset_gagal'), TRUE);
            $this->session->set_flashdata("forgot_password", $notif);
            redirect('forgot_password');
        }else{
            $data=array(
                'id_user'   => $ada->row()->id_user,
                'username'  => $ada->row()->username,
                'page'      => 'pages/login/reset_password',
                'title'     => 'Reset Password Si Bengkel'
            );
            $this->load->view('pages/login/template/form',$data);
        }
    }

    public function proses_reset_password(){
        $id_user        = $this->input->post('id_user');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $conf_username  = $this->input->post('confirm_password');

        //validasi input
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');

        //cek validasi
        if ($this->form_validation->run() == FALSE){
            $this->load->view('pages/login/notif_login',array('notif' =>'input_reset_password_gagal'));
        }else {
//            echo "$id_user, $username, $password, $conf_username";
            $data=array(
                'password'         => md5($password),
                'request_password' => 0,
                'token'            => '',
            );
            $this->login_model->update_data('id_user',$id_user,'user',$data);
            $this->load->view('pages/login/notif_login',array('notif' =>'input_reset_password_sukses'));
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }

    public function send_email($data)
    {
        //load library email
        $this->load->library('Email');
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://rizaltrans.adhityaelenwedding.com',
            'smtp_port' =>  465,
            'smtp_user' => 'admin@rizaltrans.adhityaelenwedding.com',
            'smtp_pass' => 'rizaltrans',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        //Email content
        $htmlContent 	= $data['header_content'];
        $htmlContent   .= $data['detail_content'];
        //tujuan email
        $this->email->to($data['to']);
        $this->email->from($data['from'],$data['from_nama']);
        $this->email->subject($data['subject']);
        $this->email->message($htmlContent);
        //Send email
        if($this->email->send()) {
            return '1';
        }
        else {
            return '0';
        }
    }

    public function tes(){
        $data=array(
            'page'=>'pages/login/form_login',
            'title'=>'Login Si Bengkel');
        $this->load->view('pages/login/template/form',$data);
    }


}
