<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 27/10/2018
 * Time: 11:16
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property login_model     $login_model
 * @property Conversion      $conversion
 */
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in')==FALSE){
            show_404();
        }
    }

    public function index(){
        $level=$this->conversion->get_level();
        if ($level=='gudang'){
            $data=array(
                'page'      => 'pages/dashboard/gudang',//untuk set path halaman view yang di load
                'title'     => 'Dashboard', // untuk set title halaman
                'subtitle'  => $this->session->userdata('username'), // untuk set  subtitle
                'barang'    => $this->login_model->cek_data(['jenis'=>'spare_part'],'barang')->num_rows(),
                'supplier'  => $this->login_model->select_data('supplier')->num_rows(),
                'order'     => $this->login_model->cek_data("status_pembelian in ('belum_lunas','input')",'pembelian')->num_rows(),
                'invoice'   => $this->login_model->cek_data(['status_pembelian'=>'lunas'],'pembelian')->num_rows(),
            );
            $this->load->view('templates/layout',$data);
        }else{
            $data=array(
                'page'=>'pages/dashboard/'.$level,//untuk set path halaman view yang di load
                'title'=>'Dashboard', // untuk set title halaman
                'subtitle'=>$this->session->userdata('username') // untuk set  subtitle
            );
            $this->load->view('templates/layout',$data);
        }
    }

    public function profile(){
            $data=array(
                'page'=>'pages/master/user/profile',
                'title'=>'Profile',
                'subtitle'=>'User'
            );
            $this->load->view('templates/layout',$data);
    }

    public function daftar_user($tipe){
            $data=array(
                'tipe'  =>$tipe,
                'page'  =>'pages/master/user/daftar_user',
                'title' =>'Daftar ',
                'subtitle' =>$tipe
            );
            $this->load->view('templates/layout',$data);
    }



}
