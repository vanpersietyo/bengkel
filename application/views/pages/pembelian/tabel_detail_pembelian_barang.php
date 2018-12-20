<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 17/12/2018
 * Time: 11:07
 */
?>
<div class="col-md-12">
    <!--start box-->
    <div class="box">
        <!-- start box-body -->
        <div class="box-body with-border padding_bottom">

            <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="5%">No.</th>
                            <th width="30%">Spare Part</th>
                            <th width="9%" class="text-center">Qty</th>
                            <th width="10%">Satuan</th>
                            <th width="15%">Harga</th>
                            <th width="15%">Subtotal</th>
                            <?php if($pembelian->status_pembelian!='lunas'){?>
                                <th width="10%">Aksi</th>
                            <?php }?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($pembelian_barang->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$i++?></td>
                                <td ><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang);?></td>
                                <td class="text-center"><?=$value->qty;?></td>
                                <td><?=$value->satuan;?></td>
                                <td><?=numberFormat($value->harga);?></td>
                                <td><?=numberFormat($value->subtotal);?></td>
                                <?php if($pembelian->status_pembelian!='lunas'){?>
                                    <td class="text-center">
                                        <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('edit_pembelian_barang/').$value->kode_pembelian.'/'.$value->kode_barang?>"><i class="fa fa-edit"></i></a>
                                        <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_pembelian_barang('<?=$value->kode_pembelian?>','<?=$value->kode_barang?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                                    </td>
                                <?php }?>
                            </tr>
                        <?php }?>
                        </tbody>
                        <tfoot>
                        <tr >
                            <!--                                        <th colspan="2" class="text-right"> Jenis Barang:</th>-->
                            <!--                                        <th class="text-center"> --><?//=sizeof($pembelian_barang)?><!--</th>-->
                            <th colspan="2" class="text-center">Total Jenis Barang : <?=sizeof($pembelian_barang->result());?> Jenis</th>
                            <th colspan="2" class="text-center">Total Qty : <?=$pembelian->total_qty?></th>
                            <th class="text-right">Total Tagihan </th>
                            <th > <?=numberFormat($pembelian->total_pembelian)?></th>
                            <?php if($pembelian->status_pembelian!='lunas'){?>
                                <th></th>
                            <?php }?>
                        </tr>
                        </tfoot>
                    </table>
        </div>
            <?php if($pembelian->status_pembelian!='lunas'){?>
            <div class="box-footer text-center">
                <a type="button" href="<?= site_url('order_pembelian.php')?>" class="btn btn-warning">Kembali</a>
                <a type="button" href="javascript:void(0)" onclick="delete_pembelian('<?=$pembelian->kode_pembelian?>')" class="btn btn-danger">Hapus</a>
                <a type="button" href="<?= site_url('simpan_pembelian_barang/').$pembelian->kode_pembelian?>" class="btn btn-primary">Simpan</a>
                <a type="button" href="<?= site_url('bayar_pembelian_barang/').$pembelian->kode_pembelian?>" class="btn btn-info">Simpan & Bayar</a>
            </div>
            <?php } else {?>
            <div class="box-footer text-center">

                <a type="button" href="<?= site_url('invoice_pembelian.php')?>" class="btn btn-warning">Kembali</a>
                <a type="button" href="<?= site_url('invoice/').$pembelian->kode_pembelian?>" class="btn btn-info">Cetak Invoice</a>
            </div>
            <?php }?>

        </div>
        <!-- end box-body -->
    </div>
    <!--end box-->
</div>


<script>
    $(function () {
        //data tabel
        $('#example2').DataTable({
            'paging'        : false,
            'lengthChange'  : false,
            'searching'     : true,
            'autoWidth'     : false,
            'scrollY'       : '25vh',
            'scrollCollapse': true,
            "columnDefs": [
                { "orderable": false, "targets": [6] }
            ]
        });
    });

    //function untuk delete data
    function delete_pembelian_barang($kode_pembelian,$kode_barang) {
        swal({
            title: 'Delete Data?',
            html: '<h5>Yakin akan delete data pembelian ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_pembelian_barang/')?>"+$kode_pembelian+'/'+$kode_barang;
            }
        })
    }
    //function untuk delete data
    function delete_pembelian($id) {
        swal({
            title: $id,
            html: '<h5>Yakin akan delete data pembelian ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_order_pembelian/')?>"+$id;
            }
        })
    }
</script>
