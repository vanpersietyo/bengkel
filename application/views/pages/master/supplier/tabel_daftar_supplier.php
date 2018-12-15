<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 13/12/2018
 * Time: 10:52
 */
?>
<div class="box box-info">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center" width="5%">No.</th>
                    <th width="28%">Supplier</th>
                    <th width="23%">Alamat</th>
                    <th width="23%">Telepon</th>
                    <th width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($daftar_supplier->result() as $key => $value){?>
                    <tr>
                        <td class="text-center"><?=$i++?></td>
                        <td><?=$value->kode_supplier.' - '.$value->nama_supplier;?></td>
                        <td><?=capitalize_each_first($value->alamat_supplier);?></td>
                        <td><?=capitalize_each_first($value->telp_supplier);?></td>
                        <td class="text-center">
                            <a title="edit data kendaraan"  class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_supplier/').$value->kode_supplier;?>"><i class="fa fa-edit"></i></a>
                            <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs"  href="javascript:void(0)"><i class="fa fa-close" onclick="delete_supplier('<?=$value->kode_supplier;?>')"></i></a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

<script>
    //untuk datatable
    $(function () {
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    });
    //function untuk delete data
    function delete_supplier($id) {
        swal({
            title: 'Konfirmasi!',
            html: '<h5>Yakin akan delete supplier ?</h5>',
            type: 'info',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                window.location.href = '<?= site_url('master/delete_supplier/')?>'+$id;
            }
        })
    }
</script>

