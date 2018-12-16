<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 14/12/2018
 * Time: 9:37
 */
?>
<li class="treeview">
    <a href="#">
        <i class="fa  fa-cart-arrow-down"></i> <span>Pembelian Spare Part</span>
        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= site_url('add_pembelian.php')?>"><i class="fa fa-circle-o"></i> Tambah Pembelian</a></li>
        <li><a href="<?= site_url('order_pembelian.php')?>"><i class="fa fa-circle-o"></i>List Order Pembelian</a></li>
        <li><a href="<?= site_url('invoice_pembelian.php')?>"><i class="fa fa-circle-o"></i>List Invoice Pembelian</a></li>
    </ul>
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
        <i class="fa fa-calendar"></i> <span>Pembelian Spare Part</span>
    </a>
</li>
<li>
    <a  href="<?=site_url('master/barang')?>">
        <i class="fa fa-calendar"></i> <span>Stok Spare Part</span>
    </a>
</li>
<li>
    <a  href="<?=site_url('master/barang')?>">
        <i class="fa fa-calendar"></i> <span>Penjualan Spare Part</span>
    </a>
</li>
