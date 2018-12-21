<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 14/12/2018
 * Time: 9:37
 */
?>
<li class="header">LAPORAN</li>
<!--<li>-->
<!--    <a  href="--><?//=site_url('dashboard')?><!--" >-->
<!--        <i class="fa fa-calendar"></i> <span>Transaksi Harian</span>-->
<!--    </a>-->
<!--</li>-->
<li>
<a  href="<?=site_url('laporan_transaksi.php')?>" >
    <i class="fa fa-calendar"></i> <span>Transaksi Penjualan</span>
</a>
</li>
<li>
    <a  href="<?=site_url('laporan_pembelian_spare_part.php')?>" >
        <i class="fa fa-calendar"></i> <span>Pembelian Spare Part</span>
    </a>
</li>
<li>
    <a  href="<?=site_url('laporan_penjualan_spare_part.php')?>" >
        <i class="fa fa-calendar"></i> <span>Penjualan Spare Part</span>
    </a>
</li>
<li>
    <a  href="<?=site_url('laporan_stok_spare_part.php')?>">
        <i class="fa fa-calendar"></i> <span>Stok Spare Part</span>
    </a>
</li>
