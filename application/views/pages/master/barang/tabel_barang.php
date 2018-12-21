<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 18/12/2018
 * Time: 12:44
 */
?>

<div class="box box-info">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center" width="5%">No.</th>
                    <th width="30%"><?=$subtitle?></th>
                    <th width="20%">Jenis <?=$subtitle?></th>
                    <th width="15%">Harga</th>
                    <th width="15%">Keterangan</th>
                    <th width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($daftar_barang->result() as $key => $value){?>
                    <tr>
                        <td class="text-center"><?=$i++?></td>
                        <td ><?=$value->kode.' - '.capitalize_each_first($value->nama);?></td>
                        <td><?=capitalize_each_first($value->nama_kategori);?></td>
                        <td><?=numberFormat($value->harga);?></td>
                        <td><?=capitalize_each_first($value->keterangan);?></td>
                        <td class="text-center">
                            <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_'.$jenis.'/').$value->kode?>"><i class="fa fa-edit"></i></a>
                            <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_barang('<?=$value->kode?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>

    //untuk datatable
    $(function () {
        $('#example2').DataTable({
            'autoWidth'   : false,
            "columnDefs": [
            { "orderable": false, "targets": [5] }
        ]
        })
    });

    //function untuk delete data
    function delete_barang($id) {
        swal({
            title: 'Delete Data?',
            html: '<h5>Yakin akan delete data ini?</h5>',
            type: 'info',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                window.location.href = '<?= site_url('master/hapus_'.$jenis.'/')?>'+$id;
            }
        })
    }
</script>