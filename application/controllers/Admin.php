<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Admin_model        $admin_model
 * @property Conversion         $conversion
 * @property My_email           $my_email
 */
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->conversion->hak_akses_admin()==FALSE){
            redirect(site_url(''));
        }
        $this->load->library('my_email');
    }

//  start master kendaraan
    public function daftar_kendaraan(){ // routes from->master/kendaraan.php
        $data=array(
            'page'              => 'pages/master/kendaraan/daftar_kendaraan',
            'title'             => 'Daftar',
            'subtitle'          => 'Kendaraan',
            'daftar_kendaraan'  => $this->admin_model->select_data('kendaraan','entry','ASC')
        );
        $this->load->view('templates/layout',$data);
    }

    public function proses_add_kendaraan(){ // routes from->master/tambah_kendaraan.do
        $data       = array(
            'merk'  =>$this->input->post('merk'),
            'tipe'  =>$this->input->post('tipe'),
        );
        $exist = $this->admin_model->cek_data($data,'kendaraan')->num_rows();//cek sudah ada atau belum di database
        if ($exist==0){
            $data['keterangan']=$this->input->post('keterangan');
            $this->admin_model->insert_data('kendaraan',$data);
            //echo 'data sukses';
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Ditambahkan</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
        } else {
            //set notif
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data Sudah Ada</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
        }
    }

    public function delete_kendaraan($id){
        //delete data dari database
        $this->admin_model->delete_data('id',$id,'kendaraan');
        //set isi notif untuk ditampilkan
        $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'success',
                            title   : 'Deleted!',
                            html    : '<h5>Data Sudah Berhasil Dihapus!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
        //set kedalam flash data
        $this->session->set_flashdata('notif', $notif);
        //redirect ke halaman daftar kendaraan dengan membawa notif
        redirect(site_url('master/kendaraan.php'));
    }

    public function edit_kendaraan($id){
        $kendaraan = $this->admin_model->cek_data(array('id'=>$id),'kendaraan');

        if ($kendaraan->num_rows()==1){
            $data=array(
                'page'              => 'pages/master/kendaraan/edit_daftar_kendaraan',
                'title'             => 'Daftar',
                'subtitle'          => 'Kendaraan',
                'daftar_kendaraan'  => $this->admin_model->select_data('kendaraan','entry','ASC'),
                'kendaraan'         => $kendaraan->row()
            );
            $this->load->view('templates/layout',$data);
        } else {
            //set isi notif untuk ditampilkan
            $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h5>Data Tidak Ditemukan!</h5>',
                        })
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('master/kendaraan.php'));
        }

    }

    public function proses_edit_kendaraan(){ // routes from->master/tambah_kendaraan.do
        $id         = $this->input->post('id');
        $data = array(
            'merk'          => $this->input->post('merk'),
            'tipe'          => $this->input->post('tipe'),
            'keterangan'    => $this->input->post('keterangan')
        );
        $where      = "merk = '{$data['merk']}' and tipe = '{$data['tipe']}' and id != '{$id}'";
        $exist = $this->admin_model->cek_data($where,'kendaraan')->num_rows();//cek sudah ada atau belum di database
        if ($exist==0){
            $this->admin_model->update_data('id',$id,'kendaraan',$data);
            //echo notif update sukses';
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Diubah!</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
        } else {
            //set notif
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data Sudah Ada</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
        }
    }
//  end master kendaraan

//  start master kategori barang
    public function daftar_kategori_barang($jenis){ // routes from->master/kendaraan.php
        $data=array(
            'page'              => 'pages/master/kategori_barang/daftar_kategori_barang',
            'title'             => 'Daftar',
            'subtitle'          => capitalize_each_first( str_replace('_',' ','Jenis '.$jenis) ),
            'jenis'             => $jenis,
            'daftar_kategori_barang'=> $this->admin_model->cek_data("jenis_kategori = '{$jenis}' ",'kategori_barang','entry_time','ASC')
        );
        $this->load->view('templates/layout',$data);
    }

    public function proses_tambah_kategori_barang($jenis){ // routes from->master/tambah_barang.do
        $data = array(
            'kode_kategori'         => $this->admin_model->get_kode_kategori_barang($jenis),
            'nama_kategori'         => $this->input->post('nama'),
            'keterangan_kategori'   => $this->input->post('keterangan'),
            'jenis_kategori'        => $jenis,
            'add_by'                => $this->session->userdata('username')
        );

        $exist = $this->admin_model->cek_data("jenis_kategori='{$jenis}' and (nama_kategori = '{$data['nama_kategori']}' or kode_kategori = '{$data['kode_kategori']}') ",'kategori_barang')->num_rows();//cek sudah ada atau belum di database
        if ($exist==0){
            $this->admin_model->insert_data('kategori_barang',$data);
            //echo 'data sukses';
            echo "<script type='text/javascript'>
                $( document ).ready(function() {
                    swal({
                        title: 'Berhasil',
                        html: '<h4>Data Berhasil Ditambahkan</h4>',
                        type: 'success',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();//refresh halaman
                        }
                    });
                });
            </script>";
        } else {
            //set notif
            echo "<script type='text/javascript'>
                $( document ).ready(function() {
                    swal({
                        type    : 'error',
                        title   : 'Gagal',
                        html    : '<h4>Data Sudah Ada</h4>',
                        allowOutsideClick: false,
                        focusConfirm: true,
                    })
                });
            </script>";
        }
    }

    public function delete_kategori_barang($jenis,$id){
        //delete data dari database
        $this->admin_model->delete_data('kode_kategori',$id,'kategori_barang');
        //set isi notif untuk ditampilkan
        $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'success',
                            title   : 'Deleted!',
                            html    : '<h5>Data Sudah Berhasil Dihapus!</h5>',
                            allowOutsideClick: true,
                        })
                    });
                </script>";
        //set kedalam flash data
        $this->session->set_flashdata('notif', $notif);
        //redirect ke halaman daftar kendaraan dengan membawa notif
        if ($jenis=='layanan'){
            redirect(site_url('master/jenis_layanan.php'));
        } elseif ($jenis=='spare_part'){
            redirect(site_url('master/jenis_spare_part.php'));
        }
    }

    public function edit_kategori_barang($jenis,$id){
        $exist = $this->admin_model->cek_data(array('kode_kategori'=>$id,'jenis_kategori'=>$jenis),'kategori_barang');

        if ($exist->num_rows()==1){
            $data=array(
                'page'              => 'pages/master/kategori_barang/edit_kategori_barang',
                'title'             => 'Daftar',
                'subtitle'          => capitalize_each_first( str_replace('_',' ','Jenis '.$jenis) ),
                'jenis'             => $jenis,
                'kategori_barang'   => $exist->row(),
                'daftar_kategori_barang'=> $this->admin_model->cek_data("jenis_kategori = '{$jenis}' ",'kategori_barang','entry_time','ASC')
            );
            $this->load->view('templates/layout',$data);
        } else {
            //set isi notif untuk ditampilkan
            $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h5>Data Tidak Ditemukan!</h5>',
                        })
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('master/jenis_'.$jenis.'.php'));
        }

    }

    public function proses_edit_kategori_barang($jenis){
        $kode_kategori              = $this->input->post('kode');
        $data = array(
            'nama_kategori'          => $this->input->post('nama'),
            'keterangan_kategori'    => $this->input->post('keterangan')
        );
        $where      = "nama_kategori = '{$data['nama_kategori']}' and kode_kategori != '{$kode_kategori}'";
        $exist = $this->admin_model->cek_data($where,'kategori_barang')->num_rows();//cek sudah ada atau belum di database
        if ($exist==0){
            $this->admin_model->update_data('kode_kategori',$kode_kategori,'kategori_barang',$data);
            //echo notif update sukses';
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Diubah!</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
        }
        else {
            //set notif
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data Sudah Ada</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
        }
    }

//  end master kategori barang

//  start master barang
    public function daftar_barang($jenis){ // routes from->master/kendaraan.php
        $data=array(
            'page'              => 'pages/master/barang/daftar_barang',
            'title'             => 'Daftar',
            'subtitle'          => capitalize_each_first( str_replace('_',' ',$jenis) ),
            'jenis'             => $jenis,
            'kategori'          => $this->admin_model->cek_data("jenis_kategori = '{$jenis}' ",'kategori_barang','entry_time','ASC'),
            'daftar_barang'     => $this->admin_model->get_daftar_barang($jenis)
        );
        $this->load->view('templates/layout',$data);
    }

    public function proses_tambah_barang($jenis){ // routes from->master/tambah_barang.do
        $data = array(
            'kode'          => $this->admin_model->get_kode_barang($jenis),
            'nama'          => $this->input->post('nama'),
            'harga'         => replace_input_mask($this->input->post('harga')),
            'keterangan'    => $this->input->post('keterangan'),
            'jenis'         => $jenis,
            'kode_kategori' => $this->input->post('kategori'),
            'satuan'        => ($this->input->post('satuan') ?: 'jasa'),
            'add_by'        => $this->session->userdata('username')
        );

        if($data['harga']<=0){
            //set notif harga tidak boleh 0
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Harga Tidak Boleh 0 atau Minus !</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
        } else {
            $exist = $this->admin_model->cek_data("jenis='{$jenis}' and (nama = '{$data['nama']}' or kode = '{$data['kode']}')",'barang')->num_rows();//cek sudah ada atau belum di database
            if ($exist==0){
                $this->admin_model->insert_data('barang',$data);
                //echo 'data sukses';
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Ditambahkan</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
            } else {
                //set notif
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data Sudah Ada</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
            }
        }
    }

    public function delete_barang($jenis,$id){
        //delete data dari database
        $this->admin_model->delete_data('kode',$id,'barang');
        //set isi notif untuk ditampilkan
        $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'success',
                            title   : 'Deleted!',
                            html    : '<h5>Data Sudah Berhasil Dihapus!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
        //set kedalam flash data
        $this->session->set_flashdata('notif', $notif);
        //redirect ke halaman daftar kendaraan dengan membawa notif
        if ($jenis=='layanan'){
            redirect(site_url('master/layanan.php'));
        } elseif ($jenis=='spare_part'){
            redirect(site_url('master/spare_part.php'));
        }
    }

    public function edit_barang($jenis,$id){
        $exist = $this->admin_model->cek_data(['kode'=>$id],'barang');

        if ($exist->num_rows()==1){
            $data=array(
                'page'              => 'pages/master/barang/edit_barang',
                'title'             => 'Daftar',
                'subtitle'          => capitalize_each_first(str_replace('_',' ',$jenis)),
                'jenis'             => $jenis,
                'barang'            => $exist->row(),
                'daftar_barang'     => $this->admin_model->get_daftar_barang($jenis),
                'kategori'          => $this->admin_model->cek_data("jenis_kategori = '{$jenis}'",'kategori_barang','entry_time','ASC')
            );
            $this->load->view('templates/layout',$data);
        } else {
            //set isi notif untuk ditampilkan
            $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h5>Data Tidak Ditemukan!</h5>',
                        })
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('master/jenis_'.$jenis.'.php'));
        }

    }

    public function proses_edit_barang($jenis){ //TODO -- Tambahkan proses edit barang, ini masih copas edit kategori barang
        $kode              = $this->input->post('kode');
        $data = array(
            'nama'          => $this->input->post('nama'),
            'harga'         => replace_input_mask($this->input->post('harga')),
            'keterangan'    => $this->input->post('keterangan'),
            'jenis'         => $jenis,
            'kode_kategori' => $this->input->post('kategori'),
            'satuan'        => ($this->input->post('satuan') ?: 'jasa'),
            'change_by'     => $this->session->userdata('username')
        );

        if($data['harga']<=0){
            //set notif harga tidak boleh 0
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Harga Tidak Boleh 0 atau Minus !</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
        } else {
            $where      = "(nama = '{$data['nama']}' and jenis ='{$jenis}' and kode_kategori = '{$data['kode_kategori']}') and kode != '{$kode}'";
            $exist = $this->admin_model->cek_data($where,'barang')->num_rows();//cek sudah ada atau belum di database
            if ($exist==0){
                $this->admin_model->update_data('kode',$kode,'barang',$data);
                //echo notif update sukses';
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Diubah!</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
            }
            else {
                //set notif
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data Sudah Ada</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
            }
        }


    }
//  end master barang

//  start master pelanggan
    public function daftar_pelanggan(){
        // routes from->master/pelanggan.php
        $data=array(
            'page'              => 'pages/master/pelanggan/daftar_pelanggan',
            'title'             => 'Daftar',
            'subtitle'          => 'Pelanggan',
            'kode_pelanggan'    => $this->admin_model->get_no_registrasi_pelanggan(),
            'daftar_pelanggan'  => $this->admin_model->cek_data("id_level = '5' ",'user','','ASC')
        );
        $this->load->view('templates/layout',$data);
    }

    public function proses_tambah_pelanggan(){
        $email      = $this->input->post('email');
        $token      = md5($email.'/'.session_id().'/'.time());
        $password   = $this->admin_model->generate_password();
        $data   = [
            'kode_user'     => $this->admin_model->kode_auto('user','kode_user','USR'),
            'no_registrasi' => $this->input->post('kode_registrasi'),
            'nama'          => $this->input->post('nama'),
            'email'         => $email,
            'alamat'        => $this->input->post('alamat'),
            'telepon'       => $this->input->post('telepon'),
            'password'      => md5($password),
            'token'         => $token,
            'request_token' => 1,
        ];
        //kirim email kembali
        $exist  = $this->admin_model->cek_data(['email'=>$email],'user');
        if($exist->num_rows()==0){
            $kirim   = array(
                'to'				=> $email,
                'from'				=> 'admin@sibengkel.online',
                'from_nama'			=> 'Aktivasi Pendaftaran Si Bengkel',
                'subject'			=> 'Pendaftaran Akun Baru Si Bengkel',
                'header_content'	=> '<h3>Aktivasi Akun</h3>',
                'detail_content'	=> "Selamat Datang di SI Bengkel. Akun anda adalah <br> 
                                        Email : $email <br> Password = $password
                                        <p>Klik <a href='".site_url('aktivasi/').$token."' target='_blank'>link ini</a> untuk aktivasi akun.</p>"
            );
            $result=$this->my_email->send_email($kirim);//kirim email dengan panggil funsi send_email
            if ($result==true){
                //echo 'data sukses';
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                       loading();
                    });
                </script>";
                $this->admin_model->insert_data('user',$data);
                //echo 'data sukses';
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Ditambahkan</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
            }else{
                //set notif
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Gagal Mengirim Email, Coba Lagi</h4>',
                            focusConfirm: true,
                        })
                    });
                </script>";
            }
        }else{
            //set notif
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Email Sudah Terdaftar!</h4>',
                            focusConfirm: true,
                        })
                    });
                </script>";
        }

    }

    public function form_edit_pelanggan($no_reg){
        $exist  = $this->admin_model->cek_data(['no_registrasi'=>$no_reg],'user');
        if ($exist->num_rows()==0){
            //set notif
            $notif  = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data Tidak Ditemukan</h4>',
                            focusConfirm: true,
                        })
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('master/pelanggan.php'));
        }else{
            $data=array(
                'page'              => 'pages/master/pelanggan/form_edit_pelanggan',
                'title'             => 'Daftar',
                'subtitle'          => 'Pelanggan',
                'pelanggan'         => $exist->row(),
                'daftar_pelanggan'  => $this->admin_model->cek_data("id_level = '5' ",'user','','ASC')
            );
            $this->load->view('templates/layout',$data);
        }
    }

    public function proses_edit_pelanggan(){
        $no_reg      = $this->input->post('kode_registrasi');
        $data   = [
            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
            'telepon'       => $this->input->post('telepon'),
        ];
        //kirim email kembali
        $exist  = $this->admin_model->cek_data(['no_registrasi'=>$no_reg],'user');
        if($exist->num_rows()==0){
            //set notif
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Data User Tidak Ditemukan!</h4>',
                            focusConfirm: true,
                        })
                    });
                </script>";
        }else{
            $this->admin_model->update_data('id_user',$exist->row()->id_user,'user',$data);                //echo 'data sukses';
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Data Berhasil Diubah</h4>',
                            type: 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();//refresh halaman
                            }
                        });
                    });
                </script>";
        }

    }

    public function delete_pelanggan($noreg){
        $exist  = $this->admin_model->cek_data(['no_registrasi'=>$noreg],'user');
        if ($exist->num_rows()==0){
            $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal!',
                            html    : '<h5>Data Tidak Ditemukan!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('master/pelanggan.php'));
        }else{
            //delete data dari database
            $this->admin_model->delete_data('id_user',$exist->row()->id_user,'user');
            //set isi notif untuk ditampilkan
            $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'success',
                            title   : 'Deleted!',
                            html    : '<h5>Data Sudah Berhasil Dihapus!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('master/pelanggan.php'));
        }

    }



}
