<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 09/12/2018
 * Time: 0:21
 */
?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data <?=$subtitle?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_barang" onsubmit="tambah_barang()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Kode <?=$subtitle?></label>
                            <input type="text" readonly="readonly" class="form-control" name="kode" value="<?=$this->admin_model->get_kode_barang($jenis);?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label>Jenis <?=$subtitle?></label>
                            <select data-live-search-placeholder="Cari <?=$jenis?>" class="selectpicker form-control" name="kategori" data-show-subtext="true" data-live-search="true">
                                <?php
                                $i = 1;
                                foreach ($kategori->result() as $key => $value){ ?>
                                    <option value="<?=$value->kode_kategori?>"><?=$value->kode_kategori.' - '.$value->nama_kategori?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <?php
                    if ($jenis=='spare_part'){?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label >Nama <?=$subtitle?></label>
                                <input type="text" class="form-control" name="nama" id="nama" required="required" placeholder="Nama Spare Part : Oli, Shockbreaker, dll">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label >Satuan <?=$subtitle?></label>
                                <input type="text" class="form-control" name="satuan" required="required" placeholder="Pcs, Dus, Karton, dll">
                            </div>
                        </div>
                    <?php } elseif ($jenis=='layanan') {?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label >Nama <?=$subtitle?></label>
                                <input type="text" class="form-control" name="nama" id="nama" required="required" placeholder="Nama Layanan : Ganti oli, Tune Up, dll">
                            </div>
                        </div>
                    <?php }
                    ?>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Harga <?=$subtitle?></label>
                            <input type="text" onfocus="$(this).select()" id="harga" name="harga" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Keterangan <?=$subtitle?></label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Kendaraan">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?= site_url('master/kendaraan.php')?>" type="button" class="btn btn-default">Batal</a>
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
                            <td><?=capitalize_each_first($value->harga);?></td>
                            <td><?=capitalize_each_first($value->keterangan);?></td>
                            <td class="text-center">
                                <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('master/edit_kendaraan/').$value->kode?>"><i class="fa fa-edit"></i></a>
                                <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_barang('<?=$value->kode?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
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
<?php echo $this->session->flashdata('notif');?>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
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

        //untuk format input uang
        $("#harga").inputmask({
            prefix: "Rp. ",
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 0,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1,
            rightAlign: false });
    });
    //function tambah delete data
    function tambah_barang() {
        $.ajax({
            url : "<?=site_url('master/tambah_'.$jenis.'.php')?>",
            data: $('#form_add_barang').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
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