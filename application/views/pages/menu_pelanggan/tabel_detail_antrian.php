<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 20/12/2018
 * Time: 18:47
 */
?>

<!--start box-->
<div class="box">
    <!-- start box-body -->
    <div class="box-body with-border padding_bottom">
        <h5><strong>List Layanan</strong></h5>
        <div class="table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center" width="5%">No.</th>
                    <th width="30%">Layanan</th>
                    <th width="15%">Jumlah</th>
                    <th width="15%">Harga</th>
                    <th width="15%">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($layanan->result() as $key => $value){?>
                    <tr>
                        <td class="text-center"><?=$i++?></td>
                        <td ><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang);?></td>
                        <td class="text-center"><?=$value->qty;?></td>
                        <td><?=numberFormat($value->harga);?></td>
                        <td><?=numberFormat($value->subtotal);?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

    </div>

    <div class="box-body with-border padding_bottom">
        <h5><strong>List Spare Part</strong></h5>
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center" width="5%">No.</th>
                    <th width="30%">Spare Part</th>
                    <th width="10%" class="text-center">Qty</th>
                    <th width="10%">Satuan</th>
                    <th width="15%">Harga</th>
                    <th width="15%">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($spare_part->result() as $key => $value){?>
                    <tr>
                        <td class="text-center"><?=$i++?></td>
                        <td ><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang);?></td>
                        <td class="text-center"><?=$value->qty;?></td>
                        <td><?=$value->satuan;?></td>
                        <td><?=numberFormat($value->harga);?></td>
                        <td><?=numberFormat($value->subtotal);?></td>
                    </tr>
                <?php }?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Tagihan </th>
                    <th> <?=numberFormat($penjualan->total_penjualan)?></th>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
<!--end box-->

<script>
    $(function () {
        //data tabel
        $('#example2').DataTable({
            'autoWidth'   : false,
        });
        //data tabel
        $('#example').DataTable({
            'autoWidth'   : false,
        });
    });
</script>
