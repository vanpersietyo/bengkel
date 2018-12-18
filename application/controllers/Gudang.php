<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 24/10/2018
 * Time: 14:29
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @property Admin_model     $admin_model
* @property Conversion      $conversion
*/
class Gudang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        if ($this->conversion->hak_akses_admin() == FALSE) {
            redirect(site_url(''));
        }
    }

//master supplier

    //tampilkan list daftar supplier
    // jika parameter di isi, berarti dia di akses dari menu tambah pembelian
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

    //proses input data supplier ke database
    //jika parameter di isi, berarti dia di akses dari menu tambah pembelian, sehingga akan kembali ke halaman transaksi setelah simpan
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

    //tampilkan halaman edit supplier by kode supplier
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

    //proses ubah data di database
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

    //proses hapus data di database
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

    //tampilkan list menu order pembelian
    public function daftar_order_pembelian()
    {
        $data       = [
            'page'              => 'pages/pembelian/daftar_order_pembelian',
            'title'             => 'Daftar Order Pembelian',
            'subtitle'          => 'Spare Part',
            'daftar_pembelian'  => $this->admin_model->get_list_pembelian("status_pembelian in ('input','belum_lunas') "),
        ];
        $this->load->view('templates/layout', $data);
    }

    //tampilkan list menu invoice pembelian
    public function daftar_invoice_pembelian()
    {
        $data       = [
            'page'              => 'pages/pembelian/daftar_invoice_pembelian',
            'title'             => 'Daftar Invoice Pembelian',
            'subtitle'          => 'Spare Part',
            'daftar_pembelian'  => $this->admin_model->get_list_pembelian("status_pembelian in ('lunas')")
        ];
        $this->load->view('templates/layout', $data);
    }

    //    Header
        //header pembelian : tampilkan form header pembelian barang
        public function add_pembelian()
        {
            $data   = array(
                'page'              => 'pages/pembelian/form_add_pembelian',
                'title'             => 'Tambah Pembelian',
                'subtitle'          => 'Spare Part',
                'kode_pembelian'    => $this->admin_model->get_kode_pembelian(),
                'daftar_supplier'   => $this->admin_model->select_data('supplier', 'entry_time', 'ASC'),
            );
            $this->load->view('templates/layout', $data);
        }

        //header pembelian : simpan header pembelian barang
        public function proses_tambah_supplier_pembelian()
        {
            $item       = [
                'kode_pembelian'        => $this->input->post('kode_pembelian'),
                'kode_supplier'         => $this->input->post('kode_supplier'),
                'keterangan_pembelian'  => $this->input->post('keterangan_pembelian'),
                'tgl_pembelian'         => date('Y-m-d').' '.$this->input->post('waktu'),
                'kode_user'             => $this->session->userdata('kode_user'),
                'status_pembelian'      => 'input'
            ];
            $exist  = $this->admin_model->cek_data(['kode_pembelian'=>$item['kode_pembelian']],'pembelian');
            if($exist->num_rows()==0){//cek kode pembelian, jika belum ada, lanjut
                $this->admin_model->insert_data('pembelian',$item);
                //echo 'data sukses';
                echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            swal({
                                title: 'Berhasil',
                                html: '<h5>Header Pembelian ".$item['kode_pembelian']." Berhasil Ditambahkan. Silahkan Lanjut Isi Barang </h5>',
                                type: 'success',
                                showCancelButton: false,
                            }).then(() => {
                                    location.href = '".site_url('add_pembelian_barang/').$item['kode_pembelian']."';
                            });
                        });
                    </script>";
            } else { //sudah ada, munculkan notif error
                echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            swal({
                                type    : 'error',
                                title   : 'Gagal',
                                html    : '<h4>Kode Pembelian Sudah Ada!</h4>',
                                allowOutsideClick: false,
                                focusConfirm: true,
                            })
                        });
                    </script>";
            }
        }

        //header pembelian = delete transaksi pembelian
        public function delete_pembelian($status,$kode_pembelian)
        {
            //delete data dari database
            $this->admin_model->delete_data('kode_pembelian', $kode_pembelian, 'pembelian');
            //set isi notif untuk ditampilkan
            $notif = "<script type='text/javascript'>
                        $( document ).ready(function() {
                            swal({
                                type    : 'success',
                                title   : 'Deleted!',
                                html    : '<h5>Transaksi No. {$kode_pembelian} Sudah Berhasil Dihapus!</h5>',
                                focusConfirm: true,
                            })
                        });
                    </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            //redirect ke halaman daftar kendaraan dengan membawa notif
            if ($status=='order'){
                redirect(site_url('order_pembelian.php'));
            }elseif ($status=='invoice'){
                redirect(site_url('invoice_pembelian.php'));
            }else {
                show_404();
            }

        }

    //    end of header

    //  start detail
        //detail pembelian = insert barang
        public function add_pembelian_barang($kode_pembelian)
        {
            $pembelian  =  $this->admin_model->get_list_pembelian("status_pembelian in ('input','belum_lunas') and kode_pembelian='{$kode_pembelian}'")->row();
            $data       = [
                'page'              => 'pages/pembelian/form_add_pembelian_barang',
                'title'             => 'Tambah Pembelian',
                'subtitle'          => 'Spare Part',
                'kode_pembelian'    => $kode_pembelian,
                'daftar_barang'     => $this->admin_model->cek_data(['jenis' => 'spare_part'],'barang', 'entry_time', 'ASC'),
                'pembelian'         => $pembelian,
                'supplier'          => $this->admin_model->cek_data(['kode_supplier'=>$pembelian->kode_supplier],'supplier')->row(),
                'pembelian_barang'  => $this->admin_model->get_list_barang_pembelian(['kode_pembelian' => $kode_pembelian]),
            ];
            $this->load->view('templates/layout', $data);
        }

        //detail pembelian = cari barang
        public function cari_barang_pembelian()
        {
            $kode_barang= $this->input->post('kode_barang');
            $exist      = $this->admin_model->cek_data(['kode' => $kode_barang],'barang');
            if ($exist->num_rows()==1){
                echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            $('#harga').val({$exist->row()->harga});
                            $('#satuan').val('{$exist->row()->satuan}');
                            $('#subtotal').val({$exist->row()->harga});  
                            $('#qty').focus();
                        });
                    </script>";
            }
        }

        //detail pembelian = insert barang
        public function proses_add_pembelian_barang($kode_pembelian)
        {
            $qty        = numberFormat($this->input->post('qty'),3);
            $harga      = numberFormat($this->input->post('harga'),3) ;
            $item       = [
                'kode_pembelian'    => $kode_pembelian,
                'kode_barang'       => $this->input->post('kode_barang'),
                'qty'               => $qty,
                'harga'             => $harga,
                'subtotal'          => $qty* $harga,
            ];

            if ($item['kode_barang']=='' || $qty<=0 || $harga<=0){ //jika belum pilih barang
                echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            swal({
                                type    : 'error',
                                title   : 'Gagal',
                                html    : '<h5>Silahkan Isi Data Spare Part Dahulu</h5>',
                                allowOutsideClick: false,
                                focusConfirm: true,
                            })
                        });
                    </script>";
            }else{
                $exist  = $this->admin_model->cek_data(
                    [
                        'kode_barang'   => $item['kode_barang'],
                        'kode_pembelian'=> $kode_pembelian
                    ],'pembelian_detail');
                if ($exist->num_rows()==0){//data belum ada
                    $this->admin_model->insert_data('pembelian_detail',$item);
                    $this->admin_model->sum_total_pembelian_barang($kode_pembelian);
                    echo "<script type='text/javascript'>
                        $( document ).ready(function() {                                
                            location.reload();//refresh halaman
                        });
                    </script>";
                } else {
                    //data sudah ada
                    echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            swal({
                                type    : 'error',
                                title   : 'Gagal',
                                html    : '<h5>Data Spare Part ".$item['kode_barang']." Sudah Ada!<br>Silahkan Edit Data.</h5>',
                                allowOutsideClick: false,
                                focusConfirm: true,
                            })
                        });
                    </script>";
                }
            }
        }

        public function form_edit_pembelian_barang($kode_pembelian,$kode_barang)
        {
            $pembelian  = $this->admin_model->get_list_pembelian("status_pembelian in ('input','belum_lunas') and kode_pembelian='{$kode_pembelian}'")->row();
            $data       = [
                'page'              => 'pages/pembelian/form_edit_pembelian_barang',
                'title'             => 'Ubah Pembelian',
                'subtitle'          => 'Spare Part',
                'kode_pembelian'    => $kode_pembelian,
                'barang'            => $this->admin_model->get_list_barang_pembelian(['kode_pembelian' => $kode_pembelian,'kode_barang'=>$kode_barang])->row(),
                'pembelian'         => $pembelian,
                'supplier'          => $this->admin_model->cek_data(['kode_supplier'=>$pembelian->kode_supplier],'supplier')->row(),
                'pembelian_barang'  => $this->admin_model->get_list_barang_pembelian(['kode_pembelian' => $kode_pembelian]),
            ];
            $this->load->view('templates/layout', $data);
        }

        public function proses_edit_pembelian_barang()
        {
            $kode_pembelian = $this->input->post('kode_pembelian');
            $qty            = numberFormat($this->input->post('qty'),3);
            $harga          = numberFormat($this->input->post('harga'),3) ;
            $item           = [
                'kode_barang'       => $this->input->post('kode_barang'),
                'qty'               => $qty,
                'harga'             => $harga,
                'subtotal'          => $qty*$harga,
            ];
            if ($item['kode_barang']=='' || $qty<=0 || $harga<=0){ //jika belum pilih barang
                echo "<script type='text/javascript'>
                        $( document ).ready(function() {
                            swal({
                                type    : 'error',
                                title   : 'Gagal',
                                html    : '<h5>Silahkan Isi Data Spare Part Dahulu</h5>',
                                allowOutsideClick: false,
                                focusConfirm: true,
                            })
                        });
                    </script>";
            }else{
                $id = $this->admin_model->cek_data(['kode_pembelian'=>$kode_pembelian,'kode_barang'=>$item['kode_barang']],'pembelian_detail')->row()->id;
                $this->admin_model->update_data('id',$id,'pembelian_detail',$item);
                $this->admin_model->sum_total_pembelian_barang($kode_pembelian);
                echo "<script type='text/javascript'>
                    $( document ).ready(function() {                  
                        location.href = '". site_url('add_pembelian_barang/'.$kode_pembelian)."';
                    });
                </script>";
            }

        }

        public function delete_pembelian_barang($kode_pembelian,$kode_barang)
        {
            $exist  = $this->admin_model->cek_data(['kode_pembelian'=>$kode_pembelian,'kode_barang'=>$kode_barang],'pembelian_detail');
            if ($exist->num_rows()==1){
                //delete data dari database
                $this->admin_model->delete_data('id', $exist->row()->id, 'pembelian_detail');
                $this->admin_model->sum_total_pembelian_barang($kode_pembelian);
                //redirect kembali
                redirect(site_url('add_pembelian_barang/'.$kode_pembelian));
            }
        }

        //header pembelian = delete transaksi pembelian
        public function simpan_pembelian_barang($kode_pembelian)
        {
            $simpan  = ['status_pembelian'=>'belum_lunas'];
            $this->admin_model->update_data('kode_pembelian',$kode_pembelian,'pembelian',$simpan);
            $notif = "<script type='text/javascript'>
                                $( document ).ready(function() {
                                    swal({
                                        type    : 'success',
                                        title   : 'Berhasil!',
                                        html    : '<h5>Transaksi No. {$kode_pembelian} Berhasil Disimpan!</h5>',
                                        focusConfirm: true,
                                    })
                                });
                            </script>";
            //set kedalam flash data
            $this->session->set_flashdata('notif', $notif);
            redirect(site_url('order_pembelian.php'));
        }

        //header pembelian = delete transaksi pembelian
        public function bayar_pembelian_barang($kode_pembelian)
        {
            $exist = $this->admin_model->cek_data(['kode_pembelian'=>$kode_pembelian],'pembelian');

            if ($exist->num_rows()==0){
                //pembelian tidak ada
                $notif = "<script type='text/javascript'>
                            $( document ).ready(function() {
                                swal({
                                    type    : 'error',
                                    title   : 'Gagal!',
                                    html    : '<h5>Data Pembelian Tidak Ditemukan!</h5>',
                                    focusConfirm: true,
                                })
                            });
                        </script>";
                //set kedalam flash data
                $this->session->set_flashdata('notif', $notif);
                redirect(site_url('order_pembelian.php'));
            } else {
                if ($exist->row()->total_pembelian <= 0){
                    //pembelian belum ada isi nya
                    $notif = "<script type='text/javascript'>
                            $( document ).ready(function() {
                                swal({
                                    type    : 'error',
                                    title   : 'Gagal!',
                                    html    : '<h5>Data Pembelian Spare Part Tidak Boleh Kosong!</h5>',
                                    focusConfirm: true,
                                })
                            });
                        </script>";
                    //set kedalam flash data
                    $this->session->set_flashdata('notif', $notif);
                    redirect(site_url('add_pembelian_barang/'.$kode_pembelian));
                }else{
                    $bayar  = [
                        'status_pembelian'      => 'lunas',
                        'tgl_pembayaran'        => date('Y-m-d H:i:s'),
                        'no_invoice_pembayaran' => $this->admin_model->get_no_invoice_pembelian()
                    ];
                    $this->admin_model->update_data('kode_pembelian',$kode_pembelian,'pembelian',$bayar);
                    $notif = "<script type='text/javascript'>
                            $( document ).ready(function() {
                                swal({
                                    type    : 'success',
                                    title   : 'Berhasil!',
                                    html    : '<h5>Transaksi No. {$kode_pembelian} Berhasil Di Bayar Dan Masuk ke list Invoice!</h5>',
                                    focusConfirm: true,
                                })
                            });
                        </script>";
                    //set kedalam flash data
                    $this->session->set_flashdata('notif', $notif);
                    redirect(site_url('invoice/'.$kode_pembelian));
                }
            }
        }
    //  end of detail

    public function invoice_pembelian($kode_pembelian){
        $pembelian  = $this->admin_model->get_list_pembelian(['status_pembelian'=>'lunas','kode_pembelian'=>$kode_pembelian])->row();
        $data   = [
            'page'              => 'pages/pembelian/invoice_pembelian',
            'title'             => 'Invoice Pembelian',
            'subtitle'          => $kode_pembelian,
            'pembelian'         => $pembelian,
            'supplier'          => $this->admin_model->cek_data(['kode_supplier'=>$pembelian->kode_supplier],'supplier')->row(),
            'detail_pembelian'  => $this->admin_model->get_list_barang_pembelian(['kode_pembelian' => $kode_pembelian])->result(),
        ];
        $this->load->view('templates/layout',$data);
    }
    #TODO - create fungsi edit pembelian barang

// end transaksi
}

