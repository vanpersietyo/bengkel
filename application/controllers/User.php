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
 * @property admin_model     $admin_model
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
        if ($level=='admin'){
            $data=array(
                'page'      => 'pages/dashboard/admin',//untuk set path halaman view yang di load
                'title'     => 'Dashboard', // untuk set title halaman
                'subtitle'  => $this->session->userdata('username'), // untuk set  subtitle
                'antrian'   => $this->login_model->cek_data("status_penjualan in ('1','2') and date(tgl_penjualan)='".date('Y-m-d')."' ",'penjualan')->num_rows(),
                'proses'    => $this->login_model->cek_data("status_penjualan = '3' and date(tgl_penjualan)='".date('Y-m-d')."'",'penjualan')->num_rows(),
                'invoice'   => $this->login_model->cek_data("status_penjualan in ('4','5') and date(tgl_penjualan)='".date('Y-m-d')."'",'penjualan')->num_rows(),
                'transaksi' => $this->login_model->select_data('penjualan')->num_rows(),
            );
            $this->load->view('templates/layout',$data);
        }elseif ($level=='gudang'){
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
        }elseif ($level=='pelanggan'){
            $data=array(
                'page'      => 'pages/dashboard/pelanggan',//untuk set path halaman view yang di load
                'title'     => 'Dashboard', // untuk set title halaman
                'subtitle'  => $this->session->userdata('username'), // untuk set  subtitle
                'antrian'   => $this->admin_model->get_antrian_penjualan(date('Y-m-d')),
                'proses'    => $this->login_model->cek_data("status_penjualan in ('3','4','5')and date(tgl_penjualan)='".date('Y-m-d')."' ",'penjualan')->num_rows(),
                'kendaraan' => $this->admin_model->cek_data(['kode_user'    => $this->session->userdata('kode_user') ],'kendaraan_user')->num_rows(),
                'history'   => $this->admin_model->cek_data(['no_pelanggan' => $this->session->userdata('no_reg')],'penjualan')->num_rows()
            );
            $this->load->view('templates/layout',$data);
        }elseif ($level=='pemilik'){
            $data=array(
                'page'      => 'pages/dashboard/pemilik',//untuk set path halaman view yang di load
                'title'     => 'Dashboard', // untuk set title halaman
                'subtitle'  => $this->session->userdata('username'), // untuk set  subtitle
                'barang'    => $this->login_model->cek_data("jenis = 'spare_part'",'barang')->num_rows(),
                'hari_ini'  => $this->admin_model->get_list_penjualan()->num_rows(),
                'penjualan' => $this->admin_model->laporan_penjualan_barang("status_penjualan in ('4','5') and jenis='spare_part'")->num_rows(),
                'pembelian' => $this->admin_model->laporan_pembelian_barang("status_pembelian in ('belum_lunas','lunas') and jenis='spare_part'")->num_rows()

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
                'page'      => 'pages/master/user/profile',
                'title'     => 'Profile',
                'subtitle'  => $this->conversion->get_level(),
                'user'      => $this->admin_model->cek_data(['kode_user'=>$this->session->userdata('kode_user')],'user')->row()
            );
            $this->load->view('templates/layout',$data);
    }

    public function ubah_profile(){
        $data=array(
            'page'      => 'pages/master/user/ubah_user',
            'title'     => 'Ubah Profile',
            'subtitle'  => $this->conversion->get_level(),
            'user'      => $this->admin_model->cek_data(['kode_user'=>$this->session->userdata('kode_user')],'user')->row()

        );
        $this->load->view('templates/layout',$data);
    }

    public function proses_ubah_profile(){
        $data   =[
            'nama'      => $this->input->post('nama'),
            'alamat'    => $this->input->post('alamat'),
            'telepon'   => $this->input->post('telepon')
        ];
        $exist = $this->admin_model->cek_data(['kode_user'=>$this->session->userdata('kode_user')],'user');
        if($exist->num_rows()==0){
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Gagal',
                            html: '<h4>Data Tidak Ditemukan</h4>',
                            type: 'error',
                            showCancelButton: false,
                        });
                    });
                </script>";
        }else{
            if ($exist->row()->username=='' || $exist->row()->username==null){
                $data['username'] = $this->input->post('username');
                $this->admin_model->update_data('id_user',$exist->row()->id_user,'user',$data);
            }else{
                $this->admin_model->update_data('id_user',$exist->row()->id_user,'user',$data);
            }
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Diubah</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.value) {                
                                location.href = '". site_url('profile.php')."';
                            }
                        });
                    });
                </script>";
        }
    }

    public function proses_ubah_password(){
        $current_password   = md5($this->input->post('current_password'));
        $new_password       = $this->input->post('new_password');
        $confirm_password   = $this->input->post('confirm_password');
        $exist              = $this->admin_model->cek_data(['kode_user'=>$this->session->userdata('kode_user')],'user')->row();
        $password           = $exist->password;
        if($current_password != $password){
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Gagal',
                            html: '<h4>Current Password Salah</h4>',
                            type: 'error',
                            showCancelButton: false,
                        });
                    });
                </script>";
        }elseif ($confirm_password!=$new_password){
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Gagal',
                            html: '<h4>Confirm Password Tidak Sama</h4>',
                            type: 'error',
                            showCancelButton: false,
                        });
                    });
                </script>";
        }else{
            $this->admin_model->update_data('id_user',$exist->id_user,'user',['password'=>md5($new_password)]);
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Password Berhasil Diubah</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.value) {
                                location.href = '". site_url('profile.php')."';
                            }
                        });
                    });
                </script>";
        }
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
