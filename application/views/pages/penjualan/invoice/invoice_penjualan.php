<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 19/12/2018
 * Time: 18:44
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 18/12/2018
 * Time: 8:12
 */
?>
<style>
    /*@page { size: landscape;}*/

    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }

    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
</style>
<div class="panel">
    <div class="panel-body">

        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice Pembelian </h2><h3 class="pull-right">No. <?=$penjualan->no_invoice_pembayaran?></h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Dari :</strong><br>
                            Bengkel Mobil ABC <br>
                            Jl. Raya Kemasan No.98, Kec. Krian,<br>
                            Kabupaten Sidoarjo, Jawa Timur 61262<br>
                            Telp : 0812-3037-3137
                        </address>
                    </div>
                    <div class="col-xs-2 text-right"></div>
                    <div class="col-xs-4 text-right">
                        <address>
                            <strong>Kepada:</strong><br>
                            <?=$penjualan->no_pelanggan?><br>
                            <?=$penjualan->nama_pelanggan?><br>
                            <?=$penjualan->alamat?><br>
                            <?=$penjualan->telepon?><br>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Pembelian:</strong><br>
                            No : <?=$penjualan->kode_penjualan?><br>
                            Tgl : <?=dateIndo(formatDate($penjualan->tgl_penjualan,'d-m-Y'),1,date('N'))?><br>
                            Ket : <?=$penjualan->keterangan_penjualan;?>

                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Status / Tgl Pembayaran :</strong><br>

                            <span class="label label-success">Lunas</span> <br>
                            <?=dateIndo(formatDate($penjualan->tgl_pembayaran,'d-m-Y'),1,date('N'))?>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Ringkasan Pembelian</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td class="text-center"><strong>No.</strong></td>
                                <td><strong>Spare Part</strong></td>
                                <td class="text-center"><strong>Qty</strong></td>
                                <td class=""><strong>Satuan</strong></td>
                                <td class="text-right"><strong>Harga</strong></td>
                                <td class="text-right"><strong>Subtotal</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <?php $i=1; foreach ($detail_penjualan as $key => $value){?>
                                <tr>
                                    <td class="no-line text-center"><?=$i++?></td>
                                    <td class="no-line"><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang);?></td>
                                    <td class="no-line text-center"><?=$value->qty;?></td>
                                    <td class="no-line"><?=$value->satuan;?></td>
                                    <td class="no-line text-right"><?=numberFormat($value->harga);?></td>
                                    <td class="no-line text-right"><?=numberFormat($value->subtotal);?></td>
                                </tr>
                            <?php }?>


                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-right"><strong>Total (Rp)</Rp></strong></td>
                                <td class="no-line text-right"><strong><?=numberFormat($penjualan->total_penjualan)?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="box-footer text-center">
                <a type="button" href="<?= site_url('invoice_antrian.php')?>" class="btn btn-warning">Kembali</a>
                <button type="button" onclick="window.print();" class="btn btn-info"><i class="fa fa-print-o"></i>Cetak</button>
            </div>
        </div>
    </div>
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>
