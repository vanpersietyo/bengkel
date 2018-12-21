<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 19/12/2018
 * Time: 12:18
 */
?>
<!--start box-->
<div class="box">
    <!--start form-->
    <!-- start box-body -->
    <div class="box-body with-border">

        <div class="box-header with-border">
            <h3 class="box-title">Header Transaksi Penjualan</h3>
        </div>

        <div class="box-body pad">


            <div class="form-group">
                <div class="row">
                    <div class="col-lg-8">
                        <label >Kode Penjualan</label>
                        <input readonly="readonly" type="text" name="kode_penjualan" value="<?=$penjualan->kode_penjualan?>" class="form-control">
                    </div>
                    <div class="col-lg-4 padding_left">
                        <label>Antrian</label>
                        <input readonly="readonly" type="text" name="antrian" class="form-control" value="<?=$penjualan->antrian?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-8">
                        <label >Tanggal</label>
                        <input readonly="readonly" type="text" name="tgl_penjualan" class="form-control" value="<?=dateIndo(formatDate($penjualan->tgl_penjualan,'d-m-Y'),1,date('N'))?>">
                    </div>
                    <div class="col-lg-4 padding_left">
                        <label>Waktu</label>
                        <input readonly="readonly" type="text" name="waktu" class="form-control" value="<?=formatDate($penjualan->tgl_penjualan,'H:i:s')?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="namaPemesan">Pelanggan</label>
                <input disabled="disabled" class="form-control" value="<?=$penjualan->nama_pelanggan?>">
            </div>

            <div class="form-group">
                <label for="namaPemesan">Kendaraan</label>
                <input disabled="disabled" class="form-control" value="<?=$penjualan->merk.' - '.$penjualan->tipe?>">
            </div>

            <div class="form-group">
                <label for="namaPemesan">No. Polisi</label>
                <input disabled="disabled" class="form-control" value="<?=$penjualan->nopol_kendaraan?>">
            </div>

            <div class="form-group">
                <label for="AlamatPemesan">Status</label>
                <input disabled="disabled" class="form-control" value="<?=get_status_penjualan($penjualan->status_penjualan);?>">

            </div>

            <div class="form-group">
                <label for="AlamatPemesan">Keterangan</label>
                <textarea disabled="disabled" class="form-control" type="text"  rows="4" cols="50" ><?=$penjualan->keterangan_penjualan?></textarea>
            </div>

        </div>
        <!-- /.form group -->
    </div>
    <!-- end box-body -->

    <!--end form-->
</div>
<!--end box-->
