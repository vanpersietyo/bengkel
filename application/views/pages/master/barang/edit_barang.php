<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 09/12/2018
 * Time: 11:11
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 08/12/2018
 * Time: 17:57
 */
?>


<div class="row">
    <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Kendaraan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_edit_kendaraan" onsubmit="edit_kendaraan()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Merk</label>
                            <input type="text" class="form-control" name="merk" id="merk" required="required" value="<?=capitalize_each_first($kendaraan->merk)?>" >
                            <input type="hidden" name="id" value="<?=$kendaraan->id?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Tipe</label>
                            <input name="tipe" type="text" class="form-control" required="required" value="<?=capitalize_each_first($kendaraan->tipe)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="<?=capitalize_each_first($kendaraan->keterangan)?>">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?= site_url('master/kendaraan.php')?>" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Ubah</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-7">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No.</th>
                        <th width="28%">Merk</th>
                        <th width="28%">Tipe</th>
                        <th width="23%">Keterangan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($daftar_kendaraan->result() as $key => $value){?>
                        <tr>
                            <td class="text-center"><?=$i++?></td>
                            <td><?=capitalize_each_first($value->merk);?></td>
                            <td><?=capitalize_each_first($value->tipe);?></td>
                            <td><?=capitalize_each_first($value->keterangan);?></td>
                            <td class="text-center">
                                <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_kendaraan/').$value->id?>"><i class="fa fa-edit"></i></a>
                                <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_kendaraan(<?=$value->id?>)" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>
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
    //auto focus kolom merk
    $( document ).ready(function() {
        $("#merk").focus();
    });
    //function tambah delete data
    function edit_kendaraan() {
        $.ajax({
            url : '<?=site_url('master/edit_kendaraan.do')?>',
            data: $('#form_edit_kendaraan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }

    //function untuk delete data
    function delete_kendaraan($id) {
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
                window.location.href = '<?= site_url('master/delete_kendaraan/')?>'+$id;
            }
        })
    }
</script>
