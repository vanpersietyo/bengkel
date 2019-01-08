<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 20/12/2018
 * Time: 8:43
 */
?>
<div class="row">
    <div class="col-md-12">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-database"></i>
                <h3 class="box-title">Stok Spare Part</h3>
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
                            <th width="10%">Satuan</th>
                            <th width="10%">Qty Pembelian</th>
                            <th width="10%">Qty Penjualan</th>
                            <th class="text-center" width="10%">Stok</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;  foreach ($stok->result() as $key => $value){?>
                            <tr>
                                <?php if($value->stok<=5){?>
                                    <td class="text-center"><p style="color:red"><?=$i++?></p></td>
                                    <td> <p style="color:red"><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang)?></p></td>
                                    <td> <p style="color:red"><?=$value->satuan?></p></td>
                                    <td class="text-center"> <p style="color:red"><?=$value->qty_beli?></p></td>
                                    <td class="text-center"> <p style="color:red"><?=$value->qty_jual?></p></td>
                                    <td class="text-center"> <p style="color:red"><?=$value->stok?></p></td>
                                <?php }else {?>
                                    <td class="text-center"><?=$i++?></td>
                                    <td><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang)?></td>
                                    <td><?=$value->satuan?></td>
                                    <td class="text-center"><?=$value->qty_beli?></td>
                                    <td class="text-center"><?=$value->qty_jual?></td>
                                    <td class="text-center"><?=$value->stok?></td>
                                <?php } ?>

                            </tr>
                        <?php } ?>

                        </tbody>
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
            dom: 'Bfrtip',
            'autoWidth'   : false,
            "columnDefs": [
                { "orderable": false, "targets": [5] }
            ],
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
</script>


