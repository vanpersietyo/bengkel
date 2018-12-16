<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Pages
$route['page']          = 'pages/view';
$route['page/(:any)']   = 'pages/view/$1';

//login register forgot password
$route['register']          = 'login/register';
$route['forgot_password']   = 'login/forgot_password';
$route['aktivasi/(:any)']   = 'login/aktivasi/$1';
$route['forgot.do']         = 'login/proses_forgot_password';
$route['reset/(:any)']      = 'login/reset_password/$1';
$route['reset.do']          = 'login/proses_reset_password';

//User
$route['dashboard']        = 'user/index';
$route['profile']          = 'user/profile';
$route['logout.php']       = 'login/logout';

//Master
$route['master/user']           = 'superadmin/user';
$route['master/superuser']      = 'user/daftar_user/superuser';
$route['master/pegawai']        = 'user/daftar_user/pegawai';

//kendaraan
$route['master/kendaraan.php']          = 'admin/daftar_kendaraan';
$route['master/add_kendaraan.php']      = 'admin/add_kendaraan';
$route['master/tambah_kendaraan.do']    = 'admin/proses_add_kendaraan';
$route['master/delete_kendaraan/(:any)']= 'admin/delete_kendaraan/$1';
$route['master/edit_kendaraan/(:any)']  = 'admin/edit_kendaraan/$1';
$route['master/edit_kendaraan.do']      = 'admin/proses_edit_kendaraan';

//master kategori barang/
    //layanan
    $route['master/jenis_layanan.php']          = 'admin/daftar_kategori_barang/layanan';
    $route['master/tambah_jenis_layanan.php']   = 'admin/proses_tambah_kategori_barang/layanan';
    $route['master/hapus_jenis_layanan/(:any)'] = 'admin/delete_kategori_barang/layanan/$1';
    $route['master/edit_jenis_layanan/(:any)']  = 'admin/edit_kategori_barang/layanan/$1';
    $route['master/edit_jenis_layanan.do']      = 'admin/proses_edit_kategori_barang/layanan';

    //spare part
    $route['master/jenis_spare_part.php']           = 'admin/daftar_kategori_barang/spare_part';
    $route['master/tambah_jenis_spare_part.php']    = 'admin/proses_tambah_kategori_barang/spare_part';
    $route['master/hapus_jenis_spare_part/(:any)']  = 'admin/delete_kategori_barang/spare_part/$1';
    $route['master/edit_jenis_spare_part/(:any)']   = 'admin/edit_kategori_barang/spare_part/$1';
    $route['master/edit_jenis_spare_part.do']       = 'admin/proses_edit_kategori_barang/spare_part';


//master barang/
    //layanan
    $route['master/layanan.php']                = 'admin/daftar_barang/layanan';
    $route['master/tambah_layanan.php']         = 'admin/proses_tambah_barang/layanan';
    $route['master/hapus_layanan/(:any)']       = 'admin/delete_barang/layanan/$1';

    //spare part
    $route['master/spare_part.php']             = 'admin/daftar_barang/spare_part';
    $route['master/tambah_spare_part.php']      = 'admin/proses_tambah_barang/spare_part';
    $route['master/hapus_spare_part/(:any)']    = 'admin/delete_barang/spare_part/$1';

//master pelanggan
$route['master/pelanggan.php']      = 'admin/daftar_pelanggan';

//master supplier
$route['master/supplier.php']           = 'gudang/daftar_supplier';
$route['master/add_supplier.php']       = 'gudang/daftar_supplier/1';//pparameter untuk penunjuk akses halaman dari add pembelian
$route['master/tambah_supplier.php/(:any)']= 'gudang/prosess_tambah_supplier/1';//pparameter untuk penunjuk akses halaman dari add pembelian
$route['master/tambah_supplier.php']    = 'gudang/prosess_tambah_supplier';
$route['master/edit_supplier/(:any)']   = 'gudang/edit_supplier/$1';
$route['master/edit_supplier.php']      = 'gudang/prosess_edit_supplier';
$route['master/delete_supplier/(:any)'] = 'gudang/delete_supplier/$1';

//Menu Pelanggan
    //Daftar Kendaraan
    $route['kendaraan.php']           = 'pelanggan/daftar_kendaraan';
    $route['tambah_kendaraan.php']    = 'pelanggan/proses_tambah_kendaraan';
    $route['delete_kendaraan/(:any)'] = 'pelanggan/delete_kendaraan/$1';
    $route['edit_kendaraan/(:any)']   = 'pelanggan/form_edit_kendaraan/$1';
    $route['edit_kendaraan.do/(:any)']= 'pelanggan/proses_edit_kendaraan/$1';

//Menu Gudang
    //pembelian
    $route['order_pembelian.php']          = 'gudang/daftar_order_pembelian';
    $route['invoice_pembelian.php']        = 'gudang/daftar_invoice_pembelian';
    $route['cari_barang_pembelian.php']    = 'gudang/cari_barang_pembelian';

    $route['add_pembelian.php']                     = 'gudang/add_pembelian';
    $route['add_supplier_pembelian.php']            = 'gudang/proses_tambah_supplier_pembelian';
    $route['add_pembelian_barang/(:any)']           = 'gudang/add_pembelian_barang/$1';
    $route['add_pembelian_barang.do/(:any)']        = 'gudang/proses_add_pembelian_barang/$1';
    $route['edit_pembelian_barang/(:any)/(:any)']   = 'gudang/form_edit_pembelian_barang/$1/$2';
    $route['delete_pembelian_barang/(:any)/(:any)'] = 'gudang/delete_pembelian_barang/$1/$2';
    $route['simpan_pembelian_barang/(:any)']        = 'gudang/simpan_pembelian_barang/$1';
    $route['bayar_pembelian_barang/(:any)']         = 'gudang/bayar_pembelian_barang/$1';

    $route['delete_order_pembelian/(:any)']     = 'gudang/delete_pembelian/order/$1';
    $route['delete_invoice_pembelian/(:any)']   = 'gudang/delete_pembelian/invoice/$1';


