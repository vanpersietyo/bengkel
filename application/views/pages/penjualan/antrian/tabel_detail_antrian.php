<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 19/12/2018
 * Time: 12:21
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
                    <th width="12%">Aksi</th>
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
                            <td class="text-center">
                                <a title="edit data layanan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('edit_detail_antrian/').$value->kode_penjualan.'/'.$value->kode_barang?>"><i class="fa fa-edit"></i></a>
                                <a title="hapus data layanan" class="btn btn-flat btn-danger btn-xs" onclick="delete_detail_barang('<?=$value->kode_penjualan?>','<?=$value->kode_barang?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                            </td>
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
                    <th width="12%">Aksi</th>
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
                            <td class="text-center">
                                <a title="edit data" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('edit_detail_antrian/').$value->kode_penjualan.'/'.$value->kode_barang?>"><i class="fa fa-edit"></i></a>
                                <a title="hapus data" class="btn btn-flat btn-danger btn-xs" onclick="delete_detail_barang('<?=$value->kode_penjualan?>','<?=$value->kode_barang?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                <tr >
<!--                    <th colspan="2" class="text-center">Total Jenis Barang : --><?//=sizeof($spare_part->result());?><!-- Jenis</th>-->
                    <th colspan="5" class="text-right">Total Tagihan </th>
                    <th > <?=numberFormat($penjualan->total_penjualan)?></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <!-- end box-body -->
    <div class="box-footer text-center">

        <?php if($penjualan->status_penjualan==1){?>
            <a type="button" href="<?= site_url('daftar_antrian.php')?>" class="btn btn-warning">Kembali</a>
            <a type="button" href="javascript:void(0)" onclick="delete_antrian('<?=$penjualan->kode_penjualan?>')" class="btn btn-danger">Hapus</a>
            <a type="button" href="<?= site_url('simpan_antrian/').$penjualan->kode_penjualan?>" class="btn btn-primary">Simpan</a>
            <a type="button" href="<?= site_url('verifikasi_antrian/').$penjualan->kode_penjualan?>" class="btn btn-info">Simpan & Verifikasi</a>
        <?php }elseif($penjualan->status_penjualan==2){?>
            <a type="button" href="<?= site_url('daftar_antrian.php')?>" class="btn btn-warning">Kembali</a>
            <a type="button" href="<?= site_url('simpan_antrian/').$penjualan->kode_penjualan?>" class="btn btn-primary">Simpan</a>
            <a type="button" href="<?= site_url('proses_antrian/').$penjualan->kode_penjualan?>" class="btn btn-info">Proses Sekarang</a>
        <?php }elseif($penjualan->status_penjualan==3){?>
            <a type="button" href="<?= site_url('proses_antrian.php')?>" class="btn btn-warning">Kembali</a>
            <a type="button" href="<?= site_url('proses_antrian.php')?>" class="btn btn-primary">Simpan</a>
            <a type="button" href="<?= site_url('selesai_proses/').$penjualan->kode_penjualan?>" class="btn btn-info">Selesai Pengerjaan</a>
            <a type="button" href="<?= site_url('bayar_invoice/').$penjualan->kode_penjualan?>" class="btn btn-success">Selesai & Bayar</a>
        <?php }elseif($penjualan->status_penjualan==4){?>
            <a type="button" href="<?= site_url('invoice_antrian.php')?>" class="btn btn-warning">Kembali</a>
            <a type="button" href="<?= site_url('invoice_antrian.php')?>" class="btn btn-primary">Simpan</a>
            <a type="button" href="<?= site_url('bayar_invoice/').$penjualan->kode_penjualan?>" class="btn btn-success">Bayar Invoice</a>
        <?php }elseif($penjualan->status_penjualan==5){?>
            <a type="button" href="<?= site_url('invoice_antrian.php')?>" class="btn btn-warning">Kembali</a>
            <a type="button" href="<?= site_url('cetak_invoice/').$penjualan->kode_penjualan?>" class="btn btn-warning">Cetak Invoice</a>
        <?php }?>

    </div>
</div>
<!--end box-->

<script>
    $(function () {
        //data tabel
        $('#example2').DataTable({
            'autoWidth'   : false,
            "columnDefs": [
                { "orderable": false, "targets": [5] }
            ]
        });
        //data tabel
        $('#example').DataTable({
            'autoWidth'   : false,
            "columnDefs": [
                { "orderable": false, "targets": [6] }
            ]
        });
    });

    //function untuk delete data
    function delete_detail_barang($kode_penjualan,$kode_barang) {
        swal({
            title: 'Delete Data?',
            html: '<h5>Yakin akan delete data ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_detail/')?>"+$kode_penjualan+'/'+$kode_barang;
            }
        })
    }

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