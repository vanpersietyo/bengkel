<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 24/10/2018
 * Time: 14:29
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @property CI_Session      $session
* @property admin_model     $admin_model
* @property conversion      $conversion
* @property CI_Input        $input
*/
class Gudang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        if ($this->conversion->hak_akses_admin() == FALSE) {
            redirect('');
        }
    }

//master supplier
    public function daftar_supplier($from_add_pembelian=null)
    {
        $data = [
            'page'              => 'pages/master/supplier/daftar_supplier',
            'title'             => 'Daftar',
            'subtitle'          => 'Supplier',
            'action'            => 'input',
            'kode_supplier'     => $this->admin_model->get_kode_supplier(),
            'daftar_supplier'   => $this->admin_model->select_data('supplier', 'entry_time', 'ASC'),
            'from_add_pembelian'=> $from_add_pembelian
        ];
        $this->load->view('templates/layout', $data);
    }

    public function prosess_tambah_supplier($from_add_pembelian=null)
    {
        $data = [
            'kode_supplier'         => $this->admin_model->get_kode_supplier(),
            'nama_supplier'         => $this->input->post('nama'),
            'alamat_supplier'       => $this->input->post('alamat'),
            'telp_supplier'         => $this->input->post('telepon'),
            'keterangan_supplier'   => $this->input->post('keterangan'),
            'add_by'                => $this->session->userdata('username')
        ];
        $exist = $this->admin_model->cek_data("nama_supplier='{$data['nama_supplier']}'",'supplier')->num_rows();
        if($exist==0){
            $this->admin_model->insert_data('supplier',$data);
            //echo 'data sukses';

            if ($from_add_pembelian==null){
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h5>Supplier {$data['kode_supplier']} Berhasil Ditambahkan</h5>',
                            type: 'success',
                            showCancelButton: false,
                        }).then(() => {
                                location.reload();//refresh halaman
                        });
                    });
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h5>Supplier {$data['kode_supplier']} Berhasil Ditambahkan</h5>',
                            type: 'success',
                            showCancelButton: false,
                        }).then(() => {
                                location.href = '". site_url('add_pembelian.php')."';
                        });
                    });
                </script>";
            }

        } else { //data supplier sudah ada
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

    public function edit_supplier($kode_supplier)
    {
        $data = [
            'page'              => 'pages/master/supplier/daftar_supplier',
            'title'             => 'Daftar',
            'subtitle'          => 'Supplier',
            'action'            => 'edit',
            'daftar_supplier'   => $this->admin_model->select_data('supplier', 'entry_time', 'ASC'),
            'supplier'          => $this->admin_model->cek_data("kode_supplier = '{$kode_supplier}'", 'supplier', 'entry_time', 'ASC')->row()
        ];
        $this->load->view('templates/layout', $data);
    }

    public function prosess_edit_supplier()
    {
        $kode_supplier = $this->input->post('kode');
        $data = [
            'nama_supplier'         => $this->input->post('nama'),
            'alamat_supplier'       => $this->input->post('alamat'),
            'telp_supplier'         => $this->input->post('telepon'),
            'keterangan_supplier'   => $this->input->post('keterangan'),
        ];

        $no_change = $this->admin_model->cek_data($data,'supplier')->num_rows();        //cek ada perubahan atau tidak
        if ($no_change==1){//            tidak ada perubahan
            //set notif
            echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'error',
                            title   : 'Gagal',
                            html    : '<h4>Tidak Ada Perubahan!</h4>',
                            allowOutsideClick: false,
                            focusConfirm: true,
                        })
                    });
                </script>";
        }else {//ada perubahan
            //cek nama yang di update sudah ada atau belum
            $exist = $this->admin_model->cek_data("nama_supplier='{$data['nama_supplier']}' and kode_supplier !='{$kode_supplier}'",'supplier')->num_rows();
            if($exist==0){
                //lakukan update
                $data['changed_by']= $this->session->userdata('username');
                $this->admin_model->update_data('kode_supplier',$kode_supplier,'supplier',$data);
                //echo 'data sukses';
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            title: 'Berhasil',
                            html: '<h4>Supplier {$kode_supplier} Berhasil Diubah </h4>',
                            type: 'success',
                            showCancelButton: false,
                        }).then(() => {
                                location.reload();//refresh halaman
                        });
                    });
                </script>";
            } else { //data supplier sudah ada
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

    public function delete_supplier($kode_supplier)
    {
        //delete data dari database
        $this->admin_model->delete_data('kode_supplier', $kode_supplier, 'supplier');
        //set isi notif untuk ditampilkan
        $notif = "<script type='text/javascript'>
                    $( document ).ready(function() {
                        swal({
                            type    : 'success',
                            title   : 'Deleted!',
                            html    : '<h5>Supplier {$kode_supplier} Sudah Berhasil Dihapus!</h5>',
                            focusConfirm: true,
                        })
                    });
                </script>";
        //set kedalam flash data
        $this->session->set_flashdata('notif', $notif);
        //redirect ke halaman daftar kendaraan dengan membawa notif
        redirect(site_url('master/supplier.php'));
    }
//end master supplier

// start transaksi
    public function add_pembelian()
    {
        $where  = ['jenis' => 'spare_part'];
        $data   = [
            'page'              => 'pages/pembelian/form_add_pembelian',
            'title'             => 'Tambah Pembelian',
            'subtitle'          => 'Spare Part',
            'action'            => 'input',
            'daftar_supplier'   => $this->admin_model->select_data('supplier', 'entry_time', 'ASC'),
            'daftar_barang'     => $this->admin_model->cek_data($where,'barang', 'entry_time', 'ASC')
        ];
        $this->load->view('templates/layout', $data);
    }
// end transaksi

#TODO - create insert dan update master supplier
}

