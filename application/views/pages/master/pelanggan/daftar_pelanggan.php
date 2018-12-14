<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 09/12/2018
 * Time: 17:42
 */
?>


<div class="row">
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah <?=$subtitle?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_pelanggan" onsubmit="tambah_pelanggan()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Kode <?=$subtitle?></label>
                            <input type="text" readonly="readonly" class="form-control" name="kode" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Nama <?=$subtitle?></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Alamat <?=$subtitle?></label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Telepon <?=$subtitle?></label>
                            <input type="text" name="telepon" class="form-control" placeholder="No. Telepon">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?= site_url('dashboard')?>" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Tambah</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No.</th>
                        <th width="25%">Kode <?=$subtitle?></th>
                        <th width="25%">Nama <?=$subtitle?></th>
                        <th width="20%">Keterangan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;
                        if($daftar_pelanggan->num_rows()!=0){
                            foreach ($daftar_pelanggan->result() as $key => $value){?>
                                <tr>
                                    <td class="text-center"><?=$i++?></td>
                                    <td><?=$value->kode_user;?></td>
                                    <td><?=capitalize_each_first($value->nama);?></td>
                                    <td><?=capitalize_each_first($value->email);?></td>
                                    <td class="text-center">
                                        <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_pelanggan/').$value->kode_user?>"><i class="fa fa-edit"></i></a>
                                        <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_pelanggan('<?=$value->kode_user?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                        <?php };
                        };?>
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
        $("#nama").focus();
    });

    //function tambah delete data
    function tambah_pelanggan() {
        $.ajax({
            url : "<?=site_url('master/tambah_pelanggan.php')?>",
            data: $('#form_add_pelanggan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
    //function untuk delete data
    function delete_pelanggan($id) {
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
                window.location.href = '<?= site_url('master/delete_pelanggan.do/')?>'+$id;
            }
        })
    }
</script>
