<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session         $session

 * @property pelanggan_model    $pelanggan_model
 * @property admin_model        $admin_model
 * @property conversion         $conversion
 * @property CI_Input           $input
 */
class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->conversion->hak_akses_pelanggan() == FALSE) {
            redirect('');
        }
    }

    #TODO -- lanjutkan edit dan delete layanan
    public function daftar_layanan()
    {
        $data = [
            'page'              => 'pages/menu_pelanggan/layanan/daftar_layanan',
            'title'             => 'Daftar',
            'subtitle'          => 'Servis',
            'daftar_supplier'   => $this->pelanggan_model->select_data('servis_user'),
        ];
        $this->load->view('templates/layout', $data);
    }

    public function form_pesan_layanan()
    {
        $data=array(
            'page'              => 'pages/menu_pelanggan/layanan/form_pesan_layanan',
            'title'             => 'Tambah',
            'subtitle'          => 'Pesanan Layanan',
            'kode_penjualan'    => $this->admin_model->get_kode_penjualan(),
            'antrian'           => $this->admin_model->get_antrian_penjualan(date('Y-m-d')),
            'kendaraan'         => $this->pelanggan_model->get_list_kendaraan_user($this->session->userdata('kode_user')),
            'pelanggan'         => $this->pelanggan_model->cek_data(['no_registrasi'=>$this->session->userdata('no_reg')],'user')->row(),
        );
        $this->load->view('templates/layout',$data);
    }

    public function daftar_kendaraan()
    {
        $data = [
            'page'              => 'pages/menu_pelanggan/kendaraan/daftar_kendaraan',
            'title'             => 'Daftar',
            'subtitle'          => 'Kendaraan',
            'action'            => 'input',
            'kendaraan'         => $this->pelanggan_model->select_data('kendaraan'),
            'daftar_kendaraan'  => $this->pelanggan_model->get_list_kendaraan_user($this->session->userdata('kode_user'))
        ];
        $this->load->view('templates/layout', $data);
    }

    public function proses_tambah_kendaraan()
    {
        $data = [
            'kode_kendaraan'        => $this->pelanggan_model->get_kode_kendaraan_user(),
            'id_kendaraan'          => $this->input->post('id_kendaraan'),
            'kode_user'             => $this->session->userdata('kode_user'),
            'nopol_kendaraan'       => $this->input->post('nopol'),
            'keterangan_kendaraan'  => $this->input->post('keterangan')
        ];
        $exist  = $this->pelanggan_model->cek_data(
                "id_kendaraan='{$data['id_kendaraan']}' and nopol_kendaraan='{$data['nopol_kendaraan']}' and kode_user='{$data['kode_user']}' and kode_kendaraan != '{$data['kode_kendaraan']}'  ",
                'kendaraan_user'
                )->num_rows();
        if ($exist==0){
//            lanjut input, data belum ada
            $this->pelanggan_model->insert_data('kendaraan_user',$data);
            //echo 'data sukses';
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h5>Data Kendaraan Berhasil Ditambahkan</h5>',
                            type: 'success',
                            showCancelButton: false,
                        }).then((result) => {
                                location.reload();//refresh halaman
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

    public function form_edit_kendaraan($kode_kendaraan)
    {
        $where = [
            'kode_kendaraan'    => $kode_kendaraan,
            'kode_user'         => $this->session->userdata('kode_user')
        ];
        $exist  = $this->pelanggan_model->cek_data($where,'kendaraan_user');

        if ($exist->num_rows()==0){ //kode kendaraan tidak ada
            $notif = "<script type='text/javascript'>
                     debugger;

                    $( document ).ready(function() {
                        swal({
                            type        : 'error',
                            title       : 'Gagal!',
                            html        : '<h5>Data Tidak Ditemukan!</h5>',
                            focusConfirm: true,
                        })                                            
                    });
                </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            redirect(site_url('kendaraan.php'));
        } else { //kode kendaraan ada
            $data = [
                'page'              => 'pages/menu_pelanggan/kendaraan/daftar_kendaraan',
                'title'             => 'Daftar',
                'subtitle'          => 'Kendaraan',
                'action'            => 'edit',
                'detail'            => $this->pelanggan_model->get_kendaraan_user_by_kode($kode_kendaraan)->row(),
                'kendaraan'         => $this->pelanggan_model->cek_data("id != '{$exist->row()->id_kendaraan}'",'kendaraan'),
                'daftar_kendaraan'  => $this->pelanggan_model->get_list_kendaraan_user($this->session->userdata('kode_user'))
            ];
            $this->load->view('templates/layout', $data);
        }
    }

    public function proses_edit_kendaraan($kode_kendaraan)
    {
        $data   = [
            'id_kendaraan'          => $this->input->post('id_kendaraan'),
            'kode_user'             => $this->session->userdata('kode_user'),
            'nopol_kendaraan'       => $this->input->post('nopol'),
            'keterangan_kendaraan'  => $this->input->post('keterangan')
        ];
        // cek apakah kode kendaraan ada di database
        $exist  = $this->pelanggan_model->cek_data(array('kode_kendaraan'=>$kode_kendaraan),'kendaraan_user');
        if ($exist->num_rows()==0){//tidak ada, munculkan error
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal!',
                            html    : '<h5>Data Tidak Ditemukan!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
        }else{//ada, lanjutkan proses
            // cek apakah kendaraan baru yang di masukkan, sudah ada di user nya atau belum
            $exist_id  = $this->pelanggan_model->cek_data("id_kendaraan='{$data['id_kendaraan']}' and kode_user='{$data['kode_user']}' and nopol_kendaraan='{$data['nopol_kendaraan']}' and kode_kendaraan!='{$kode_kendaraan}'",'kendaraan_user');
            if ($exist_id->num_rows()==0){//tidak ada data yang kembar, lanjutkan
                $this->pelanggan_model->update_data('kode_kendaraan',$kode_kendaraan,'kendaraan_user',$data);
                //echo 'update data sukses';
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h5>Data Kendaraan Berhasil Diubah</h5>',
                            type: 'success',
                            showCancelButton: false,
                        }).then((result) => {
                                location.reload();//refresh halaman
                        });
                    });
                </script>";
            }else{
                //tidak ada, munculkan error
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal!',
                            html    : '<h5>Data Sudah Ada!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
            }

        }
    }

    public function delete_kendaraan($kode_kendaraan){

        $exist = $this->pelanggan_model->cek_data(array('kode_kendaraan'=>$kode_kendaraan),'kendaraan_user')->num_rows();
        if ($exist==0){
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
        } else {
            //delete data dari database
            $this->pelanggan_model->delete_data('kode_kendaraan',$kode_kendaraan,'kendaraan_user');
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
        }

        $this->session->set_flashdata('notif', $notif);
        //redirect ke halaman daftar kendaraan dengan membawa notif
        redirect(site_url('kendaraan.php'));
    }

    public function pesanan_saya(){
        $data=array(
            'page'              => 'pages/menu_pelanggan/pesanan_saya',
            'title'             => 'Pesanan',
            'subtitle'          => 'Saya',
            'transaksi'         => $this->pelanggan_model->get_list_penjualan(['no_pelanggan'=>$this->session->userdata('no_reg'),'status_penjualan <='=>'3']),
        );
        $this->load->view('templates/layout',$data);
    }

    public function laporan_transaksi_user(){
        $data=array(
            'page'              => 'pages/menu_pelanggan/laporan_transaksi',
            'title'             => 'History',
            'subtitle'          => 'Transaksi',
            'transaksi'         => $this->pelanggan_model->get_list_penjualan(['no_pelanggan'=>$this->session->userdata('no_reg')]),
        );
        $this->load->view('templates/layout',$data);
    }

    public function detail_transaksi_pelanggan($kode_penjualan)
    {
        $exist  = $this->admin_model->cek_data(['kode_penjualan'=>$kode_penjualan],'penjualan');
        if ($exist->num_rows()==0){
            //pembelian belum ada isi nya
            $notif = "<script type='text/javascript'>
                            $( document ).ready(function() {
                                swal({
                                    type    : 'error',
                                    title   : 'Gagal!',
                                    html    : '<h5>Data Antrian Tidak Boleh Kosong!</h5>',
                                    focusConfirm: true,
                                })
                            });
                        </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            redirect(site_url('daftar_antrian.php'));
        }else {
            $data=array(
                'page'              => 'pages/menu_pelanggan/form_add_detail_antrian',
                'title'             => 'Detail Transaksi',
                'subtitle'          => $kode_penjualan,
                'kode_penjualan'    => $kode_penjualan,
                'penjualan'         => $this->admin_model->get_list_penjualan(['kode_penjualan'=>$kode_penjualan])->row(),
                'barang'            => $this->admin_model->select_data('barang','jenis','ASC'),
                'spare_part'        => $this->admin_model->get_list_barang_penjualan(['jenis'=>'spare_part','kode_penjualan'=>$kode_penjualan]),
                'layanan'           => $this->admin_model->get_list_barang_penjualan(['jenis'=>'layanan','kode_penjualan'=>$kode_penjualan]),
            );
            $this->load->view('templates/layout',$data);
        }
    }

    public function proses_tambah_antrian()
    {
        $date       = $this->input->post('tanggal');
        $tanggal    = formatDate($date.' '.$this->input->post('waktu'),'Y-m-d H:i:s');
        $kode       = explode('|',$this->input->post('kode_kendaraan'));
        $data = [
            'kode_penjualan'          => $this->admin_model->get_kode_penjualan(),
            'antrian'                 => $this->admin_model->get_antrian_penjualan(formatDate($date,'Y-m-d')),
            'kode_kendaraan'          => $kode[0],
            'nopol_kendaraan'         => $kode[1],
            'no_pelanggan'            => $this->session->userdata('no_reg'),
            'tgl_penjualan'           => $tanggal,
            'keterangan_penjualan'    => $this->input->post('keterangan_penjualan'),
            'status_penjualan'        => 1,//1 = antrian
        ];
        $this->admin_model->insert_data('penjualan',$data);
        echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title   : 'BERHASIL',
                            html    : '<h5><strong>Kode Pesanan Anda : ".$data['kode_penjualan']."<br> Nomor Antrian Anda : ".$data['antrian']."</strong>.<br>Silahkan Datang Ke Bengkel Pada Tanggal <br><strong>".dateIndo(formatDate($date,'d-m-Y'),1)."</strong><br>Dengan Menunjukkan Kode Diatas.</h5>',
                            type    : 'success',
                            showCancelButton: false,
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href ='".site_url('pesanan_saya.php')."';
                            }
                        })
                    });
                </script>";
    }

    public function delete_antrian($kode_penjualan)
    {
        $this->admin_model->delete_data('kode_penjualan',$kode_penjualan,'penjualan');
        $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title   : 'BERHASIL',
                            html    : '<h5> Pesanan Berhasil Di Batalkan </h5>',
                            type    : 'success',
                            showCancelButton: false,
                        })
                    });
                </script>";
    }

    public function cari_antrian()
    {
        $date       = $this->input->post('tanggal');
        $tanggal    = formatDate($date.' '.$this->input->post('waktu'),'Y-m-d');
        $antrian    = $this->admin_model->get_antrian_penjualan($tanggal);
        echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            $('#antrian').val($antrian);
                        });
                    </script>";

    }

}
