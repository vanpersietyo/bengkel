<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 19/12/2018
 * Time: 7:52
 */
?>

<div class="row">
    <div class="col-md-12">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-sort-amount-asc"></i>

                <h3 class="box-title">List Antrian Belum Verifikasi</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <a href="<?=site_url('add_antrian.php')?>" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Antrian</a>
                </div>
                <!-- /. tools -->
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
                            <th width="17%">Tanggal Masuk</th>
                            <th width="20%">Nama Pelanggan</th>
                            <th width="15%">Kendaraan</th>
                            <th width="15%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($antrian->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$value->antrian;?></td>
                                <td><?=$value->kode_penjualan;?></td>
                                <td><?=formatDate($value->tgl_penjualan,'H:i').'&nbsp;&nbsp;&nbsp;'.dateIndo($value->tgl_penjualan,1);?></td>
                                <td><?=capitalize_each_first($value->nama_pelanggan);?></td>
                                <td><?=capitalize_each_first($value->nopol_kendaraan.' '.$value->merk.' - '.$value->tipe);?></td>
                                <td><?=get_status_penjualan($value->status_penjualan);?></td>
                                <td class="text-center">
                                    <a title="Ubah Antrian Penjualan"     class="btn btn-flat btn-info    btn-xs" href="<?= site_url('add_detail_antrian/').$value->kode_penjualan?>"><i class="fa fa-edit"></i></a>
                                    <a title="Verifikasi Antrian Penjualan"    class="btn btn-flat btn-success  btn-xs" href="<?= site_url('verifikasi_antrian/'.$value->kode_penjualan)?>" ><i class="fa fa-check"></i></a>
                                    <a title="Hapus Antrian Penjualan"    class="btn btn-flat btn-danger  btn-xs" href="javascript:void(0)" onclick="delete_antrian('<?=$value->kode_penjualan?>')" ><i class="fa fa-close"></i></a>
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
<div class="row">
    <div class="col-md-12">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-sort-amount-asc"></i>
                <h3 class="box-title">List Antrian Yang Sudah Verifikasi</h3>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="table-responsive">

                    <table id="example1" class="table table-bordered table-striped">
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
                        <?php  foreach ($verifikasi->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$value->antrian;?></td>
                                <td><?=$value->kode_penjualan;?></td>
                                <td><?=formatDate($value->tgl_penjualan,'H:i').'&nbsp;&nbsp;&nbsp;'.dateIndo($value->tgl_penjualan,1);?></td>
                                <td><?=capitalize_each_first($value->nama_pelanggan);?></td>
                                <td><?=capitalize_each_first($value->nopol_kendaraan.' '.$value->merk.' - '.$value->tipe);?></td>
                                <td><?=get_status_penjualan($value->status_penjualan);?></td>
                                <td class="text-center">
                                    <a title="Ubah Antrian Penjualan"     class="btn btn-flat btn-info    btn-xs" href="<?= site_url('add_detail_antrian/').$value->kode_penjualan?>"><i class="fa fa-edit"></i></a>
                                    <a title="Proses Antrian Penjualan"    class="btn btn-flat btn-warning  btn-xs" href="<?= site_url('proses_antrian/'.$value->kode_penjualan)?>" ><i class="fa fa-forward"></i></a>
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
        });$('#example1').DataTable( {
            'autoWidth'   : false,
            "columnDefs": [
                { "orderable": false, "targets": [6] }
            ]
        });
    } );
    //function untuk delete data
    function delete_antrian($id) {
        swal({
            title: $id,
            html: '<h5>Yakin akan delete data antrian ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_antrian/')?>"+$id;
            }
        })
    }
</script>
