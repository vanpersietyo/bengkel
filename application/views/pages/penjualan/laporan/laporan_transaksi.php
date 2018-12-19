<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 19/12/2018
 * Time: 19:06
 */
?>

<div class="row">
    <div class="col-md-12">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-sort-amount-asc"></i>
                <h3 class="box-title">List Transaksi Penjualan</h3>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="5%">No.</th>
                            <th width="15%">No. Penjualan</th>
                            <th width="17%">Tanggal Masuk</th>
                            <th width="20%">Nama Pelanggan</th>
                            <th width="15%">Kendaraan</th>
                            <th width="15%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;  foreach ($transaksi->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$i++;?></td>
                                <td><?=$value->kode_penjualan;?></td>
                                <td><?=formatDate($value->tgl_penjualan,'H:i').'&nbsp;&nbsp;&nbsp;'.dateIndo($value->tgl_penjualan,1);?></td>
                                <td><?=capitalize_each_first($value->nama_pelanggan);?></td>
                                <td><?=capitalize_each_first($value->nopol_kendaraan.' '.$value->merk.' - '.$value->tipe);?></td>
                                <td><?=get_status_penjualan($value->status_penjualan);?></td>
                                <td class="text-center">
                                    <a title="Cetak Invoice"    class="btn btn-flat btn-warning  btn-xs" href="<?= site_url('invoice_penjualan/'.$value->kode_penjualan)?>" ><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                        <?php }?>
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
            'autoWidth'   : false,
            "columnDefs": [
                { "orderable": false, "targets": [6] }
            ]
        });
    } );
</script>

