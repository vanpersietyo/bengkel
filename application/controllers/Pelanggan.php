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

    public function daftar_servis()
    {
        $data = [
            'page'              => 'pages/menu_pelanggan/servis/daftar_servis',
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
        var_dump($data);
        $exist  = $this->pelanggan_model->cek_data(
                "id_kendaraan='{$data['id_kendaraan']}' and nopol_kendaraan='{$data['nopol_kendaraan']}' and kode_user='{$data['kode_user']}' and kode_kendaraan != '{$data['kode_kendaraan']}'  ",
                'kendaraan_user'
                )->num_rows();
        echo $exist;
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

    #TODO -- lanjutkan edit dan delete
}
