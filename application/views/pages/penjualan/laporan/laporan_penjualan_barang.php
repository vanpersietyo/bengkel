<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 20/12/2018
 * Time: 7:58
 */?>
<div class="row">
    <div class="col-md-12">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-sort-amount-asc"></i>
                <h3 class="box-title">List Penjualan Spare Part</h3>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="5%">No.</th>
                            <th width="30%">Spare Part</th>
                            <th width="5%">Qty</th>
                            <th width="5%">Satuan</th>
                            <th width="10%">Harga (Rp.)</th>
                            <th width="10%">Subtotal (Rp.)</th>
                            <th width="10%">Kode Penjualan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;  foreach ($transaksi->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$i++;?></td>
                                <td><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang)?></td>
                                <td class="text-center"><?=$value->qty;?></td>
                                <td><?=$value->satuan;?></td>
                                <td><?=numberFormat($value->harga);?></td>
                                <td><?=numberFormat($value->subtotal);?></td>
                                <td>
                                    <a title="Lihat Detail" class="btn btn-flat btn-success btn-xs" href="<?= site_url('add_detail_antrian/'.$value->kode_penjualan)?>"><?=$value->kode_penjualan;?></a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="2"><strong>Jumlah Qty</strong></th>
                                <th class="text-center"><?=numberFormat($total->qty)?></th>
                                <th class="text-center" colspan="2"><strong>Total </strong></th>
                                <th colspan="2"><?=numberFormat($total->total)?></th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>


<div class="result_content"></div>
<?=$this->session->flashdata('notif');?>

<script type="text/javascript">
    //untuk datatable
    $(document).ready(function() {
        $('#example2').DataTable( {
            'autoWidth'   : false
        });
    } );
</script>


