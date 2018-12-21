<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 18/12/2018
 * Time: 15:00
 */
?>
<div class="box box-info">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center" width="5%">No.</th>
                <th width="15%">Kode <?=$subtitle?></th>
                <th width="25%">Nama <?=$subtitle?></th>
                <th width="20%">Email</th>
                <th width="15%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;
            if($daftar_pelanggan->num_rows()!=0){
                foreach ($daftar_pelanggan->result() as $key => $value){?>
                    <tr>
                        <td class="text-center"><?=$i++?></td>
                        <td><?=$value->no_registrasi;?></td>
                        <td><?=capitalize_each_first($value->nama);?></td>
                        <td><?=capitalize_each_first($value->email);?></td>
                        <td class="text-center">
                            <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_pelanggan/').$value->no_registrasi?>"><i class="fa fa-edit"></i></a>
                            <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_pelanggan('<?=$value->no_registrasi?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                        </td>
                    </tr>
                <?php };
            };?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    //untuk datatable
    $(function () {
        $('#example2').DataTable({
            'autoWidth'   : false,
            "columnDefs": [
                { "orderable": false, "targets": [4] }
            ]
        })
    });

    //function untuk delete data
    function delete_pelanggan($id) {
        swal({
            title: 'Delete Data?',
            html: '<h5>Yakin akan delete data ini?</h5>',
            type: 'info',
            showCancelButton: true,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                window.location.href = '<?= site_url('master/delete_pelanggan.do/')?>'+$id;
            }
        })
    }
</script>
