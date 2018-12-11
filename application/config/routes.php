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
$route['master/pelanggan.php']    = 'admin/daftar_pelanggan';
