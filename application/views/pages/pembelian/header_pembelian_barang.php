<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 17/12/2018
 * Time: 11:04
 */
?>
<!--  start  -->
<div class="col-lg-4">
    <!--start box-->
    <div class="box">
        <!--start form-->
        <!-- start box-body -->
        <div class="box-body with-border">

            <div class="box-header with-border">
                <h3 class="box-title">Header Transaksi Pembelian</h3>
            </div>

            <div class="box-body pad">

                <div class="form-group">
                    <label for="AlamatPemesan">Kode Pembelian</label>
                    <input disabled="disabled" value="<?=$pembelian->kode_pembelian?>" class="form-control">
                </div>

                <div>
                    <div class="row form-group">
                        <div class="col-lg-8">
                            <label >Tanggal</label>
                            <input disabled="disabled" class="form-control" value="<?=dateIndo(formatDate($pembelian->tgl_pembelian,'d-m-Y'),1,date('N'))?>">
                        </div>
                        <div class="col-lg-4 padding_left">
                            <label>Waktu</label>
                            <input disabled="disabled"  class="form-control" value="<?=formatDate($pembelian->tgl_pembelian,'H:i:s')?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input disabled="disabled" class="form-control" value="<?=$supplier->kode_supplier.' - '.$supplier->nama_supplier?>">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea disabled="disabled" class="form-control" type="text"  rows="4" cols="50"><?=$pembelian->keterangan_pembelian?></textarea>
<!--                    <input disabled="disabled" class="form-control" value="--><!--">-->
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input disabled="disabled" class="form-control" value="<?=$this->conversion->get_status_pembelian($pembelian->status_pembelian);?>">
                </div>

            </div>
            <!-- /.form group -->
        </div>
        <!-- end box-body -->
    </div>
    <!--end box-->
</div>
<!--  end  -->
