<?php
/**
 * Created by PhpStorm.
 * User: Adhitya
 * Date: 16/12/2018
 * Time: 7:47
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="5%">No.</th>
                            <th width="10%">No. Pembelian</th>
                            <th width="15%">Tanggal Pembelian</th>
                            <th width="25%">Supplier</th>
                            <th width="15%">Total</th>
                            <th width="15%">Keterangan</th>
                            <th width="8%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($daftar_pembelian->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$i++?></td>
                                <td><?=$value->kode_pembelian;?></td>
                                <td><?=formatDate($value->tgl_pembelian,'H:i').'&nbsp;&nbsp;&nbsp;'.dateIndo($value->tgl_pembelian,1);?></td>
                                <td><?=$value->kode_supplier.' - '.capitalize_each_first($value->nama_supplier);?></td>
                                <td><?=numberFormat($value->total_pembelian,1);?></td>
                                <td><?=capitalize_each_first($value->keterangan_pembelian);?></td>
                                <td class="text-center">
                                    <a title="Ubah Order Pembelian"     class="btn btn-flat btn-info    btn-xs" href="<?= site_url('add_pembelian_barang/').$value->kode_pembelian?>"><i class="fa fa-edit"></i></a>
                                    <a title="Hapus Order Pembelian"    class="btn btn-flat btn-danger  btn-xs" href="javascript:void(0)" onclick="delete_pembelian('<?=$value->kode_pembelian?>')" ><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="result_content"></div>
<?=$this->session->flashdata('notif');?>
<script type="text/javascript">

    //untuk datatable
    $(function () {

        $.fn.dataTable.ext.buttons.alert = {
            className: 'buttons-alert',
            action: function ( e, dt, node, config ) {
                location.href = '<?=site_url('add_pembelian.php');?>';
            }
        };

        $(document).ready(function() {
            $('#example2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend      : 'alert',
                        text        : 'Tambah Pembelian',
                    }
                ]
            } );
        } );


//        $('#example2').DataTable({
//            buttons: {text: 'Alert',
//                action: function ( e, dt, node, config ) {
//                    alert( 'Activated!' );
//                    this.disable(); // disable button
//                }}
//        })
    });
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
