<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 12/12/2018
 * Time: 15:27
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Conversion {

    public function __construct()
    {
        $this->CI =& get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function hak_akses_admin() // hak akses level 1 = superadmin ; 2=admin ; 3=gudang
    {
        $level = $this->CI->session->userdata('level');
        if ($level==1 or $level==2 or $level==3){
            $this->CI->load->model('admin_model');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function hak_akses_pelanggan() // hak akses level 5 = pelanggan
    {
        $level = $this->CI->session->userdata('level');
        if ($level==5){
            $this->CI->load->model('pelanggan_model');
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function get_level($level_id = null)
    {
        if ($level_id == null){
            $level = $this->CI->session->userdata('level');
        } else {
            $level = $level_id;
        }

        if ($level==1){
            return 'superadmin';
        }elseif ($level==2){
            return 'admin';
        }elseif ($level==3){
            return 'gudang';
        }elseif ($level==4){
            return 'montir'; //no use
        }elseif ($level==5){
            return 'pelanggan';
        }elseif ($level==1){
            return 'pemilik';
        }else{
            return false;
        }
    }

    function get_status_pembelian($status)
    {
       if ($status=='input'){
           return 'Belum Di Simpan';
       }elseif($status=='belum_lunas'){
           return 'Belum Ada Pembayaran';
       }elseif($status=='lunas'){
           return 'Lunas';
       }
    }

}