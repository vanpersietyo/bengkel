<?php
/**
 * Created by PhpStorm.
 * User: Adhitya
 * Date: 16/12/2018
 * Time: 10:00
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
                            <th class="text-center" width="3%">No.</th>
                            <th width="10%">No. Invoice</th>
                            <th width="15%">Tanggal Invoice</th>
                            <th width="25%">Order Pembelian</th>
                            <th width="15%">Supplier</th>
                            <th width="5%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($daftar_pembelian->result() as $key => $value){?>
                            <tr>
                                <td class="text-center"><?=$i++?></td>
                                <td><?=$value->no_invoice_pembayaran;?></td>
                                <td><?=dateIndo($value->tgl_pembayaran,1);?></td>
                                <td><?=$value->kode_pembelian.' - '.dateIndo($value->tgl_pembelian,1);?></td>
                                <td><?=capitalize_each_first($value->nama_supplier);?></td>
                                <td class="text-center">
                                    <a title="lihat invoice" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('invoice/').$value->no_invoice_pembayaran?>"><i class="fa fa-file-text-o"></i></a>
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
<script>
    //untuk datatable
    $(function () {
        $('#example2').DataTable({
            'lengthChange': false,
            'autoWidth'   : false
        })
    });
    //function untuk delete data
    function delete_pembelian($id) {
        swal({
            title: $id,
            html: '<h5>Yakin akan delete invoice ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_invoice_pembelian/')?>"+$id;
            }
        })
    }
</script>

