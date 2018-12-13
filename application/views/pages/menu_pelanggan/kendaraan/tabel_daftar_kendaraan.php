<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 13/12/2018
 * Time: 17:19
 */
?>
<div class="box box-info">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center" width="5%">No.</th>
                <th width="28%">Kendaraan</th>
                <th width="28%">No. Polisi</th>
                <th width="23%">Keterangan</th>
                <th width="15%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($daftar_kendaraan->result() as $key => $value){?>
                <tr>
                    <td class="text-center"><?=$i++?></td>
                    <td><?=capitalize_each_first($value->merk.' - '.$value->tipe);?></td>
                    <td><?=capitalize_each_first($value->nopol_kendaraan);?></td>
                    <td><?=capitalize_each_first($value->keterangan_kendaraan);?></td>
                    <td class="text-center">
                        <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_kendaraan/').$value->kode_kendaraan?>"><i class="fa fa-edit"></i></a>
                        <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_kendaraan(<?=$value->kode_kendaraan?>)" href="javascript:void(0)"><i class="fa fa-close"></i></a>
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
</script>
