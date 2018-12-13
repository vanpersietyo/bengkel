<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 22/10/2018
 * Time: 14:43
 */
?>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a  href="<?=site_url('dashboard')?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php
            if ($this->session->userdata('level')=='1'){?>

                <li class="header">DATA MASTER</li>

                <li class="treeview">
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Register Servis</span>
                    </a>
                </li>


            <?php }elseif ($this->session->userdata('level')=='2'){?>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Register Servis</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Transaksi Servis</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Cek Stok Spare Part</span>
                    </a>
                </li>

                <li class="header">DATA MASTER</li>
                <li>
                    <a  href="<?=site_url('master/pelanggan.php')?>">
                        <i class="fa fa-calendar"></i> <span>Pelanggan</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-opencart"></i> <span>Layanan</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('master/jenis_layanan.php')?>"><i class="fa fa-circle-o"></i> Jenis Layanan</a></li>
                        <li><a href="<?= site_url('master/layanan.php')?>"><i class="fa fa-circle-o"></i> Daftar Layanan</a></li>
                    </ul>
                </li>

                <li>
                    <a  href="<?=site_url('master/kendaraan.php')?>">
                        <i class="fa fa-car"></i> <span>Kendaraan</span>
                    </a>
                </li>

                <li class="header">Laporan</li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Laporan Servis Harian</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Laporan Penjualan Spare Part</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Laporan Stok Spare Part</span>
                    </a>
                </li>
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="fa fa-calendar"></i> <span>Tabel</span>-->
<!--                        <span class="pull-right-container">-->
<!--                            <small class="label pull-right bg-red">3</small>-->
<!--                            <small class="label pull-right bg-blue">17</small>-->
<!--                        </span>-->
<!--                    </a>-->
<!--                </li>-->

<!--                gudang-->
            <?php }elseif ($this->session->userdata('level')=='3'){?>

                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-cart-arrow-down"></i> <span>Pembelian Spare Part</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('master/jenis_spare_part.php')?>"><i class="fa fa-circle-o"></i> Tambah Pembelian</a></li>
                        <li><a href="<?= site_url('master/spare_part.php')?>"><i class="fa fa-circle-o"></i> List Pembelian</a></li>
                    </ul>
                </li>

                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Cek Stok Spare Part</span>
                    </a>
                </li>

                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-upload"></i> <span>List Penjualan Spare Part</span>
                    </a>
                </li>

                <li class="header">DATA MASTER</li>

                <li>
                    <a  href="<?=site_url('master/supplier.php')?>">
                        <i class="fa fa-truck"></i> <span>Supplier</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cubes"></i> <span>Spare Part</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('master/jenis_spare_part.php')?>"><i class="fa fa-circle-o"></i> Jenis Spare Part</a></li>
                        <li><a href="<?= site_url('master/spare_part.php')?>"><i class="fa fa-circle-o"></i> Daftar Spare Part</a></li>
                    </ul>
                </li>
                <li class="header">Laporan</li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Laporan Spare Part Masuk</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>Laporan Stok Spare Part</span>
                    </a>
                </li>
            <?php }elseif ($this->session->userdata('level')=='4'){?>
<!--                montir belum ada hak akses-->
            <?php }elseif ($this->session->userdata('level')=='5'){?>
                <li>
                    <a  href="<?=site_url('dashboard')?>" >
                        <i class="fa fa-calendar"></i> <span>Servis</span>
                    </a>
                </li>

                <li class="header">INFO</li>
                <li>
                    <a  href="<?=site_url('kendaraan.php')?>">
                        <i class="fa fa-car"></i> <span>Kendaraan Anda</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('dashboard')?>" >
                        <i class="fa fa-calendar"></i> <span>History Servis</span>
                    </a>
                </li>
            <?php }elseif ($this->session->userdata('level')=='6'){?>

                <li class="header">LAPORAN</li>
                <li>
                    <a  href="<?=site_url('dashboard')?>" >
                        <i class="fa fa-calendar"></i> <span>LAPORAN SERVIS</span>
                    </a>
                <li>
                </li>
                <a  href="<?=site_url('dashboard')?>" >
                        <i class="fa fa-calendar"></i> <span>LAPORAN PENJUALAN Spare Part</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('dashboard')?>" >
                        <i class="fa fa-calendar"></i> <span>LAPORAN PEMBELIAN Spare Part</span>
                    </a>
                </li>
                <li>
                    <a  href="<?=site_url('master/barang')?>">
                        <i class="fa fa-calendar"></i> <span>LAPORAN STOK Spare Part</span>
                    </a>
                </li>
            <?php }else{

            }

            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
