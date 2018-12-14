<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 09/12/2018
 * Time: 11:13
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
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_kategori_barang" onsubmit="tambah_kategori_barang()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Kode <?=$subtitle?></label>
                            <input type="text" readonly="readonly" class="form-control" name="kode" value="<?=$this->admin_model->get_kode_kategori_barang($jenis);?>">
                        </div>
                    </div>

                    <?php
                    if ($jenis=='spare_part'){?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label >Nama <?=$subtitle?></label>
                                <input type="text" class="form-control" name="nama" id="nama" required="required" placeholder="Nama Jenis Spare Part : Rem, AC, Aksesoris, dll.">
                            </div>
                        </div>
                    <?php } elseif ($jenis=='layanan') {?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label >Nama <?=$subtitle?></label>
                                <input type="text" class="form-control" name="nama" id="nama" required="required" placeholder="Nama Jenis Layanan : Tune Up, Servis AC, Servis Cairan ">
                            </div>
                        </div>
                    <?php }
                    ?>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Keterangan <?=$subtitle?></label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Jenis Kendaraan">
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
                    <?php $i=1; foreach ($daftar_kategori_barang->result() as $key => $value){?>
                        <tr>
                            <td class="text-center"><?=$i++?></td>
                            <td><?=$value->kode_kategori;?></td>
                            <td><?=capitalize_each_first($value->nama_kategori);?></td>
                            <td><?=capitalize_each_first($value->keterangan_kategori);?></td>
                            <td class="text-center">
                                <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_jenis_').$jenis.'/'.$value->kode_kategori?>"><i class="fa fa-edit"></i></a>
                                <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_kategori_barang('<?=$value->kode_kategori?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
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
        $("#nama").focus();
    });

    //function tambah delete data
    function tambah_kategori_barang() {
        $.ajax({
            url : "<?=site_url('master/tambah_jenis_'.$jenis.'.php')?>",
            data: $('#form_add_kategori_barang').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
    //function untuk delete data
    function delete_kategori_barang($id) {
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
                window.location.href = '<?= site_url('master/hapus_jenis_'.$jenis.'/')?>'+$id;
            }
        })
    }
</script>
