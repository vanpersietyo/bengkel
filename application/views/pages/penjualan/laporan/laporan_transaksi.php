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
                            <th width="17%">Tanggal Transaksi</th>
                            <th width="20%">Nama Pelanggan</th>
                            <th width="15%">Kendaraan</th>
                            <th width="15%">Total</th>
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
                                <td><?=$value->nopol_kendaraan.' '.$value->merk.' - '.$value->tipe;?></td>
                                <td><?=numberFormat($value->total_penjualan);?></td>
                                    <?php if ($value->status_penjualan==1){?>
                                        <td>
                                            <span class="label label-danger">Antrian</span>
                                        </td>
                                        <td class="text-center">
                                            <a title="Lihat Antrian"    class="btn btn-flat btn-danger  btn-xs" href="<?= site_url('add_detail_antrian/'.$value->kode_penjualan)?>" ><i class="fa fa-arrow-circle-right"></i></a>
                                        </td>
                                    <?php } elseif ($value->status_penjualan==2){?>
                                        <td>
                                            <span class="label label-warning">Verifikasi</span>
                                        </td>
                                        <td class="text-center">
                                            <a title="Lihat Detail"    class="btn btn-flat btn-warning  btn-xs" href="<?= site_url('add_detail_antrian/'.$value->kode_penjualan)?>" ><i class="fa fa-arrow-circle-right"></i></a>
                                        </td>
                                    <?php } elseif ($value->status_penjualan==3){?>
                                        <td>
                                            <span class="label label-info">Proses</span>
                                        </td>
                                        <td class="text-center">
                                            <a title="Lihat Proses"    class="btn btn-flat btn-info  btn-xs" href="<?= site_url('add_detail_antrian/'.$value->kode_penjualan)?>" ><i class="fa fa-arrow-circle-right"></i></a>
                                        </td>
                                    <?php }elseif ($value->status_penjualan==4){?>
                                        <td>
                                            <span class="label label-primary">Belum Lunas</span>
                                        </td>
                                        <td class="text-center">
                                            <a title="Lihat Detail"    class="btn btn-flat btn-primary  btn-xs" href="<?= site_url('add_detail_antrian/'.$value->kode_penjualan)?>" ><i class="fa fa-arrow-circle-right"></i></a>
                                        </td>
                                    <?php }elseif ($value->status_penjualan==5){?>
                                        <td>
                                            <span class="label label-success">Lunas</span>
                                        </td>
                                        <td class="text-center">
                                            <a title="Cetak Invoice"    class="btn btn-flat btn-success  btn-xs" href="<?= site_url('invoice_penjualan/'.$value->kode_penjualan)?>" ><i class="fa fa-print"></i></a>
                                        </td>
                                    <?php } ?>
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
                { "orderable": false, "targets": [7] }
            ]
        });
    } );
</script>

