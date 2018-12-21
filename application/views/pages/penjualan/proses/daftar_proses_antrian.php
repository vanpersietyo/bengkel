<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 19/12/2018
 * Time: 14:47
 */
?>

<div class="row">
    <div class="col-md-12">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-sort-amount-asc"></i>
                <h3 class="box-title">List Proses Antrian Layanan  <?=dateIndo(date('d-m-Y'),1,date('N'))?></h3>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
            <div class="box-footer text-black">
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
                                    <a title="Selesai Proses Antrian Layanan"   class="btn btn-flat btn-warning btn-xs" href="<?= site_url('selesai_proses/').$value->kode_penjualan?>"><i class="fa fa-check"></i></a>
                                    <a title="Lihat Detail Antrian Layanan"     class="btn btn-flat btn-info btn-xs" href="<?= site_url('add_detail_antrian/').$value->kode_penjualan?>"><i class="fa fa-edit"></i></a>
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
