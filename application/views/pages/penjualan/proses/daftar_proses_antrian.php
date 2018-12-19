<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 19/12/2018
 * Time: 14:47
 */
?>
<div class="row">
    <section class="col-lg-12 connectedSortable">

        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-sort-amount-asc"></i>

                <h3 class="box-title">List Proses Antrian Layanan Bengkel</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <a href="<?=site_url('add_antrian.php')?>" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Antrian</a>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">Antrian</th>
                                    <th width="15%">No. Penjualan</th>
                                    <th width="15%">Tanggal Masuk</th>
                                    <th width="20%">Nama Pelanggan</th>
                                    <th width="15%">Kendaraan</th>
                                    <th width="15%">Status</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  foreach ($daftar_penjualan->result() as $key => $value){?>
                                    <tr>
                                        <td class="text-center"><?=$value->antrian;?></td>
                                        <td><?=$value->kode_penjualan;?></td>
                                        <td><?=formatDate($value->tgl_penjualan,'H:i').'&nbsp;&nbsp;&nbsp;'.dateIndo($value->tgl_penjualan,1);?></td>
                                        <td><?=capitalize_each_first($value->nama_pelanggan);?></td>
                                        <td><?=capitalize_each_first($value->nopol_kendaraan.' '.$value->merk.' - '.$value->tipe);?></td>
                                        <td><?=get_status_penjualan($value->status_penjualan);?></td>
                                        <td class="text-center">
                                            <a title="Lihat Detail Antrian Layanan"     class="btn btn-flat btn-info    btn-xs" href="<?= site_url('add_detail_antrian/').$value->kode_penjualan?>"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->

    </section>
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
