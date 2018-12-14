<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Session         $session

 * @property pelanggan_model    $pelanggan_model
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
            $exist_id  = $this->pelanggan_model->cek_data("id_kendaraan='{$data['id_kendaraan']}' and 'kode_user'='{$data['kode_user']}' and kode_kendaraan !='{$kode_kendaraan}'",'kendaraan_user');
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

    #TODO -- lanjutkan edit dan delete

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
}
